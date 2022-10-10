<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Exports\QuartoTrimestreExport;
use App\Exports\RelatorioGeralExport;
use App\Exports\SegundoTrimestreExport;
use App\Exports\TerceiroTrimestreExport;
use App\Exports\TrimestreExport;
use App\Http\Controllers\Controller;
use App\Models\proedi\EnviarRelatorioQuartoTrimestre;
use App\Models\proedi\EnviarRelatorioSegundoTrimestre;
use App\Models\proedi\EnviarRelatorioTerceiroTrimestre;
use App\Models\proedi\EnviarRelatorioTrimestral;
use App\Models\proedi\Proedi;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Engineering\ConvertDecimal;

class ReportsProediController extends Controller
{   

    public function __construct(Proedi $proedi, EnviarRelatorioTrimestral $trimestre)
    {   
        $this->repository = $proedi;
        $this->trimestre = $trimestre;
        //$this->middleware(['can:reports']);
    }
    public function index(){
        return view('admin.reports.proedi.index');
    }

    public function empresas( Request $request){
       //$empresas = DB::table('tenants')->get();

        $query = Proedi::query();

       // $desconto =  $request->get('desconto');
        //$data_inicio = $request->get('data_inicio');

       /* $empresas = $this->repository
        ->where(function($query) use ($request){
            if ($request->desconto || $request->data_inicio || $request->data_fim) {
                $query->orWhere('desconto', '=', "%{$request->desconto}%");
                $query->orWhere('data_inicio', '>=', "%{$request->data_inicio}%");
                $query->orWhere('data_final', '<=', "%{$request->data_fim}%");
            }
        })
        ->latest()
        ->paginate(); */


        //$empresas = Proedi::where('desconto', 'LIKE', $desconto)->orWhere('data_inicio', 'LIKE', $data_inicio)->paginate();

       /* $request->validate([
            'data_inicio' => 'nullable',
            'data_fim' => 'required',
        ]); */

        $desconto = $request->get('desconto');
        $area_atuacao = $request->get('area_atuacao');
        $produto = $request->get('produto');
        $tipo_empresa = $request->get('tipo_empresa');
        $municipio = $request->get('municipio');
        $data_inicio = $request->data_inicio; //$request->get('data_inicio');
        $data_fim =  $request->get('data_fim');
        

        if(isset($desconto)){
            $query->where('desconto', '=', $desconto);
        }
        if(isset($area_atuacao)){
            $query->where('area_atuacao', '=', $area_atuacao);
        }
        if(isset($produto)){
            $query->where('produto', '=', $produto);
        }
        if(isset($tipo_empresa)){
            $query->where('tipo_empresa', '=', $tipo_empresa);
        }
        if(isset($municipio)){
            $query->where('municipio', '=', $municipio);
        }
        if(isset($data_inicio )){
            $query->whereDate('data_inicio', '>=', $data_inicio);
        }
        if(isset($data_fim )){
            $query->whereDate('data_final', '<=', $data_fim);
        }

       /* if ($data_inicio || $data_fim) {
            $query->where('desconto', 'LIKE', $desconto);
            $query->whereDate('data_inicio', '>=', $data_inicio);
            $query->whereDate('data_final', '<=', $data_fim);

        } */

        $empresas = $query->paginate();

        dd($query->paginate());

       //dd($empresas);
       //dd($data_inicio);
        //return $empresas;
       //return $view->with('empresas', $empresas);

       if($request->input('enviar')){
        session()->put('empresas', $empresas);
        return view('admin.reports.proedi.geral.geral_excel', compact('empresas'));
       }

       if($request->input('relatorio_excel')){
        $empresas = session('empresas');   
        return Excel::download( new RelatorioGeralExport($empresas), 'relatorio.xlsx');
       }

       if($request->input('relatorio_csv')){
        $empresas = session('empresas');
        return Excel::download( new RelatorioGeralExport($empresas), 'relatorio.csv');
       }

       if($request->input('relatorio_ods')){
        $empresas = session('empresas');
        return Excel::download( new RelatorioGeralExport($empresas), 'relatorio.ods');
       }
       
       if($request->input('relatorio_pdf')){
        $empresas = session('empresas');
        return Excel::download( new RelatorioGeralExport($empresas), 'relatorio.pdf');
       }
    }

    public function stringToInt($money){

        $cover = str_replace(",", "", $money);

        $coverd = str_replace(".", "", $cover);
       
        $var = intval($coverd);

        $n = $var / 10;

        if ($n == 0) {
            $n = null;
        }

        return $n;
    }
   
