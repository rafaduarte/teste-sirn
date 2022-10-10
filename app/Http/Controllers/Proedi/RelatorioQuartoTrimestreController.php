<?php

namespace App\Http\Controllers\Proedi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRelatorioQuartoTrimestre;
use App\Mail\proedi\concessao\PedirEdicaoSegundoRelatorio;
use App\Mail\proedi\relatorio\AtualizarRelatorioProediQuarto;
use App\Mail\proedi\relatorio\AtualizarRelatorioProediQuartoSemAnexo;
use App\Mail\proedi\relatorio\PedirEdicaoQuartoRelatorio;
use App\Models\proedi\EnviarRelatorioQuartoTrimestre;
use App\Models\Tenant;
use App\Notifications\proedi\admin\email\relatorio;
use App\Notifications\proedi\admin\email\RelatorioQuartoTrimestre;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class RelatorioQuartoTrimestreController extends Controller
{
    public function __construct(EnviarRelatorioQuartoTrimestre $quartos)
    {
        $this->repository = $quartos;
    }

    public function index() {
        
      return redirect()->route('proedi.relatorio.index');
    }

    public function stringToInt($money){

      $cover = str_replace(",", "", $money);

      $coverd = str_replace(".", "", $cover);
     
      $var = intval($coverd);

      $n = $var / 100;

      return $n;
  }

    public function store(StoreUpdateRelatorioQuartoTrimestre $request) {

      $data = $request->all();

      $faturamentoOutubro = $data['faturamento_outubro'];
      $faturamentoNovembro = $data['faturamento_novembro'];
      $faturamentoDezembro = $data['faturamento_dezembro'];
      $icmsDevidoOutubro = $data['icms_total_devido_outubro']; 
      $icmsDevidoNovembro = $data['icms_total_devido_novembro']; 
      $icmsDevidoDezembro = $data['icms_total_devido_dezembro'];
      $icmsPagoOutubro = $data['icms_total_pago_outubro']; 
      $icmsPagoNovembro = $data['icms_total_pago_novembro']; 
      $icmsPagoDezembro = $data['icms_total_pago_dezembro']; 
      $investimentoProjetado = $data['investimento_projetado']; 
      $investimentoRealizadoOutubro = $data['investimento_realizado_outubro']; 
      $investimentoRealizadoNovembro = $data['investimento_realizado_novembro'];
      $investimentoRealizadoDezembro = $data['investimento_realizado_dezembro']; 
      $investimentoRealizadoProedi = $data['investimento_total_realizado'];

      $data['faturamento_outubro'] = $this->stringToInt($faturamentoOutubro);
      $data['faturamento_novembro'] = $this->stringToInt($faturamentoNovembro);
      $data['faturamento_dezembro'] = $this->stringToInt($faturamentoDezembro);
      $data['icms_total_devido_outubro'] = $this->stringToInt($icmsDevidoOutubro);
      $data['icms_total_devido_novembro'] = $this->stringToInt($icmsDevidoNovembro);
      $data['icms_total_devido_dezembro'] = $this->stringToInt($icmsDevidoDezembro);
      $data['icms_total_pago_outubro'] = $this->stringToInt($icmsPagoOutubro);
      $data['icms_total_pago_novembro'] = $this->stringToInt($icmsPagoNovembro);
      $data['icms_total_pago_dezembro'] = $this->stringToInt($icmsPagoDezembro);
      $data['investimento_projetado'] = $this->stringToInt($investimentoProjetado);
      $data['investimento_realizado_outubro'] = $this->stringToInt($investimentoRealizadoOutubro);
      $data['investimento_realizado_novembro'] = $this->stringToInt($investimentoRealizadoNovembro);
      $data['investimento_realizado_dezembro'] = $this->stringToInt($investimentoRealizadoDezembro);
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
       *  Anexe O Comprovante do Faturamento Até 31/12
       */
      $faturamento_upload = $request->faturamento_upload;

      $filefaturamento_upload = time().'.'.$faturamento_upload->getClientOriginalExtension();

      $request->faturamento_upload->move(storage_path(), $filefaturamento_upload);

      $data['faturamento_upload'] =  $filefaturamento_upload;

      /**
       *  Anexe O Comprovante Com o Número de Empregos Diretos Gerados Até 31/12
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
       * Anexe O Comprovante do ICMS Total Devido Até 31/12
       */
      $icms_total_devido = $request->icms_total_devido_upload;

      $fileicms_total_devido = time().'.'.$icms_total_devido->getClientOriginalName();

      $request->icms_total_devido_upload->move(storage_path(), $fileicms_total_devido);

      $data['icms_total_devido_upload'] =  $fileicms_total_devido;

      /**
       * Anexe O Comprovante do ICMS Total Pago até 31/12
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
       * Anexe O Comprovante do Investimento Realizado Até 31/12
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

      Notification::send($email, new RelatorioQuartoTrimestre($relatorio));

      return redirect()->route('proedi.relatorio.index');
    }

    public function edit($id) {

      if(!$relatorio = $this->repository->find($id)) {

          return redirect()->back();
      }
      return view('admin.proedi.relatorio_quarto_trimestre.edit', compact('relatorio'));

    }

    public function pedirEdicao($id) {
      if (!$relatorio = $this->repository->find($id)) {
            return redirect()->back();
      }

      $relatorio['pedir_editar'] = true;

      $relatorio->update();

      Mail::to('codit.sedecrn@gmail.com')->send(new PedirEdicaoQuartoRelatorio($relatorio));

      return $this->index();
    }

    public function update(Request $request, $id) {

      
      if (!$relatorio = $this->repository->find($id)) {

        return redirect()->back();
    }

    $data = $request->all();

      $faturamentoOutubro = $data['faturamento_outubro'];
      $faturamentoNovembro = $data['faturamento_novembro'];
      $faturamentoDezembro = $data['faturamento_dezembro'];
      $icmsDevidoOutubro = $data['icms_total_devido_outubro']; 
      $icmsDevidoNovembro = $data['icms_total_devido_novembro']; 
      $icmsDevidoDezembro = $data['icms_total_devido_dezembro'];
      $icmsPagoOutubro = $data['icms_total_pago_outubro']; 
      $icmsPagoNovembro = $data['icms_total_pago_novembro']; 
      $icmsPagoDezembro = $data['icms_total_pago_dezembro']; 
      $investimentoProjetado = $data['investimento_projetado']; 
      $investimentoRealizadoOutubro = $data['investimento_realizado_outubro']; 
      $investimentoRealizadoNovembro = $data['investimento_realizado_novembro'];
      $investimentoRealizadoDezembro = $data['investimento_realizado_dezembro']; 
      $investimentoRealizadoProedi = $data['investimento_total_realizado'];

      $data['faturamento_outubro'] = $this->stringToInt($faturamentoOutubro);
      $data['faturamento_novembro'] = $this->stringToInt($faturamentoNovembro);
      $data['faturamento_dezembro'] = $this->stringToInt($faturamentoDezembro);
      $data['icms_total_devido_outubro'] = $this->stringToInt($icmsDevidoOutubro);
      $data['icms_total_devido_novembro'] = $this->stringToInt($icmsDevidoNovembro);
      $data['icms_total_devido_dezembro'] = $this->stringToInt($icmsDevidoDezembro);
      $data['icms_total_pago_outubro'] = $this->stringToInt($icmsPagoOutubro);
      $data['icms_total_pago_novembro'] = $this->stringToInt($icmsPagoNovembro);
      $data['icms_total_pago_dezembro'] = $this->stringToInt($icmsPagoDezembro);
      $data['investimento_projetado'] = $this->stringToInt($investimentoProjetado);
      $data['investimento_realizado_outubro'] = $this->stringToInt($investimentoRealizadoOutubro);
      $data['investimento_realizado_novembro'] = $this->stringToInt($investimentoRealizadoNovembro);
      $data['investimento_realizado_dezembro'] = $this->stringToInt($investimentoRealizadoDezembro);
      $data['investimento_total_realizado'] = $this->stringToInt($investimentoRealizadoProedi);

    $datas = [];

    $user_id = Auth::user()->id;

    if ($user = User::find($user_id));
    
    if ($user->hasEmail($user->email)) {
      
      if (isset($data['outros'])) {

        $outros = $data['outros'];
        
        if($outros == "sim") {
            
            $arrayToString = implode(',', $request->input('outros_beneficios'));
            $data['outros_beneficios'] = $arrayToString;

        } elseif($outros == "nao") {
            
            $data['outros_beneficios'] = "Não";

        } else {

          $data['outros_beneficios'] = $data['beneficios'];
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

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediQuarto($datas));

        } else {

          $razao_social = $relatorio->razao_social;
          $nome = $relatorio->nome_fantasia;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediQuartoSemAnexo($datas));

        }

      $relatorio['editar'] = false;
      $relatorio['pedir_editar'] = false;
       
      $relatorio->update($data); 

    } elseif (!$user->hasEmail($user->email) && $user->name != $relatorio->nome_fantasia && $relatorio->editar == 1) {

      $r = $this->repository->find($id)->toArray();      

      $r['nome_fantasia'] =  auth()->user()->name;

      $faturamentoOutubro = $request->faturamento_outubro;
      $faturamentoNovembro = $request->faturamento_novembro;
      $faturamentoDezembro = $request->faturamento_dezembro;

      $r['empregos_gerados_trimestre_outubro'] = $request->empregos_gerados_trimestre_outubro;
      $r['empregos_gerados_trimestre_novembro'] = $request->empregos_gerados_trimestre_novembro;
      $r['empregos_gerados_trimestre_dezembro'] = $request->empregos_gerados_trimestre_dezembro;

      $r['empregos_gerados_proedi'] = $request->empregos_gerados_proedi;

      $r['materia_prima_adquirida_rn'] = $request->materia_prima_adquirida_rn;

      $icmsDevidoOutubro = $request->icms_total_devido_outubro;
      $icmsDevidoNovembro = $request->icms_total_devido_novembro;
      $icmsDevidoDezembro = $request->icms_total_devido_dezembro;

      $icmsPagoOutubro = $request->icms_total_pago_outubro;
      $icmsPagoNovembro = $request->icms_total_pago_novembro;
      $icmsPagoDezembro = $request->icms_total_pago_dezembro;

      $investimentoProjetado = $request->investimento_projetado;

      $investimentoRealizadoOutubro = $request->investimento_realizado_outubro;
      $investimentoRealizadoNovembro = $request->investimento_realizado_novembro;
      $investimentoRealizadoDezembro = $request->investimento_realizado_dezembro;

      $investimentoRealizadoProedi = $request->investimento_total_realizado;

      $r['n_empregos_diretos_atuais'] = $request->n_empregos_diretos_atuais;

      $r['possui_menores_aprendizes'] = $request->possui_menores_aprendizes;

      $r['possui_estagiarios'] = $request->possui_estagiarios;

      $r['possui_trainee'] = $request->possui_trainee;

      $r['destino_mercadoria'] = $request->destino_mercadoria;

      $r['faturamento_outubro'] = $this->stringToInt($faturamentoOutubro);
      $r['faturamento_novembro'] = $this->stringToInt($faturamentoNovembro);
      $r['faturamento_dezembro'] = $this->stringToInt($faturamentoDezembro);

      $r['icms_total_devido_outubro'] = $this->stringToInt($icmsDevidoOutubro);
      $r['icms_total_devido_novembro'] = $this->stringToInt($icmsDevidoNovembro);
      $r['icms_total_devido_dezembro'] = $this->stringToInt($icmsDevidoDezembro);

      $r['icms_total_pago_outubro'] = $this->stringToInt($icmsPagoOutubro);
      $r['icms_total_pago_novembro'] = $this->stringToInt($icmsPagoNovembro);
      $r['icms_total_pago_dezembro'] = $this->stringToInt($icmsPagoDezembro);

      $r['investimento_projetado'] = $this->stringToInt($investimentoProjetado);

      $r['investimento_realizado_outubro'] = $this->stringToInt($investimentoRealizadoOutubro);
      $r['investimento_realizado_novembro'] = $this->stringToInt($investimentoRealizadoNovembro);
      $r['investimento_realizado_dezembro'] = $this->stringToInt($investimentoRealizadoDezembro);

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
        $nome =  Auth::user()->name;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediQuarto($datas));

        } else {

          $razao_social = $relatorio->razao_social;
          $nome =  Auth::user()->name;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediQuartoSemAnexo($datas));

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

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediQuarto($datas));

        } else {

          $razao_social = $relatorio->razao_social;
          $nome = $relatorio->nome_fantasia;

        array_push($datas, $razao_social, $nome);

        Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRelatorioProediQuartoSemAnexo($datas));

        }

      $relatorio['editar'] = false;

      $relatorio['pedir_editar'] = false;
       
      $relatorio->update($data);

    }
         
      return redirect()->route('proedi.relatorio.index') ;  
     
    }

    public function show($id) {
        
        if(!$quarto = $this->repository->find($id)) {

            return redirect()->back();
        }

        return view('admin.proedi.relatorio_quarto_trimestre.show' , compact('quarto'));
    }
}
