<?php

namespace App\Http\Controllers\Proedi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRelatorioSegundoTrimestre;
use App\Mail\proedi\relatorio\AtualizarRelatorioProediSegundo;
use App\Mail\proedi\relatorio\AtualizarRelatorioProediSegundoSemAnexo;
use App\Mail\proedi\relatorio\PedirEdicaoSegundoRelatorio;
use App\Models\proedi\EnviarRelatorioSegundoTrimestre;
use App\Models\Tenant;
use App\Notifications\proedi\admin\email\relatorio;
use App\Notifications\proedi\admin\email\RelatorioSegundoTrimestre;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class RelatorioSegundoTrimestreController extends Controller
{
    public function __construct(EnviarRelatorioSegundoTrimestre $enviarRelatorio)
    {
        $this->repository = $enviarRelatorio;
    }

    public function index() {
        
        $segundos = $this->repository->latest()->paginate();

        //return view('admin.proedi.relatorio_trimestral.index', compact('segundos'));

        return redirect()->route('proedi.relatorio.index');
    }

    /*public function show($id) {

        if(!$relatorio = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.proedi.relatorio_trimestral.show', compact('relatorio'));
    } */

    public function file($file) {

        return response()->file('storage/app/public/'.$file);
    }

    public function create() {

        return view('admin.proedi.relatorio_trimestral.create');
    }

    public function stringToInt($money){

      $cover = str_replace(",", "", $money);

      $coverd = str_replace(".", "", $cover);
     
      $var = intval($coverd);

      $n = $var / 100;

      return $n;
  }

    public function store(StoreUpdateRelatorioSegundoTrimestre $request) {
        
      $data = $request->all();

      $faturamentoAbril = $data['faturamento_abril'];
      $faturamentoMaio = $data['faturamento_maio'];
      $faturamentoJunho = $data['faturamento_junho'];
      $icmsDevidoAbril = $data['icms_total_devido_abril']; 
      $icmsDevidoMaio = $data['icms_total_devido_maio']; 
      $icmsDevidoJunho = $data['icms_total_devido_junho'];
      $icmsPagoAbril = $data['icms_total_pago_abril']; 
      $icmsPagoMaio = $data['icms_total_pago_maio']; 
      $icmsPagoJunho = $data['icms_total_pago_junho']; 
      $investimentoProjetado = $data['investimento_projetado']; 
      $investimentoRealizadoAbril = $data['investimento_realizado_abril']; 
      $investimentoRealizadoMaio = $data['investimento_realizado_maio'];
      $investimentoRealizadoJunho = $data['investimento_realizado_junho']; 
      $investimentoRealizadoProedi = $data['investimento_total_realizado'];

      $data['faturamento_abril'] = $this->stringToInt($faturamentoAbril);
      $data['faturamento_maio'] = $this->stringToInt($faturamentoMaio);
      $data['faturamento_junho'] = $this->stringToInt($faturamentoJunho);
      $data['icms_total_devido_abril'] = $this->stringToInt($icmsDevidoAbril);
      $data['icms_total_devido_maio'] = $this->stringToInt($icmsDevidoMaio);
      $data['icms_total_devido_junho'] = $this->stringToInt($icmsDevidoJunho);
      $data['icms_total_pago_abril'] = $this->stringToInt($icmsPagoAbril);
      $data['icms_total_pago_maio'] = $this->stringToInt($icmsPagoMaio);
      $data['icms_total_pago_junho'] = $this->stringToInt($icmsPagoJunho);
      $data['investimento_projetado'] = $this->stringToInt($investimentoProjetado);
      $data['investimento_realizado_abril'] = $this->stringToInt($investimentoRealizadoAbril);
      $data['investimento_realizado_maio'] = $this->stringToInt($investimentoRealizadoMaio);
      $data['investimento_realizado_junho'] = $this->stringToInt($investimentoRealizadoJunho);
      $data['investimento_total_realizado'] = $this->stringToInt($investimentoRealizadoProedi);

    /**
     * Razão Social, CNPJ e Nome Fantasia
     */

      $tenant = auth()->user()->tenant;
      $data['razao_social'] = $tenant->social_name;
      $data['cnpj'] = $tenant->cnpj;

      $data['nome_fantasia'] = auth()->user()->name;

    /**
     * concatena os outros benefícios
     */ 
        $outros = $data['outros'];

        //dd($outros);
        
        if($outros == "sim") {
            
            $arrayToString = implode(',', $request->input('outros_beneficios'));
            $data['outros_beneficios'] = $arrayToString;

        } elseif($outros == "nao") {
            
            $data['outros_beneficios'] = "Não";
        }  

        //dd($data['outros_beneficios']);
             

       /**
       *  Anexe Uma Foto da Placa PROEDI
       */
      $placa = $data['placa_proedi']; 

      if($placa == "sim") {

       $placa_proedi = $request->placa_proedi_upload;

       $fileplaca_proedi = time().'.'.$placa_proedi->getClientOriginalName();
 
       $request->placa_proedi_upload->move(storage_path(), $fileplaca_proedi);
 
       $data['placa_proedi_upload'] =  $fileplaca_proedi;

      } elseif($placa == "nao") {

       $data['placa_proedi'] = "Não Possui Placa PROEDI";
      }
      
      /**
       *  Anexe O Comprovante do Faturamento Até 30/06
       */
      $faturamento_upload = $request->faturamento_upload;

      $filefaturamento_upload = time().'.'.$faturamento_upload->getClientOriginalName();

      $request->faturamento_upload->move(storage_path(), $filefaturamento_upload);

      $data['faturamento_upload'] =  $filefaturamento_upload;

      /**
       *  Anexe O Comprovante Com o Número de Empregos Diretos Gerados Até 30/06
       */
      $empregos_gerados_trimestre = $request->empregos_gerados_trimestre_upload;

      $fileempregos_gerados_trimestre = time().'.'.$empregos_gerados_trimestre->getClientOriginalName();

      $request->empregos_gerados_trimestre_upload->move(storage_path(), $fileempregos_gerados_trimestre);

      $data['empregos_gerados_trimestre_upload'] =  $fileempregos_gerados_trimestre;

      /**
       *  Anexe O Comprovante Com o Número de Empregos Diretos Gerados a Partir da Adesão ao PROEDI
       */
      $empregos_gerados_proedi = $request->empregos_gerados_proedi_upload;

      $fileempregos_gerados_proedi = time().'.'.$empregos_gerados_proedi->getClientOriginalName();

      $request->empregos_gerados_proedi_upload->move(storage_path(), $fileempregos_gerados_proedi);

      $data['empregos_gerados_proedi_upload'] =  $fileempregos_gerados_proedi;
    
      /**
       * Anexe O Comprovante de Matéria Prima Adquirida No RN(atual)
       */
      $materia_prima_adquirida = $request->materia_prima_adquirida_rn_upload;

      $filemateria_prima_adquirida = time().'.'.$materia_prima_adquirida->getClientOriginalName();

      $request->materia_prima_adquirida_rn_upload->move(storage_path(), $filemateria_prima_adquirida);

      $data['materia_prima_adquirida_rn_upload'] =  $filemateria_prima_adquirida;

      /**
       * Anexe O Comprovante do ICMS Total Devido Até 30/06
       */
      $icms_total_devido = $request->icms_total_devido_upload;

      $fileicms_total_devido = time().'.'.$icms_total_devido->getClientOriginalName();

      $request->icms_total_devido_upload->move(storage_path(), $fileicms_total_devido);

      $data['icms_total_devido_upload'] =  $fileicms_total_devido;

      /**
       * Anexe O Comprovante do ICMS Total Pago até 30/06
       */
      $icms_total_pago = $request->icms_total_pago_upload;

      $fileicms_total_pago = time().'.'.$icms_total_pago->getClientOriginalName();

      $request->icms_total_pago_upload->move(storage_path(), $fileicms_total_pago);

      $data['icms_total_pago_upload'] =  $fileicms_total_pago;

      /**
       * Anexe O Comprovante do Investimento Projetado (Próximo Ano) (R$)
       */
      $investimento_projetado = $request->investimento_projetado_upload;

      $fileinvestimento_projetado = time().'.'.$investimento_projetado->getClientOriginalName();

      $request->investimento_projetado_upload->move(storage_path(), $fileinvestimento_projetado);

      $data['investimento_projetado_upload'] =  $fileinvestimento_projetado;

      /**
       * Anexe O Comprovante do Investimento Realizado Até 30/06
       */
      $investimento_realizado = $request->investimento_realizado_upload;

      $fileinvestimento_realizado = time().'.'.$investimento_realizado->getClientOriginalName();

      $request->investimento_realizado_upload->move(storage_path(), $fileinvestimento_realizado);

      $data['investimento_realizado_upload'] =  $fileinvestimento_realizado;

      /**
       * Anexe O Comprovante do Investimento Total Realizado a Partir da Adesão ao PROEDI
       */
      $investimento_total_realizado = $request->investimento_total_realizado_upload;

      $fileinvestimento_total_realizado = time().'.'.$investimento_total_realizado->getClientOriginalName();

      $request->investimento_total_realizado_upload->move(storage_path(), $fileinvestimento_total_realizado);

      $data['investimento_total_realizado_upload'] =  $fileinvestimento_total_realizado;

      /**
       * Anexe O Comprovante do Número de Empregos Diretos Atuais (Por Função)
       */
      $n_empregos_diretos_atuais = $request->n_empregos_diretos_atuais_upload;

      $filen_empregos_diretos_atuais = time().'.'.$n_empregos_diretos_atuais->getClientOriginalName();

      $request->n_empregos_diretos_atuais_upload->move(storage_path(), $filen_empregos_diretos_atuais);

      $data['n_empregos_diretos_atuais_upload'] =  $filen_empregos_diretos_atuais;

      /**
       * Anexe O Comprovante De Que Possui Menores Aprendizes
       */
      $aprendizes = $data['aprendizes'];

      if($aprendizes == "sim") {

        $possui_menores_aprendizes = $request->possui_menores_aprendizes_upload;

        $filepossui_menores_aprendizes = time().'.'.$possui_menores_aprendizes->getClientOriginalName();
  
        $request->possui_menores_aprendizes_upload->move(storage_path(), $filepossui_menores_aprendizes);
  
        $data['possui_menores_aprendizes_upload'] =  $filepossui_menores_aprendizes;

      } else {

        $data['possui_menores_aprendizes'] = "Não Possui Menores Aprendizes";
      }
          
      /**
       * Anexe O Comprovante De Que Possui Estagiários
       */
      $estagiarios = $data['estagiarios'];

    if($estagiarios == "sim") {

      $possui_estagiarios = $request->possui_estagiarios_upload;

      $filepossui_estagiarios = time().'.'.$possui_estagiarios->getClientOriginalName();

      $request->possui_estagiarios_upload->move(storage_path(), $filepossui_estagiarios);

      $data['possui_estagiarios_upload'] =  $filepossui_estagiarios;
        
    } else {

        $data['possui_estagiarios'] = "Não Possui Estagiários";
    }
      
      /**
       * Anexe O Comprovante De Que Possui Trainee
       */
    $trainee = $data['trainee'];

    if($trainee == "sim") {

      $possui_trainee = $request->possui_trainee_upload;

      $filepossui_trainee = time().'.'.$possui_trainee->getClientOriginalName();

      $request->possui_trainee_upload->move(storage_path(), $filepossui_trainee);

      $data['possui_trainee_upload'] =  $filepossui_trainee;
        
    } else {

        $data['possui_trainee'] = "Não Possui Trainee";
    }              

      /**
       * Anexe O Comprovante Do Destino da Mercadoria
       */
      $destino_mercadoria = $request->destino_mercadoria_upload;

      $filedestino_mercadoria = time().'.'.$destino_mercadoria->getClientOriginalName();

      $request->destino_mercadoria_upload->move(storage_path(), $filedestino_mercadoria);

      $data['destino_mercadoria_upload'] =  $filedestino_mercadoria;
      
      /**
       *  armazenar no banco de dados
       */
      $relatorio = $this->repository->create($data);

      $profiles = Tenant::where('name', '=', 'sedecrn')->first();

      $email = $profiles->users()->first();

      Notification::send($email, new RelatorioSegundoTrimestre($relatorio));
      
      return redirect()->route('proedi.relatorio.index');
    }

    public function edit($id) {

      if (!$relatorio = $this->repository->find($id)) {

          return redirect()->back();
      }

      return view('admin.proedi.relatorio_segundo_trimestre.edit', compact('relatorio'));
    }

    public function pedirEdicao($id) {
      if (!$relatorio = $this->repository->find($id)) {
            return redirect()->back();
      }

      $relatorio['pedir_editar'] = true;

      $relatorio->update();

      Mail::to('codit.sedecrn@gmail.com')->send(new PedirEdicaoSegundoRelatorio($relatorio));

      return $this->index();
    }

    public function update(Request $request, $id) {

      
      if (!$relatorio = $this->repository->find($id)) {

        return redirect()->back();
    }

    $data = $request->all();

    $user_id = Auth::user()->id;

    if ($user = User::find($user_id));

    $datas = [];

    $faturamentoAbril = $data['faturamento_abril'];
    $faturamentoMaio = $data['faturamento_maio'];
    $faturamentoJunho = $data['faturamento_junho'];
    $icmsDevidoAbril = $data['icms_total_devido_abril']; 
    $icmsDevidoMaio = $data['icms_total_devido_maio']; 
    $icmsDevidoJunho = $data['icms_total_devido_junho'];
    $icmsPagoAbril = $data['icms_total_pago_abril']; 
    $icmsPagoMaio = $data['icms_total_pago_maio']; 
    $icmsPagoJunho = $data['icms_total_pago_junho']; 
    $investimentoProjetado = $data['investimento_projetado']; 
    $investimentoRealizadoAbril = $data['investimento_realizado_abril']; 
    $investimentoRealizadoMaio = $data['investimento_realizado_maio'];
    $investimentoRealizadoJunho = $data['investimento_realizado_junho']; 
    $investimentoRealizadoProedi = $data['investimento_total_realizado'];

    $data['faturamento_abril'] = $this->stringToInt($faturamentoAbril);
    $data['faturamento_maio'] = $this->stringToInt($faturamentoMaio);
    $data['faturamento_junho'] = $this->stringToInt($faturamentoJunho);
    $data['icms_total_devido_abril'] = $this->stringToInt($icmsDevidoAbril);
    $data['icms_total_devido_maio'] = $this->stringToInt($icmsDevidoMaio);
    $data['icms_total_devido_junho'] = $this->stringToInt($icmsDevidoJunho);
    $data['icms_total_pago_abril'] = $this->stringToInt($icmsPagoAbril);
    $data['icms_total_pago_maio'] = $this->stringToInt($icmsPagoMaio);
    $data['icms_total_pago_junho'] = $this->stringToInt($icmsPagoJunho);
    $data['investimento_projetado'] = $this->stringToInt($investimentoProjetado);
    $data['investimento_realizado_abril'] = $this->stringToInt($investimentoRealizadoAbril);
    $data['investimento_realizado_maio'] = $this->stringToInt($investimentoRealizadoMaio);
    $data['investimento_realizado_junho'] = $this->stringToInt($investimentoRealizadoJunho);
    $data['investimento_total_realizado'] = $this->stringToInt($investimentoRealizadoProedi);
    
    if ($user->hasEmail($user->email) && $relatorio->editar == 1) {
      
      if (isset($data['outros'])) {

        $outros = $data['outros'];
        
        if($outros == "sim") {
            
            $arrayToString = implode(',', $request->input('outros_beneficios'));
            $data['outros_beneficios'] = $arrayToString;

        } elseif($outros == "nao") {
            
            $data['outros_beneficios'] = "Não";
        }
      }

      if ( $data['outros_beneficios'] != $data['beneficios'] && !isset($data['outros'])) {

        $data['outros_beneficios'] = $data['beneficios'];
      }

      if (isset($data['placa_proedi_upload'])){

        $placa = $data['placa_proedi']; 

        if($placa == "sim") {
 
         $placa_proedi = $request->placa_proedi_upload;
 
         $fileplaca_proedi = time().'.'.$placa_proedi->getClientOriginalName();
   
         $request->placa_proedi_upload->move(storage_path(), $fileplaca_proedi);
   
         $data['placa_proedi_upload'] =  $fileplaca_proedi;
         
         $dat[] =  $data['placa_proedi_upload'];

                $datas = [
                  'files' => $dat
                ];
 
        } elseif($placa == "nao") {
 
         $data['placa_proedi'] = "Não Possui Placa PROEDI";
        }
      }

      if (isset($data['faturamento_upload'])) {
  
        $faturamento_upload = $request->faturamento_upload;

        $filefaturamento_upload = time().'.'.$faturamento_upload->getClientOriginalName();
  
        $request->faturamento_upload->move(storage_path(), $filefaturamento_upload);
  
        $data['faturamento_upload'] =  $filefaturamento_upload;

        $dat[] =  $data['faturamento_upload'];

          $datas = [
            'files' => $dat
          ];
      }

      if (isset($data['empregos_gerados_trimestre_upload'])) {

        $empregos_gerados_trimestre = $request->empregos_gerados_trimestre_upload;

        $fileempregos_gerados_trimestre = time().'.'.$empregos_gerados_trimestre->getClientOriginalName();
  
        $request->empregos_gerados_trimestre_upload->move(storage_path(), $fileempregos_gerados_trimestre);
  
        $data['empregos_gerados_trimestre_upload'] =  $fileempregos_gerados_trimestre;

        $dat[] =  $data['empregos_gerados_trimestre_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['empregos_gerados_proedi_upload'])) {

        $empregos_gerados_proedi = $request->empregos_gerados_proedi_upload;

        $fileempregos_gerados_proedi = time().'.'.$empregos_gerados_proedi->getClientOriginalName();
  
        $request->empregos_gerados_proedi_upload->move(storage_path(), $fileempregos_gerados_proedi);
  
        $data['empregos_gerados_proedi_upload'] =  $fileempregos_gerados_proedi;
        
        $dat[] =  $data['empregos_gerados_proedi_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['materia_prima_adquirida_rn_upload'])) {

        $materia_prima_adquirida = $request->materia_prima_adquirida_rn_upload;

        $filemateria_prima_adquirida = time().'.'.$materia_prima_adquirida->getClientOriginalName();
  
        $request->materia_prima_adquirida_rn_upload->move(storage_path(), $filemateria_prima_adquirida);
  
        $data['materia_prima_adquirida_rn_upload'] =  $filemateria_prima_adquirida;
        
        $dat[] =  $data['materia_prima_adquirida_rn_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['icms_total_devido_upload'])) {

        $icms_total_devido = $request->icms_total_devido_upload;

        $fileicms_total_devido = time().'.'.$icms_total_devido->getClientOriginalName();
  
        $request->icms_total_devido_upload->move(storage_path(), $fileicms_total_devido);
  
        $data['icms_total_devido_upload'] =  $fileicms_total_devido;
  
        $dat[] =  $data['icms_total_devido_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['icms_total_pago_upload'])) {

        $icms_total_pago = $request->icms_total_pago_upload;

        $fileicms_total_pago = time().'.'.$icms_total_pago->getClientOriginalName();
  
        $request->icms_total_pago_upload->move(storage_path(), $fileicms_total_pago);
  
        $data['icms_total_pago_upload'] =  $fileicms_total_pago;
        
        $dat[] =  $data['icms_total_pago_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['investimento_projetado_upload'])) {

        $investimento_projetado = $request->investimento_projetado_upload;

        $fileinvestimento_projetado = time().'.'.$investimento_projetado->getClientOriginalName();
  
        $request->investimento_projetado_upload->move(storage_path(), $fileinvestimento_projetado);
  
        $data['investimento_projetado_upload'] =  $fileinvestimento_projetado;
        
        $dat[] =  $data['investimento_projetado_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['investimento_realizado_upload'])) {

        $investimento_realizado = $request->investimento_realizado_upload;

        $fileinvestimento_realizado = time().'.'.$investimento_realizado->getClientOriginalName();
  
        $request->investimento_realizado_upload->move(storage_path(), $fileinvestimento_realizado);
  
        $data['investimento_realizado_upload'] =  $fileinvestimento_realizado;
        
        $dat[] =  $data['investimento_realizado_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['investimento_total_realizado_upload'])) {

        $investimento_total_realizado = $request->investimento_total_realizado_upload;

        $fileinvestimento_total_realizado = time().'.'.$investimento_total_realizado->getClientOriginalName();
  
        $request->investimento_total_realizado_upload->move(storage_path(), $fileinvestimento_total_realizado);
  
        $data['investimento_total_realizado_upload'] =  $fileinvestimento_total_realizado;

        $dat[] =  $data['investimento_total_realizado_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['n_empregos_diretos_atuais_upload'])) {

        $n_empregos_diretos_atuais = $request->n_empregos_diretos_atuais_upload;

        $filen_empregos_diretos_atuais = time().'.'.$n_empregos_diretos_atuais->getClientOriginalName();
  
        $request->n_empregos_diretos_atuais_upload->move(storage_path(), $filen_empregos_diretos_atuais);
  
        $data['n_empregos_diretos_atuais_upload'] =  $filen_empregos_diretos_atuais;

        $dat[] =  $data['n_empregos_diretos_atuais_upload'];

                $datas = [
                  'files' => $dat
                ];
      }   

      if (isset($data['aprendizes'])) {

        $aprendizes = $data['aprendizes'];

        if($aprendizes == "sim") {
  
          if (isset($data['possui_menores_aprendizes_upload'])) {
  
            $possui_menores_aprendizes = $request->possui_menores_aprendizes_upload;
  
            $filepossui_menores_aprendizes = time().'.'.$possui_menores_aprendizes->getClientOriginalName();
      
            $request->possui_menores_aprendizes_upload->move(storage_path(), $filepossui_menores_aprendizes);
      
            $data['possui_menores_aprendizes_upload'] =  $filepossui_menores_aprendizes;

            $dat[] =  $data['possui_menores_aprendizes_upload'];

                $datas = [
                  'files' => $dat
                ];
          }        
  
        } else {
  
          $data['possui_menores_aprendizes'] = "Não Possui Menores Aprendizes";
        }
      }

      if (isset($data['estagiarios'])) {

        $estagiarios = $data['estagiarios'];

        if($estagiarios == "sim") {
    
          if (isset($data['possui_estagiarios_upload'])) {
    
            $possui_estagiarios = $request->possui_estagiarios_upload;
    
            $filepossui_estagiarios = time().'.'.$possui_estagiarios->getClientOriginalName();
      
            $request->possui_estagiarios_upload->move(storage_path(), $filepossui_estagiarios);
      
            $data['possui_estagiarios_upload'] =  $filepossui_estagiarios;

            $dat[] =  $data['possui_estagiarios_upload'];

                $datas = [
                  'files' => $dat
                ];
          }    
            
        } else {
    
            $data['possui_estagiarios'] = "Não Possui Estagiários";
        }
      }          

    if (isset( $data['trainee'])) {

      $trainee = $data['trainee'];

      if($trainee == "sim") {

        if (isset($data['possui_trainee_upload'])) {
  
          $possui_trainee = $request->possui_trainee_upload;
  
          $filepossui_trainee = time().'.'.$possui_trainee->getClientOriginalName();
    
          $request->possui_trainee_upload->move(storage_path(), $filepossui_trainee);
    
          $data['possui_trainee_upload'] =  $filepossui_trainee;

          $dat[] =  $data['possui_trainee_upload'];

                $datas = [
                  'files' => $dat
                ];
        }     
          
      } else {
  
          $data['possui_trainee'] = "Não Possui Trainee";
      } 
    }      
      
      if (isset($data['destino_mercadoria_upload'])) {

        $destino_mercadoria = $request->destino_mercadoria_upload;

        $filedestino_mercadoria = time().'.'.$destino_mercadoria->getClientOriginalName();
  
        $request->destino_mercadoria_upload->move(storage_path(), $filedestino_mercadoria);
  
        $data['destino_mercadoria_upload'] =  $filedestino_mercadoria;

        $dat[] =  $data['destino_mercadoria_upload'];

                $datas = [
                  'files' => $dat
                ];
        
      }

      if(!empty($dat)) {
                   
        $razao_social = $relatorio->razao_social;
        $nome = $relatorio->nome_fantasia;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediSegundo($datas));

        } else {

          $razao_social = $relatorio->razao_social;
          $nome = $relatorio->nome_fantasia;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediSegundoSemAnexo($datas));

        }

      $relatorio['editar'] = false;

      $relatorio['pedir_editar'] = false;
       
      $relatorio->update($data); 

    } elseif (!$user->hasEmail($user->email) && $user->name != $relatorio->nome_fantasia && $relatorio->editar == 1) {

      $r = $this->repository->find($id)->toArray();

      $r['nome_fantasia'] =  auth()->user()->name;      

      $faturamentoAbril = $request->faturamento_abril;
      $faturamentoMaio = $request->faturamento_maio;
      $faturamentoJunho = $request->faturamento_junho;

      $r['empregos_gerados_trimestre_abril'] = $request->empregos_gerados_trimestre_abril;
      $r['empregos_gerados_trimestre_maio'] = $request->empregos_gerados_trimestre_maio;
      $r['empregos_gerados_trimestre_junho'] = $request->empregos_gerados_trimestre_junho;

      $r['empregos_gerados_proedi'] = $request->empregos_gerados_proedi;

      $r['materia_prima_adquirida_rn'] = $request->materia_prima_adquirida_rn;

      $icmsDevidoAbril = $request->icms_total_devido_abril;
      $icmsDevidoMaio = $request->icms_total_devido_maio;
      $icmsDevidoJunho = $request->icms_total_devido_junho;

      $icmsPagoAbril = $request->icms_total_pago_abril;
      $icmsPagoMaio = $request->icms_total_pago_maio;
      $icmsPagoJunho = $request->icms_total_pago_junho;

      $investimentoProjetado = $request->investimento_projetado;

      $investimentoRealizadoAbril = $request->investimento_realizado_abril;
      $investimentoRealizadoMaio = $request->investimento_realizado_maio;
      $investimentoRealizadoJunho = $request->investimento_realizado_junho;

      $investimentoRealizadoProedi = $request->investimento_total_realizado;

      $r['n_empregos_diretos_atuais'] = $request->n_empregos_diretos_atuais;

      $r['possui_menores_aprendizes'] = $request->possui_menores_aprendizes;

      $r['possui_estagiarios'] = $request->possui_estagiarios;

      $r['possui_trainee'] = $request->possui_trainee;

      $r['destino_mercadoria'] = $request->destino_mercadoria;

      $r['faturamento_abril'] = $this->stringToInt($faturamentoAbril);
      $r['faturamento_maio'] = $this->stringToInt($faturamentoMaio);
      $r['faturamento_junho'] = $this->stringToInt($faturamentoJunho);

      $r['icms_total_devido_abril'] = $this->stringToInt($icmsDevidoAbril);
      $r['icms_total_devido_maio'] = $this->stringToInt($icmsDevidoMaio);
      $r['icms_total_devido_junho'] = $this->stringToInt($icmsDevidoJunho);

      $r['icms_total_pago_abril'] = $this->stringToInt($icmsPagoAbril);
      $r['icms_total_pago_maio'] = $this->stringToInt($icmsPagoMaio);
      $r['icms_total_pago_junho'] = $this->stringToInt($icmsPagoJunho);

      $r['investimento_projetado'] = $this->stringToInt($investimentoProjetado);

      $r['investimento_realizado_abril'] = $this->stringToInt($investimentoRealizadoAbril);
      $r['investimento_realizado_maio'] = $this->stringToInt($investimentoRealizadoMaio);
      $r['investimento_realizado_junho'] = $this->stringToInt($investimentoRealizadoJunho);

      $r['investimento_total_realizado'] = $this->stringToInt($investimentoRealizadoProedi);

      if (isset($data['outros'])) {

        $outros = $data['outros'];
        
        if($outros == "sim") {
            
            $arrayToString = implode(',', $request->input('outros_beneficios'));
            $r['outros_beneficios'] = $arrayToString;

        } elseif($outros == "nao") {
            
            $r['outros_beneficios'] = "Não";
        }
      }

      if ( $data['outros_beneficios'] != $data['beneficios'] && !isset($data['outros'])) {

        $data['outros_beneficios'] = $data['beneficios'];
      }

      if (isset($data['placa_proedi_upload'])){

        $placa = $data['placa_proedi']; 

        if($placa == "sim") {
 
         $placa_proedi = $request->placa_proedi_upload;
 
         $fileplaca_proedi = time().'.'.$placa_proedi->getClientOriginalName();
   
         $request->placa_proedi_upload->move(storage_path(), $fileplaca_proedi);
   
         $r['placa_proedi_upload'] =  $fileplaca_proedi;

         $dat[] =  $r['placa_proedi_upload'];

                $datas = [
                  'files' => $dat
                ];
 
        } elseif($placa == "nao") {
 
         $r['placa_proedi'] = "Não Possui Placa PROEDI";
        }
      }

      if (isset($data['faturamento_upload'])) {
  
        $faturamento_upload = $request->faturamento_upload;

        $filefaturamento_upload = time().'.'.$faturamento_upload->getClientOriginalName();
  
        $request->faturamento_upload->move(storage_path(), $filefaturamento_upload);
  
        $r['faturamento_upload'] =  $filefaturamento_upload;

        $dat[] =  $r['faturamento_upload'];

          $datas = [
            'files' => $dat
          ];
      }

      if (isset($data['empregos_gerados_trimestre_upload'])) {

        $empregos_gerados_trimestre = $request->empregos_gerados_trimestre_upload;

        $fileempregos_gerados_trimestre = time().'.'.$empregos_gerados_trimestre->getClientOriginalName();
  
        $request->empregos_gerados_trimestre_upload->move(storage_path(), $fileempregos_gerados_trimestre);
  
        $r['empregos_gerados_trimestre_upload'] =  $fileempregos_gerados_trimestre;

        $dat[] =  $r['empregos_gerados_trimestre_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['empregos_gerados_proedi_upload'])) {

        $empregos_gerados_proedi = $request->empregos_gerados_proedi_upload;

        $fileempregos_gerados_proedi = time().'.'.$empregos_gerados_proedi->getClientOriginalName();
  
        $request->empregos_gerados_proedi_upload->move(storage_path(), $fileempregos_gerados_proedi);
  
        $r['empregos_gerados_proedi_upload'] =  $fileempregos_gerados_proedi;

        $dat[] =  $r['empregos_gerados_proedi_upload'];

                $datas = [
                  'files' => $dat
                ];
        
      }

      if (isset($data['materia_prima_adquirida_rn_upload'])) {

        $materia_prima_adquirida = $request->materia_prima_adquirida_rn_upload;

        $filemateria_prima_adquirida = time().'.'.$materia_prima_adquirida->getClientOriginalName();
  
        $request->materia_prima_adquirida_rn_upload->move(storage_path(), $filemateria_prima_adquirida);
  
        $r['materia_prima_adquirida_rn_upload'] =  $filemateria_prima_adquirida;

        $dat[] =  $r['materia_prima_adquirida_rn_upload'];

                $datas = [
                  'files' => $dat
                ];
        
      }

      if (isset($data['icms_total_devido_upload'])) {

        $icms_total_devido = $request->icms_total_devido_upload;

        $fileicms_total_devido = time().'.'.$icms_total_devido->getClientOriginalName();
  
        $request->icms_total_devido_upload->move(storage_path(), $fileicms_total_devido);
  
        $r['icms_total_devido_upload'] =  $fileicms_total_devido;
  
        $dat[] =  $r['icms_total_devido_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['icms_total_pago_upload'])) {

        $icms_total_pago = $request->icms_total_pago_upload;

        $fileicms_total_pago = time().'.'.$icms_total_pago->getClientOriginalName();
  
        $request->icms_total_pago_upload->move(storage_path(), $fileicms_total_pago);
  
        $r['icms_total_pago_upload'] =  $fileicms_total_pago;

        $dat[] =  $r['icms_total_pago_upload'];

                $datas = [
                  'files' => $dat
                ];
        
      }

      if (isset($data['investimento_projetado_upload'])) {

        $investimento_projetado = $request->investimento_projetado_upload;

        $fileinvestimento_projetado = time().'.'.$investimento_projetado->getClientOriginalName();
  
        $request->investimento_projetado_upload->move(storage_path(), $fileinvestimento_projetado);
  
        $r['investimento_projetado_upload'] =  $fileinvestimento_projetado;

        $dat[] =  $r['investimento_projetado_upload'];

                $datas = [
                  'files' => $dat
                ];
  
      }

      if (isset($data['investimento_realizado_upload'])) {

        $investimento_realizado = $request->investimento_realizado_upload;

        $fileinvestimento_realizado = time().'.'.$investimento_realizado->getClientOriginalName();
  
        $request->investimento_realizado_upload->move(storage_path(), $fileinvestimento_realizado);
  
        $r['investimento_realizado_upload'] =  $fileinvestimento_realizado;

        $dat[] =  $r['investimento_realizado_upload'];

                $datas = [
                  'files' => $dat
                ];
  
      }

      if (isset($data['investimento_total_realizado_upload'])) {

        $investimento_total_realizado = $request->investimento_total_realizado_upload;

        $fileinvestimento_total_realizado = time().'.'.$investimento_total_realizado->getClientOriginalName();
  
        $request->investimento_total_realizado_upload->move(storage_path(), $fileinvestimento_total_realizado);
  
        $r['investimento_total_realizado_upload'] =  $fileinvestimento_total_realizado;

        $dat[] =  $r['investimento_total_realizado_upload'];

                $datas = [
                  'files' => $dat
                ];
      }

      if (isset($data['n_empregos_diretos_atuais_upload'])) {

        $n_empregos_diretos_atuais = $request->n_empregos_diretos_atuais_upload;

        $filen_empregos_diretos_atuais = time().'.'.$n_empregos_diretos_atuais->getClientOriginalName();
  
        $request->n_empregos_diretos_atuais_upload->move(storage_path(), $filen_empregos_diretos_atuais);
  
        $r['n_empregos_diretos_atuais_upload'] =  $filen_empregos_diretos_atuais;

        $dat[] =  $r['n_empregos_diretos_atuais_upload'];

                $datas = [
                  'files' => $dat
                ];
      }   

      if (isset($data['aprendizes'])) {

        $aprendizes = $data['aprendizes'];

        if($aprendizes == "sim") {
  
          if (isset($data['possui_menores_aprendizes_upload'])) {
  
            $possui_menores_aprendizes = $request->possui_menores_aprendizes_upload;
  
            $filepossui_menores_aprendizes = time().'.'.$possui_menores_aprendizes->getClientOriginalName();
      
            $request->possui_menores_aprendizes_upload->move(storage_path(), $filepossui_menores_aprendizes);
      
            $r['possui_menores_aprendizes_upload'] =  $filepossui_menores_aprendizes;

            $dat[] =  $r['possui_menores_aprendizes_upload'];

                $datas = [
                  'files' => $dat
                ];
          }        
  
        } else {
  
          $data['possui_menores_aprendizes'] = "Não Possui Menores Aprendizes";
        }
      }

      if (isset($data['estagiarios'])) {

        $estagiarios = $data['estagiarios'];

        if($estagiarios == "sim") {
    
          if (isset($data['possui_estagiarios_upload'])) {
    
            $possui_estagiarios = $request->possui_estagiarios_upload;
    
            $filepossui_estagiarios = time().'.'.$possui_estagiarios->getClientOriginalName();
      
            $request->possui_estagiarios_upload->move(storage_path(), $filepossui_estagiarios);
      
            $r['possui_estagiarios_upload'] =  $filepossui_estagiarios;

            $dat[] =  $r['possui_estagiarios_upload'];

                $datas = [
                  'files' => $dat
                ];    
          }    
            
        } else {
    
            $r['possui_estagiarios'] = "Não Possui Estagiários";
        }
      }          

    if (isset( $data['trainee'])) {

      $trainee = $data['trainee'];

      if($trainee == "sim") {

        if (isset($data['possui_trainee_upload'])) {
  
          $possui_trainee = $request->possui_trainee_upload;
  
          $filepossui_trainee = time().'.'.$possui_trainee->getClientOriginalName();
    
          $request->possui_trainee_upload->move(storage_path(), $filepossui_trainee);
    
          $r['possui_trainee_upload'] =  $filepossui_trainee;

          $dat[] =  $r['possui_trainee_upload'];

          $datas = [
            'files' => $dat
          ];
        }     
          
      } else {
  
          $r['possui_trainee'] = "Não Possui Trainee";
      } 
    }      
      
      if (isset($data['destino_mercadoria_upload'])) {

        $destino_mercadoria = $request->destino_mercadoria_upload;

        $filedestino_mercadoria = time().'.'.$destino_mercadoria->getClientOriginalName();
  
        $request->destino_mercadoria_upload->move(storage_path(), $filedestino_mercadoria);
  
        $r['destino_mercadoria_upload'] =  $filedestino_mercadoria;

        $dat[] =  $r['destino_mercadoria_upload'];

          $datas = [
            'files' => $dat
          ];        
      }

      if(!empty($dat)) {
                   
        $razao_social = $relatorio->razao_social;
        $nome = Auth::user()->name;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediSegundo($datas));

        } else {

          $razao_social = $relatorio->razao_social;
          $nome = Auth::user()->name;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediSegundoSemAnexo($datas));

        }

        $relatorio['editar'] = false;

        $relatorio['pedir_editar'] = false;
       
        $relatorio->update();

      $this->repository->create($r);


    } elseif (!$user->hasEmail($user->email) && $user->name == $relatorio->nome_fantasia && $relatorio->editar == 1) {


      if (isset($data['outros'])) {

        $outros = $data['outros'];
        
        if($outros == "sim") {
            
            $arrayToString = implode(',', $request->input('outros_beneficios'));
            $data['outros_beneficios'] = $arrayToString;

        } elseif($outros == "nao") {
            
            $data['outros_beneficios'] = "Não";
        }
      }

      if ( $data['outros_beneficios'] != $data['beneficios'] && !isset($data['outros'])) {

        $data['outros_beneficios'] = $data['beneficios'];
      }

      if (isset($data['placa_proedi_upload'])){

        $placa = $data['placa_proedi']; 

        if($placa == "sim") {
 
         $placa_proedi = $request->placa_proedi_upload;
 
         $fileplaca_proedi = time().'.'.$placa_proedi->getClientOriginalName();
   
         $request->placa_proedi_upload->move(storage_path(), $fileplaca_proedi);
   
         $data['placa_proedi_upload'] =  $fileplaca_proedi;

         $dat[] =  $data['placa_proedi_upload'];

          $datas = [
            'files' => $dat
          ];
 
        } elseif($placa == "nao") {
 
         $data['placa_proedi'] = "Não Possui Placa PROEDI";
        }
      }

      if (isset($data['faturamento_upload'])) {
  
        $faturamento_upload = $request->faturamento_upload;

        $filefaturamento_upload = time().'.'.$faturamento_upload->getClientOriginalName();
  
        $request->faturamento_upload->move(storage_path(), $filefaturamento_upload);
  
        $data['faturamento_upload'] =  $filefaturamento_upload;

        $dat[] =  $data['faturamento_upload'];

          $datas = [
            'files' => $dat
          ];
      }

      if (isset($data['empregos_gerados_trimestre_upload'])) {

        $empregos_gerados_trimestre = $request->empregos_gerados_trimestre_upload;

        $fileempregos_gerados_trimestre = time().'.'.$empregos_gerados_trimestre->getClientOriginalName();
  
        $request->empregos_gerados_trimestre_upload->move(storage_path(), $fileempregos_gerados_trimestre);
  
        $data['empregos_gerados_trimestre_upload'] =  $fileempregos_gerados_trimestre;

        $dat[] =  $data['empregos_gerados_trimestre_upload'];

          $datas = [
            'files' => $dat
          ];
      }

      if (isset($data['empregos_gerados_proedi_upload'])) {

        $empregos_gerados_proedi = $request->empregos_gerados_proedi_upload;

        $fileempregos_gerados_proedi = time().'.'.$empregos_gerados_proedi->getClientOriginalName();
  
        $request->empregos_gerados_proedi_upload->move(storage_path(), $fileempregos_gerados_proedi);
  
        $data['empregos_gerados_proedi_upload'] =  $fileempregos_gerados_proedi;

        $dat[] =  $data['empregos_gerados_proedi_upload'];

          $datas = [
            'files' => $dat
          ];
        
      }

      if (isset($data['materia_prima_adquirida_rn_upload'])) {

        $materia_prima_adquirida = $request->materia_prima_adquirida_rn_upload;

        $filemateria_prima_adquirida = time().'.'.$materia_prima_adquirida->getClientOriginalName();
  
        $request->materia_prima_adquirida_rn_upload->move(storage_path(), $filemateria_prima_adquirida);
  
        $data['materia_prima_adquirida_rn_upload'] =  $filemateria_prima_adquirida;
        
        $dat[] =  $data['materia_prima_adquirida_rn_upload'];

          $datas = [
            'files' => $dat
          ];
      }

      if (isset($data['icms_total_devido_upload'])) {

        $icms_total_devido = $request->icms_total_devido_upload;

        $fileicms_total_devido = time().'.'.$icms_total_devido->getClientOriginalName();
  
        $request->icms_total_devido_upload->move(storage_path(), $fileicms_total_devido);
  
        $data['icms_total_devido_upload'] =  $fileicms_total_devido;
  
        $dat[] =  $data['icms_total_devido_upload'];

          $datas = [
            'files' => $dat
          ];
      }

      if (isset($data['icms_total_pago_upload'])) {

        $icms_total_pago = $request->icms_total_pago_upload;

        $fileicms_total_pago = time().'.'.$icms_total_pago->getClientOriginalName();
  
        $request->icms_total_pago_upload->move(storage_path(), $fileicms_total_pago);
  
        $data['icms_total_pago_upload'] =  $fileicms_total_pago;
        
        $dat[] =  $data['icms_total_pago_upload'];

          $datas = [
            'files' => $dat
          ];
      }

      if (isset($data['investimento_projetado_upload'])) {

        $investimento_projetado = $request->investimento_projetado_upload;

        $fileinvestimento_projetado = time().'.'.$investimento_projetado->getClientOriginalName();
  
        $request->investimento_projetado_upload->move(storage_path(), $fileinvestimento_projetado);
  
        $data['investimento_projetado_upload'] =  $fileinvestimento_projetado;
        
        $dat[] =  $data['investimento_projetado_upload'];

          $datas = [
            'files' => $dat
          ];
      }

      if (isset($data['investimento_realizado_upload'])) {

        $investimento_realizado = $request->investimento_realizado_upload;

        $fileinvestimento_realizado = time().'.'.$investimento_realizado->getClientOriginalName();
  
        $request->investimento_realizado_upload->move(storage_path(), $fileinvestimento_realizado);
  
        $data['investimento_realizado_upload'] =  $fileinvestimento_realizado;

        $dat[] =  $data['investimento_realizado_upload'];

          $datas = [
            'files' => $dat
          ];
  
      }

      if (isset($data['investimento_total_realizado_upload'])) {

        $investimento_total_realizado = $request->investimento_total_realizado_upload;

        $fileinvestimento_total_realizado = time().'.'.$investimento_total_realizado->getClientOriginalName();
  
        $request->investimento_total_realizado_upload->move(storage_path(), $fileinvestimento_total_realizado);
  
        $data['investimento_total_realizado_upload'] =  $fileinvestimento_total_realizado;

        $dat[] =  $data['investimento_total_realizado_upload'];

          $datas = [
            'files' => $dat
          ];
      }

      if (isset($data['n_empregos_diretos_atuais_upload'])) {

        $n_empregos_diretos_atuais = $request->n_empregos_diretos_atuais_upload;

        $filen_empregos_diretos_atuais = time().'.'.$n_empregos_diretos_atuais->getClientOriginalName();
  
        $request->n_empregos_diretos_atuais_upload->move(storage_path(), $filen_empregos_diretos_atuais);
  
        $data['n_empregos_diretos_atuais_upload'] =  $filen_empregos_diretos_atuais;

        $dat[] =  $data['n_empregos_diretos_atuais_upload'];

          $datas = [
            'files' => $dat
          ];
      }   

      if (isset($data['aprendizes'])) {

        $aprendizes = $data['aprendizes'];

        if($aprendizes == "sim") {
  
          if (isset($data['possui_menores_aprendizes_upload'])) {
  
            $possui_menores_aprendizes = $request->possui_menores_aprendizes_upload;
  
            $filepossui_menores_aprendizes = time().'.'.$possui_menores_aprendizes->getClientOriginalName();
      
            $request->possui_menores_aprendizes_upload->move(storage_path(), $filepossui_menores_aprendizes);
      
            $data['possui_menores_aprendizes_upload'] =  $filepossui_menores_aprendizes;

            $dat[] =  $data['possui_menores_aprendizes_upload'];

            $datas = [
              'files' => $dat
            ];
          }        
  
        } else {
  
          $data['possui_menores_aprendizes'] = "Não Possui Menores Aprendizes";
        }
      }

      if (isset($data['estagiarios'])) {

        $estagiarios = $data['estagiarios'];

        if($estagiarios == "sim") {
    
          if (isset($data['possui_estagiarios_upload'])) {
    
            $possui_estagiarios = $request->possui_estagiarios_upload;
    
            $filepossui_estagiarios = time().'.'.$possui_estagiarios->getClientOriginalName();
      
            $request->possui_estagiarios_upload->move(storage_path(), $filepossui_estagiarios);
      
            $data['possui_estagiarios_upload'] =  $filepossui_estagiarios;

            $dat[] =  $data['possui_estagiarios_upload'];

            $datas = [
              'files' => $dat
            ];

          }    
            
        } else {
    
            $data['possui_estagiarios'] = "Não Possui Estagiários";
        }
      }          

    if (isset( $data['trainee'])) {

      $trainee = $data['trainee'];

      if($trainee == "sim") {

        if (isset($data['possui_trainee_upload'])) {
  
          $possui_trainee = $request->possui_trainee_upload;
  
          $filepossui_trainee = time().'.'.$possui_trainee->getClientOriginalName();
    
          $request->possui_trainee_upload->move(storage_path(), $filepossui_trainee);
    
          $data['possui_trainee_upload'] =  $filepossui_trainee;

          $dat[] =  $data['possui_trainee_upload'];

            $datas = [
              'files' => $dat
            ];
        }     
          
      } else {
  
          $data['possui_trainee'] = "Não Possui Trainee";
      } 
    }      
      
      if (isset($data['destino_mercadoria_upload'])) {

        $destino_mercadoria = $request->destino_mercadoria_upload;

        $filedestino_mercadoria = time().'.'.$destino_mercadoria->getClientOriginalName();
  
        $request->destino_mercadoria_upload->move(storage_path(), $filedestino_mercadoria);
  
        $data['destino_mercadoria_upload'] =  $filedestino_mercadoria;

        $dat[] =  $data['destino_mercadoria_upload'];

            $datas = [
              'files' => $dat
            ];        
      }

      if(!empty($dat)) {
                   
        $razao_social = $relatorio->razao_social;
        $nome = $relatorio->nome_fantasia;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediSegundo($datas));

        } else {

          $razao_social = $relatorio->razao_social;
          $nome = $relatorio->nome_fantasia;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediSegundoSemAnexo($datas));

        }

        $relatorio['editar'] = false;

        $relatorio['pedir_editar'] = false;
       
      $relatorio->update($data);

    }
         
      return redirect()->route('proedi.relatorio.index') ;     
     
    }

    public function show($id) {

        if(!$segundo = $this->repository->find($id)) {

            return redirect()->back();
        }

        return view('admin.proedi.relatorio_segundo_trimestre.show' , compact('segundo'));
    }
}