    public function trimestre(Request $request){
                     
        $query = EnviarRelatorioTrimestral::query();

        $beneficios = $request->get('outros_beneficios');
        $placaProedi = $request->get('placa_proedi');

        $faturamentoJaneiro = $this->stringToInt($request->get('faturamento_janeiro'));
        $faturamentoFevereiro = $this->stringToInt($request->get('faturamento_fevereiro'));
        $faturamentoMarco = $this->stringToInt($request->get('faturamento_marco'));
        
        $empregosJaneiro = $request->get('empregos_gerados_trimestre_janeiro');
        $empregosFevereiro = $request->get('empregos_gerados_trimestre_fevereiro');
        $empregosMarco = $request->get('empregos_gerados_trimestre_marco'); 

        $empregosProedi = $request->get('empregos_gerados_proedi');

        $materiaPrimaAdquiridaRN = $request->get('materia_prima_adquirida_rn');

        $icmsDevidoJaneiro = $this->stringToInt($request->get('icms_total_devido_janeiro'));
        $icmsDevidoFeveiro = $this->stringToInt($request->get('icms_total_devido_fevereiro'));
        $icmsDevidoMarco = $this->stringToInt($request->get('icms_total_devido_marco'));

        $icmsPagoJaneiro = $this->stringToInt($request->get('icms_total_pago_janeiro'));
        $icmsPagoFevereiro = $this->stringToInt($request->get('icms_total_pago_fevereiro'));
        $icmsPagoMarco = $this->stringToInt($request->get('icms_total_pago_marco'));
              
        $investimentoProjetado = $this->stringToInt($request->get('investimento_projetado'));

        $investimentoRealizadoJaneiro = $this->stringToInt($request->get('investimento_realizado_janeiro'));
        $investimentoRealizadoFevereiro = $this->stringToInt($request->get('investimento_realizado_fevereiro'));
        $investimentoRealizadoMarco = $this->stringToInt($request->get('investimento_realizado_marco'));

        $investimentoRealizadoProedi = $this->stringToInt($request->get('investimento_total_realizado'));
       
        $empregosDiretosAtuais= $request->get('n_empregos_diretos_atuais');
        $menoresAprendizes = $request->get('possui_menores_aprendizes');
        $estagiarios = $request->get('possui_estagiarios');
        $trainees = $request->get('possui_trainee');
        $destino_mercadoria = $request->get('destino_mercadoria');

        /**
         * 
         */

        $faturamentoJaneiro = $this->stringToInt($faturamentoJaneiro);
        $faturamentoFevereiro = $this->stringToInt($faturamentoFevereiro);
        $faturamentoMarco = $this->stringToInt($faturamentoMarco);

        $icmsDevidoJaneiro = $this->stringToInt($icmsDevidoJaneiro);
        $icmsDevidoFeveiro = $this->stringToInt($icmsDevidoFeveiro);
        $icmsDevidoMarco = $this->stringToInt($icmsDevidoMarco);

        $icmsPagoJaneiro = $this->stringToInt($icmsPagoJaneiro);
        $icmsPagoFevereiro = $this->stringToInt($icmsPagoFevereiro);
        $icmsPagoMarco = $this->stringToInt($icmsPagoMarco);

        $investimentoProjetado = $this->stringToInt($investimentoProjetado);

        $investimentoRealizadoJaneiro = $this->stringToInt($investimentoRealizadoJaneiro);
        $investimentoRealizadoFevereiro = $this->stringToInt($investimentoRealizadoFevereiro);
        $investimentoRealizadoMarco = $this->stringToInt($investimentoRealizadoMarco);

        $investimentoRealizadoProedi = $this->stringToInt($investimentoRealizadoProedi);

        //dd($request->all());
        
        if(isset($beneficios)){
            $query->where('outros_beneficios', 'LIKE', "%$beneficios%");
        }
        if(isset($placaProedi)){
            $query->where('placa_proedi', 'LIKE', "%$placaProedi%");
        }
        if(isset($faturamentoJaneiro)){
            $query->where('faturamento_janeiro', '<=', $faturamentoJaneiro);
        }
        if(isset($faturamentoFevereiro)){
            $query->where('faturamento_fevereiro', '<=', $faturamentoFevereiro);
        }
        if(isset($faturamentoMarco)){
            $query->where('faturamento_marco', '<=', $faturamentoMarco);
        }
        if(isset($empregosJaneiro)){
            $query->where('empregos_gerados_trimestre_janeiro', '<=', $empregosJaneiro);
        }
        if(isset($empregosFevereiro)){
            $query->where('empregos_gerados_trimestre_fevereiro', '<=', $empregosFevereiro);
        }
        if(isset($empregosMarco)){
            $query->where('empregos_gerados_trimestre_marco', '<=', $empregosMarco);
        }
        if(isset($empregosProedi)){
            $query->where('empregos_gerados_proedi', '<=', $empregosProedi);
        }
        if(isset($materiaPrimaAdquiridaRN)){
            $query->where('materia_prima_adquirida_rn', '=', $materiaPrimaAdquiridaRN);
        }
        if(isset($icmsDevidoJaneiro)){
            $query->where('icms_total_devido_janeiro', '<=', $icmsDevidoJaneiro);
        }
        if(isset($icmsDevidoFeveiro)){
            $query->where('icms_total_devido_fevereiro', '<=', $icmsDevidoFeveiro);
        }
        if(isset($icmsDevidoMarco)){
            $query->where('icms_total_devido_marco', '<=', $icmsDevidoMarco);
        }
        if(isset($icmsPagoJaneiro)){
            $query->where('icms_total_pago_janeiro', '<=', $icmsPagoJaneiro);
        }
        if(isset($icmsPagoFevereiro)){
            $query->where('icms_total_pago_fevereiro', '<=', $icmsPagoFevereiro);
        }
        if(isset($icmsPagoMarco)){
            $query->where('icms_total_pago_marco', '<=', $icmsPagoMarco);
        }
        if(isset($investimentoProjetado)){
            $query->where('investimento_projetado', '<=', $investimentoProjetado);
        }
        if(isset($investimentoRealizadoJaneiro)){
            $query->where('investimento_realizado_janeiro', '<=', $investimentoRealizadoJaneiro);
        }
        if(isset($investimentoRealizadoFevereiro)){
            $query->where('investimento_realizado_fevereiro', '<=', $investimentoRealizadoFevereiro);
        }
        if(isset($investimentoRealizadoMarco)){
            $query->where('investimento_realizado_marco', '<=', $investimentoRealizadoMarco);
        }
        if(isset($investimentoRealizadoProedi)){
            $query->where('investimento_total_realizado', '<=', $investimentoRealizadoProedi);
        }
        if(isset($empregosDiretosAtuais)){
            $query->where('n_empregos_diretos_atuais', '<=', $empregosDiretosAtuais);
        }
        if(isset($menoresAprendizes)){
            $query->where('possui_menores_aprendizes', '<=', $menoresAprendizes);
        }
        if(isset($estagiarios)){
            $query->where('possui_estagiarios', '<=', $estagiarios);
        }
        if(isset($trainees)){
            $query->where('possui_trainee', '<=', $trainees);
        }
        if(isset($destino_mercadoria)){
            $query->where('destino_mercadoria', '<=', $destino_mercadoria);
        }
            
        $trimestres = $query->paginate();
        
        //dd($query->paginate());
        
       if($request->input('enviar')){
        session()->put('trimestres', $trimestres);
        //dd($trimestres);
        return view('admin.reports.proedi.trimestre_excel', compact('trimestres'));
       }
              
       if($request->input('relatorio_excel')){        
         $trimestres = session('trimestres');        
         return Excel::download( new TrimestreExport($trimestres), '1trimestre.xlsx');        
       }

       if($request->input('relatorio_csv')){        
        $trimestres = session('trimestres');        
        return Excel::download( new TrimestreExport($trimestres), '1trimestre.csv');        
      }
      if($request->input('relatorio_ods')){        
        $trimestres = session('trimestres');        
        return Excel::download( new TrimestreExport($trimestres), '1trimestre.ods');        
      }
        
    }

    public function segundo_trimestre(Request $request){
        
        //dd($request);
        $query = EnviarRelatorioSegundoTrimestre::query();

        $beneficios = $request->get('outros_beneficios');
        $placaProedi = $request->get('placa_proedi');

        $faturamentoAbril = $this->stringToInt($request->get('faturamento_abril'));
        $faturamentoMaio = $this->stringToInt($request->get('faturamento_maio'));
        $faturamentoJunho = $this->stringToInt($request->get('faturamento_junho'));

        $empregosAbril = $request->get('empregos_gerados_trimestre_abril');
        $empregosMaio = $request->get('empregos_gerados_trimestre_maio');
        $empregosJunho = $request->get('empregos_gerados_trimestre_junho'); 

        $empregosProedi = $request->get('empregos_gerados_proedi');

        $materiaPrimaAdquiridaRN = $request->get('materia_prima_adquirida_rn');

        $icmsDevidoAbril = $this->stringToInt($request->get('icms_total_devido_abril'));
        $icmsDevidoMaio = $this->stringToInt($request->get('icms_total_devido_maio'));
        $icmsDevidoJunho = $this->stringToInt($request->get('icms_total_devido_junho'));

        $icmsPagoAbril = $this->stringToInt($request->get('icms_total_pago_abril'));
        $icmsPagoMaio = $this->stringToInt($request->get('icms_total_pago_maio'));
        $icmsPagoJunho = $this->stringToInt($request->get('icms_total_pago_junho'));

        $investimentoProjetado = $this->stringToInt($request->get('investimento_projetado'));

        $investimentoRealizadoAbril = $this->stringToInt($request->get('investimento_realizado_abril'));
        $investimentoRealizadoMaio = $this->stringToInt($request->get('investimento_realizado_maio'));
        $investimentoRealizadoJunho = $this->stringToInt($request->get('investimento_realizado_junho'));

        $investimentoRealizadoProedi = $this->stringToInt($request->get('investimento_total_realizado'));

        $empregosDiretosAtuais= $request->get('n_empregos_diretos_atuais');
        $menoresAprendizes = $request->get('possui_menores_aprendizes');
        $estagiarios = $request->get('possui_estagiarios');
        $trainees = $request->get('possui_trainee');
        $destino_mercadoria = $request->get('destino_mercadoria');

        /**
         * 
         */
        $faturamentoAbril = $this->stringToInt($faturamentoAbril);
        $faturamentoMaio = $this->stringToInt($faturamentoMaio);
        $faturamentoJunho = $this->stringToInt($faturamentoJunho);

        $icmsDevidoAbril = $this->stringToInt($icmsDevidoAbril);
        $icmsDevidoMaio = $this->stringToInt($icmsDevidoMaio);
        $icmsDevidoJunho = $this->stringToInt($icmsDevidoJunho);

        $icmsPagoAbril = $this->stringToInt($icmsPagoAbril);
        $icmsPagoMaio = $this->stringToInt($icmsPagoMaio);
        $icmsPagoJunho = $this->stringToInt($icmsPagoJunho);

        $investimentoProjetado = $this->stringToInt($investimentoProjetado);

        $investimentoRealizadoAbril = $this->stringToInt($investimentoRealizadoAbril);
        $investimentoRealizadoMaio = $this->stringToInt($investimentoRealizadoMaio);
        $investimentoRealizadoJunho = $this->stringToInt($investimentoRealizadoJunho);

        $investimentoRealizadoProedi = $this->stringToInt($investimentoRealizadoProedi);

        dd($request->all());
                        
        if(isset($beneficios)){
            $query->where('outros_beneficios', 'LIKE', "%$beneficios%");
        }
        if(isset($placaProedi)){
            $query->where('placa_proedi', 'LIKE', "%$placaProedi%");
        }
        if(isset($faturamentoAbril)){
            $query->where('faturamento_abril', '<=', $faturamentoAbril);
        }
        if(isset($faturamentoMaio)){
            $query->where('faturamento_maio', '<=', $faturamentoMaio);
        }
        if(isset($faturamentoJunho)){
            $query->where('faturamento_junho', '<=', $faturamentoJunho);
        }
        if(isset($empregosAbril)){
            $query->where('empregos_gerados_trimestre_abril', '<=', $empregosAbril);
        }
        if(isset($empregosMaio)){
            $query->where('empregos_gerados_trimestre_maio', '<=', $empregosMaio);
        }
        if(isset($empregosJunho)){
            $query->where('empregos_gerados_trimestre_junho', '<=', $empregosJunho);
        }
        if(isset($empregosProedi)){
            $query->where('empregos_gerados_proedi', '<=', $empregosProedi);
        }
        if(isset($materiaPrimaAdquiridaRN)){
            $query->where('materia_prima_adquirida_rn', '=', $materiaPrimaAdquiridaRN);
        }
        if(isset($icmsDevidoAbril)){
            $query->where('icms_total_devido_abril', '<=', $icmsDevidoAbril);
        }
        if(isset($icmsDevidoMaio)){
            $query->where('icms_total_devido_maio', '=', $icmsDevidoMaio);
        }
        if(isset($icmsDevidoJunho)){
            $query->where('icms_total_devido_junho', '<=', $icmsDevidoJunho);
        }
        if(isset($icmsPagoAbril)){
            $query->where('icms_total_pago_abril', '<=', $icmsPagoAbril);
        }
        if(isset($icmsPagoMaio)){
            $query->where('icms_total_pago_maio', '<=', $icmsPagoMaio);
        }
        if(isset($icmsPagoJunho)){
            $query->where('icms_total_pago_junho', '<=', $icmsPagoJunho);
        }
        if(isset($investimentoProjetado)){
            $query->where('investimento_projetado', '<=', $investimentoProjetado);
        }
        if(isset($investimentoRealizadoAbril)){
            $query->where('investimento_realizado_abril', '<=', $investimentoRealizadoAbril);
        }
        if(isset($investimentoRealizadoMaio)){
            $query->where('investimento_realizado_maio', '<=', $investimentoRealizadoMaio);
        }
        if(isset($investimentoRealizadoJunho)){
            $query->where('investimento_realizado_junho', '<=', $investimentoRealizadoJunho);
        }
        if(isset($investimentoRealizadoProedi)){
            $query->where('investimento_total_realizado', '<=', $investimentoRealizadoProedi);
        }
        if(isset($empregosDiretosAtuais)){
            $query->where('n_empregos_diretos_atuais', '<=', $empregosDiretosAtuais);
        }
        if(isset($menoresAprendizes)){
            $query->where('possui_menores_aprendizes', '<=', $menoresAprendizes);
        }
        if(isset($estagiarios)){
            $query->where('possui_estagiarios', '<=', $estagiarios);
        }
        if(isset($trainees)){
            $query->where('possui_trainee', '<=', $trainees);
        }
        if(isset($destino_mercadoria)){
            $query->where('destino_mercadoria', '<=', $destino_mercadoria);
        }

        $trimestres = $query->paginate();

        //dd($trimestres);
        
       if($request->input('enviar')){
        session()->put('trimestres', $trimestres);
        return view('admin.reports.proedi.segundo_trimestre.trimestre', compact('trimestres'));
       }
              
       if($request->input('relatorio_excel')){        
         $trimestres = session('trimestres');        
         return Excel::download( new SegundoTrimestreExport($trimestres), 'segundo_trimestre.xlsx');        
       }

       if($request->input('relatorio_csv')){        
        $trimestres = session('trimestres');        
        return Excel::download( new SegundoTrimestreExport($trimestres), 'segundo_trimestre.csv');        
      }
      if($request->input('relatorio_ods')){        
        $trimestres = session('trimestres');        
        return Excel::download( new SegundoTrimestreExport($trimestres), 'segundo_trimestre.ods');        
      }
        
    }

    public function terceiro_trimestre(Request $request) {
        
        //dd($request);
        $query = EnviarRelatorioTerceiroTrimestre::query();

        $beneficios = $request->get('outros_beneficios');
        $placaProedi = $request->get('placa_proedi');

        $faturamentoJulho = $this->stringToInt($request->get('faturamento_julho'));
        $faturamentoAgosto = $this->stringToInt($request->get('faturamento_agosto'));
        $faturamentoSetembro = $this->stringToInt($request->get('faturamento_setembro'));

        $empregosJulho = $request->get('empregos_gerados_trimestre_julho');
        $empregosAgosto = $request->get('empregos_gerados_trimestre_agosto');
        $empregosSetembro = $request->get('empregos_gerados_trimestre_setembro');

        $empregosProedi = $request->get('empregos_gerados_proedi');

        $materiaPrimaAdquiridaRN = $request->get('materia_prima_adquirida_rn');

        $icmsDevidoJulho = $this->stringToInt($request->get('icms_total_devido_julho'));
        $icmsDevidoAgosto = $this->stringToInt($request->get('icms_total_devido_agosto'));
        $icmsDevidoSetembro = $this->stringToInt($request->get('icms_total_devido_setembro'));

        $icmsPagoJulho = $this->stringToInt($request->get('icms_total_pago_julho'));
        $icmsPagoAgosto = $this->stringToInt($request->get('icms_total_pago_agosto'));
        $icmsPagoSetembro = $this->stringToInt($request->get('icms_total_pago_setembro'));

        $investimentoProjetado = $this->stringToInt($request->get('investimento_projetado'));

        $investimentoRealizadoJulho = $this->stringToInt($request->get('investimento_realizado_julho'));
        $investimentoRealizadoAgosto = $this->stringToInt($request->get('investimento_realizado_agosto'));
        $investimentoRealizadoSetembro = $this->stringToInt($request->get('investimento_realizado_setembro'));

        $investimentoRealizadoProedi = $this->stringToInt($request->get('investimento_total_realizado'));

        $empregosDiretosAtuais= $request->get('n_empregos_diretos_atuais');
        $menoresAprendizes = $request->get('possui_menores_aprendizes');
        $estagiarios = $request->get('possui_estagiarios');
        $trainees = $request->get('possui_trainee');
        $destino_mercadoria = $request->get('destino_mercadoria');

        /**
         * 
         */
        $faturamentoJulho = $this->stringToInt($faturamentoJulho);
        $faturamentoAgosto = $this->stringToInt($faturamentoAgosto);
        $faturamentoSetembro = $this->stringToInt($faturamentoSetembro);

        $icmsDevidoJulho = $this->stringToInt($icmsDevidoJulho);
        $icmsDevidoAgosto = $this->stringToInt($icmsDevidoAgosto);
        $icmsDevidoSetembro = $this->stringToInt($icmsDevidoSetembro);

        $icmsPagoJulho = $this->stringToInt($icmsPagoJulho);
        $icmsPagoAgosto = $this->stringToInt($icmsPagoAgosto);
        $icmsPagoSetembro = $this->stringToInt($icmsPagoSetembro);

        $investimentoProjetado = $this->stringToInt($investimentoProjetado);

        $investimentoRealizadoJulho = $this->stringToInt($investimentoRealizadoJulho);
        $investimentoRealizadoAgosto = $this->stringToInt($investimentoRealizadoAgosto);
        $investimentoRealizadoSetembro = $this->stringToInt($investimentoRealizadoSetembro);

        $investimentoRealizadoProedi = $this->stringToInt($investimentoRealizadoProedi);

        
        if(isset($beneficios)){
            $query->where('outros_beneficios', 'LIKE', "%$beneficios%");
        }
        if(isset($placaProedi)){
            $query->where('placa_proedi', 'LIKE', "%$placaProedi%");
        }
        if(isset($faturamentoJulho)){
            $query->where('faturamento_julho', '<=', $faturamentoJulho);
        }
        if(isset($faturamentoAgosto)){
            $query->where('faturamento_agosto', '<=', $faturamentoAgosto);
        }
        if(isset($faturamentoSetembro)){
            $query->where('faturamento_setembro', '<=', $faturamentoSetembro);
        }
        if(isset($empregosJulho)){
            $query->where('empregos_gerados_trimestre_julho', '<=', $empregosJulho);
        }
        if(isset($empregosAgosto)){
            $query->where('empregos_gerados_trimestre_agosto', '<=', $empregosAgosto);
        }
        if(isset($empregosSetembro)){
            $query->where('empregos_gerados_trimestre_setembro', '<=', $empregosSetembro);
        }
        if(isset($empregosProedi)){
            $query->where('empregos_gerados_proedi', '<=', $empregosProedi);
        }
        if(isset($materiaPrimaAdquiridaRN)){
            $query->where('materia_prima_adquirida_rn', '=', $materiaPrimaAdquiridaRN);
        }
        if(isset($icmsDevidoJulho)){
            $query->where('icms_total_devido_julho', '<=', $icmsDevidoJulho);
        }
        if(isset($icmsDevidoAgosto)){
            $query->where('icms_total_devido_agosto', '=', $icmsDevidoAgosto);
        }
        if(isset($icmsDevidoSetembro)){
            $query->where('icms_total_devido_setembro', '<=', $icmsDevidoSetembro);
        }
        if(isset($icmsPagoJulho)){
            $query->where('icms_total_pago_julho', '<=', $icmsPagoJulho);
        }
        if(isset($icmsPagoAgosto)){
            $query->where('icms_total_pago_agosto', '<=', $icmsPagoAgosto);
        }
        if(isset($icmsPagoSetembro)){
            $query->where('icms_total_pago_setembro', '<=', $icmsPagoSetembro);
        }
        if(isset($investimentoProjetado)){
            $query->where('investimento_projetado', '<=', $investimentoProjetado);
        }
        if(isset($investimentoRealizadoJulho)){
            $query->where('investimento_realizado_julho', '<=', $investimentoRealizadoJulho);
        }
        if(isset($investimentoRealizadoAgosto)){
            $query->where('investimento_realizado_agosto', '<=', $investimentoRealizadoAgosto);
        }
        if(isset($investimentoRealizadoSetembro)){
            $query->where('investimento_realizado_setembro', '<=', $investimentoRealizadoSetembro);
        }
        if(isset($investimentoRealizadoProedi)){
            $query->where('investimento_total_realizado', '<=', $investimentoRealizadoProedi);
        }
        if(isset($empregosDiretosAtuais)){
            $query->where('n_empregos_diretos_atuais', '<=', $empregosDiretosAtuais);
        }
        if(isset($menoresAprendizes)){
            $query->where('possui_menores_aprendizes', '<=', $menoresAprendizes);
        }
        if(isset($estagiarios)){
            $query->where('possui_estagiarios', '<=', $estagiarios);
        }
        if(isset($trainees)){
            $query->where('possui_trainee', '<=', $trainees);
        }
        if(isset($destino_mercadoria)){
            $query->where('destino_mercadoria', '<=', $destino_mercadoria);
        }

        $trimestres = $query->paginate();
        
       if($request->input('enviar')){
        session()->put('trimestres', $trimestres);
        return view('admin.reports.proedi.terceiro_trimestre.trimestre', compact('trimestres'));
       }
              
       if($request->input('relatorio_excel')){        
         $trimestres = session('trimestres');        
         return Excel::download( new TerceiroTrimestreExport($trimestres), 'terceiro_trimestre.xlsx');        
       }

       if($request->input('relatorio_csv')){        
        $trimestres = session('trimestres');        
        return Excel::download( new TerceiroTrimestreExport($trimestres), 'terceiro_trimestre.csv');        
      }
      if($request->input('relatorio_ods')){        
        $trimestres = session('trimestres');        
        return Excel::download( new TerceiroTrimestreExport($trimestres), 'terceiro_trimestre.ods');        
      }
    }

    public function quarto_trimestre(Request $request) {

        $query = EnviarRelatorioQuartoTrimestre::query();

        $beneficios = $request->get('outros_beneficios');
        $placaProedi = $request->get('placa_proedi');

        $faturamentoOutubro = $this->stringToInt($request->get('faturamento_outubro'));
        $faturamentoNovembro = $this->stringToInt($request->get('faturamento_novembro'));
        $faturamentoDezembro = $this->stringToInt($request->get('faturamento_dezembro'));

        $empregosOutubro = $request->get('empregos_gerados_trimestre_outubro');
        $empregosNovembro = $request->get('empregos_gerados_trimestre_novembro');
        $empregosDezembro = $request->get('empregos_gerados_trimestre_dezembro');        
        $empregosProedi = $request->get('empregos_gerados_proedi');
        $materiaPrimaAdquiridaRN = $request->get('materia_prima_adquirida_rn');

        $icmsDevidoOutubro = $this->stringToInt($request->get('icms_total_devido_outubro'));
        $icmsDevidoNovembro = $this->stringToInt($request->get('icms_total_devido_novembro'));
        $icmsDevidoDezembro = $this->stringToInt($request->get('icms_total_devido_dezembro'));

        $icmsPagoOutubro = $this->stringToInt($request->get('icms_total_pago_outubro'));
        $icmsPagoNovembro = $this->stringToInt($request->get('icms_total_pago_novembro'));
        $icmsPagoDezembro = $this->stringToInt($request->get('icms_total_pago_dezembro'));

        $investimentoProjetado = $this->stringToInt($request->get('investimento_projetado'));

        $investimentoRealizadoOutubro = $this->stringToInt($request->get('investimento_realizado_outubro'));
        $investimentoRealizadoNovembro = $this->stringToInt($request->get('investimento_realizado_novembro'));
        $investimentoRealizadoDezembro = $this->stringToInt($request->get('investimento_realizado_dezembro'));

        $investimentoRealizadoProedi = $this->stringToInt($request->get('investimento_total_realizado'));

        $empregosDiretosAtuais= $request->get('n_empregos_diretos_atuais');
        $menoresAprendizes = $request->get('possui_menores_aprendizes');
        $estagiarios = $request->get('possui_estagiarios');
        $trainees = $request->get('possui_trainee');
        $destino_mercadoria = $request->get('destino_mercadoria');

        /**
         * 
         */
        $faturamentoOutubro = $this->stringToInt($faturamentoOutubro);
        $faturamentoNovembro = $this->stringToInt($faturamentoNovembro);
        $faturamentoDezembro = $this->stringToInt($faturamentoDezembro);

        $icmsDevidoOutubro = $this->stringToInt($icmsDevidoOutubro);
        $icmsDevidoNovembro = $this->stringToInt($icmsDevidoNovembro);
        $icmsDevidoDezembro = $this->stringToInt($icmsDevidoDezembro);

        $icmsPagoOutubro = $this->stringToInt($icmsPagoOutubro);
        $icmsPagoNovembro = $this->stringToInt($icmsPagoNovembro);
        $icmsPagoDezembro = $this->stringToInt($icmsPagoDezembro);

        $investimentoProjetado = $this->stringToInt($investimentoProjetado);

        $investimentoRealizadoOutubro = $this->stringToInt($investimentoRealizadoOutubro);
        $investimentoRealizadoNovembro = $this->stringToInt($investimentoRealizadoNovembro);
        $investimentoRealizadoDezembro = $this->stringToInt($investimentoRealizadoDezembro);

        $investimentoRealizadoProedi = $this->stringToInt($investimentoRealizadoProedi);

        
        if(isset($beneficios)){
            $query->where('outros_beneficios', 'LIKE', "%$beneficios%");
        }
        if(isset($placaProedi)){
            $query->where('placa_proedi', 'LIKE', "%$placaProedi%");
        }
        if(isset($faturamentoOutubro)){
            $query->where('faturamento_outubro', '<=', $faturamentoOutubro);            
        }
        if(isset($faturamentoNovembro)){
            $query->where('faturamento_novembro', '<=', $faturamentoNovembro);
        }
        if(isset($faturamentoDezembro)){
            $query->where('faturamento_dezembro', '<=', $faturamentoDezembro);
        }
        if(isset($empregosOutubro)){
            $query->where('empregos_gerados_trimestre_outubro', '<=', $empregosOutubro);
        }
        if(isset($empregosNovembro)){
            $query->where('empregos_gerados_trimestre_novembro', '<=', $empregosNovembro);
        }
        if(isset($empregosDezembro)){
            $query->where('empregos_gerados_trimestre_dezembro', '<=', $empregosDezembro);
        }
        if(isset($empregosProedi)){
            $query->where('empregos_gerados_proedi', '<=', $empregosProedi);
        }
        if(isset($materiaPrimaAdquiridaRN)){
            $query->where('materia_prima_adquirida_rn', '=', $materiaPrimaAdquiridaRN);
        }
        if(isset($icmsDevidoOutubro)){
            $query->where('icms_total_devido_outubro', '<=', $icmsDevidoOutubro);
        }
        if(isset($icmsDevidoNovembro)){
            $query->where('icms_total_devido_novembro', '=', $icmsDevidoNovembro);
        }
        if(isset($icmsDevidoDezembro)){
            $query->where('icms_total_devido_dezembro', '<=', $icmsDevidoDezembro);
        }
        if(isset($icmsPagoOutubro)){
            $query->where('icms_total_pago_outubro', '<=', $icmsPagoOutubro);
        }
        if(isset($icmsPagoNovembro)){
            $query->where('icms_total_pago_novembro', '<=', $icmsPagoNovembro);
        }
        if(isset($icmsPagoDezembro)){
            $query->where('icms_total_pago_dezembro', '<=', $icmsPagoDezembro);
        }
        if(isset($investimentoProjetado)){
            $query->where('investimento_projetado', '<=', $investimentoProjetado);
        }
        if(isset($investimentoRealizadoOutubro)){
            $query->where('investimento_realizado_outubro', '<=', $investimentoRealizadoOutubro);
        }
        if(isset($investimentoRealizadoNovembro)){
            $query->where('investimento_realizado_novembro', '<=', $investimentoRealizadoNovembro);
        }
        if(isset($investimentoRealizadoDezembro)){
            $query->where('investimento_realizado_dezembro', '<=', $investimentoRealizadoDezembro);
        }
        if(isset($investimentoRealizadoProedi)){
            $query->where('investimento_total_realizado', '<=', $investimentoRealizadoProedi);
        }
        if(isset($empregosDiretosAtuais)){
            $query->where('n_empregos_diretos_atuais', '<=', $empregosDiretosAtuais);
        }
        if(isset($menoresAprendizes)){
            $query->where('possui_menores_aprendizes', '<=', $menoresAprendizes);
        }
        if(isset($estagiarios)){
            $query->where('possui_estagiarios', '<=', $estagiarios);
        }
        if(isset($trainees)){
            $query->where('possui_trainee', '<=', $trainees);
        }
        if(isset($destino_mercadoria)){
            $query->where('destino_mercadoria', '<=', $destino_mercadoria);
        }

        $trimestres = $query->paginate();

        //dd($trimestres);
     
       if($request->input('enviar')){
        session()->put('trimestres', $trimestres);
        return view('admin.reports.proedi.quarto_trimestre.trimestre', compact('trimestres'));
       }
              
       if($request->input('relatorio_excel')){        
         $trimestres = session('trimestres');        
         return Excel::download( new QuartoTrimestreExport($trimestres), 'quarto_trimestre.xlsx');        
       }

       if($request->input('relatorio_csv')){        
        $trimestres = session('trimestres');        
        return Excel::download( new QuartoTrimestreExport($trimestres), 'quarto_trimestre.csv');        
      }
      if($request->input('relatorio_ods')){        
        $trimestres = session('trimestres');        
        return Excel::download( new QuartoTrimestreExport($trimestres), 'quarto_trimestre.ods');        
      }
    }
   
    public function trimestreExcel() {
          
        
        //return Excel::download( new TrimestreExport, 'trimestre.xlsx');
    }
}
