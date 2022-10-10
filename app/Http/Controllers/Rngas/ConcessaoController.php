<?php

namespace App\Http\Controllers\Rngas;

use App\Http\Controllers\Controller;
use App\Http\Requests\RnGas\StoreConcessaoOne;
use App\Http\Requests\RnGas\StoreConcessaoRnGas;
use App\Http\Requests\RnGas\StoreConcessaoThree;
use App\Http\Requests\RnGas\StoreConcessaoTwo;
use App\Mail\rngas\Editado;
use App\Mail\rngas\EditadoComAnexo;
use App\Mail\rngas\PedirEdicaoConcessao;
use App\Models\RnGas\ConcessaoRnGas;
use App\Models\Tenant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ConcessaoController extends Controller
{
    public function __construct(ConcessaoRnGas $pedido)
    {
        $this->repository = $pedido;
    }

    public function index() {

        $pedidos = $this->repository->latest()->paginate();
        
        return view('admin.rngas.concessao.index' , compact('pedidos'));
    }

    public function create() {
        
        return view('admin.rngas.concessao.create');
    }

    public function show($id) {

        if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.rngas.concessao.show', compact('pedido'));

    }

    public function createTwo() {
        
        return view('admin.rngas.concessao.create_two');
    }

    public function createThree() {
        
        return view('admin.rngas.concessao.create_three');
    }

    public function stringToInt($money, $gas){

        if ($gas != 0) {

            $cover = str_replace(".", "", $gas);     
       
        $n = intval($cover);

        return $n;

        }

        if ($money != 0) {

            $cover = str_replace(",", "", $money);

            $coverd = str_replace(".", "", $cover);
           
            $var = intval($coverd);
    
            $n = $var / 10;
    
            if ($n == 0) {
                $n = null;
            }

            return $n;
        }       
    }
    
    public function store(StoreConcessaoOne $request) {
      
      $data = $request->all();

       /**
       *  requerimento
       */
      $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $data['requerimento'] =  $filerequerimento;

      /**
       *  instrumento_constitutivo
       */
      $instrumento_constitutivo = $request->instrumento_constitutivo;

      $fileinstrumento_constitutivo = time().'.'.$instrumento_constitutivo->getClientOriginalName();

      $request->instrumento_constitutivo->move(storage_path(), $fileinstrumento_constitutivo);

      $data['instrumento_constitutivo'] =  $fileinstrumento_constitutivo;

      /**
       *  procuracao
       */
      $procuracao = $request->procuracao;

      $fileprocuracao = time().'.'.$procuracao->getClientOriginalName();

      $request->procuracao->move(storage_path(), $fileprocuracao);

      $data['procuracao'] =  $fileprocuracao;

      /**
       *  contrato_social_aditivos
       */
      $contrato_social_aditivos = $request->contrato_social_aditivos;

      $filecontrato_social_aditivos = time().'.'.$contrato_social_aditivos->getClientOriginalName();

      $request->contrato_social_aditivos->move(storage_path(), $filecontrato_social_aditivos);

      $data['contrato_social_aditivos'] =  $filecontrato_social_aditivos;

      /**
       *  cartao_cnpj
       */
      $cartao_cnpj = $request->cartao_cnpj;

      $filecartao_cnpj = time().'.'.$cartao_cnpj->getClientOriginalName();

      $request->cartao_cnpj->move(storage_path(), $filecartao_cnpj);

      $data['cartao_cnpj'] =  $filecartao_cnpj;

      /**
       *  inscricao_estadual
       */
      $inscricao_estadual = $request->inscricao_estadual;

      $fileinscricao_estadual = time().'.'.$inscricao_estadual->getClientOriginalName();

      $request->inscricao_estadual->move(storage_path(), $fileinscricao_estadual);

      $data['inscricao_estadual'] =  $fileinscricao_estadual;

      /**
       *  certidao_federal
       */
      $certidao_federal = $request->certidao_federal;

      $filecertidao_federal = time().'.'.$certidao_federal->getClientOriginalName();

      $request->certidao_federal->move(storage_path(), $filecertidao_federal);

      $data['certidao_federal'] =  $filecertidao_federal;

      /**
       *  certidao_estadual
       */
      $certidao_estadual = $request->certidao_estadual;

      $filecertidao_estadual = time().'.'.$certidao_estadual->getClientOriginalName();

      $request->certidao_estadual->move(storage_path(), $filecertidao_estadual);

      $data['certidao_estadual'] =  $filecertidao_estadual;

      /**
       *  certidao_municipal
       */
      $certidao_municipal = $request->certidao_municipal;

      $filecertidao_municipal = time().'.'.$certidao_municipal->getClientOriginalName();

      $request->certidao_municipal->move(storage_path(), $filecertidao_municipal);

      $data['certidao_municipal'] =  $filecertidao_municipal;

      /**
       *  certidao_trabalhista
       */
      $certidao_trabalhista = $request->certidao_trabalhista;

      $filecertidao_trabalhista = time().'.'.$certidao_trabalhista->getClientOriginalName();

      $request->certidao_trabalhista->move(storage_path(), $filecertidao_trabalhista);

      $data['certidao_trabalhista'] =  $filecertidao_trabalhista;

      /**
       *  certidao_fgts
       */
      $certidao_fgts = $request->certidao_fgts;

      $filecertidao_fgts = time().'.'.$certidao_fgts->getClientOriginalName();

      $request->certidao_fgts->move(storage_path(), $filecertidao_fgts);

      $data['certidao_fgts'] =  $filecertidao_fgts;

      /**
       *  ata_constituicao
       */
      $ata_constituicao = $request->ata_constituicao;

      $fileata_constituicao = time().'.'.$ata_constituicao->getClientOriginalName();

      $request->ata_constituicao->move(storage_path(), $fileata_constituicao);

      $data['ata_constituicao'] =  $fileata_constituicao;      

      session()->put('data', $data);

      return redirect()->route('rngas.concessao.create.two');

    }

    public function storeTwo(StoreConcessaoTwo $request) {
        
        $data_two = $request->all();

        $projecao_receitas = $data_two['projecao_receitas'];
        $projecao_custos = $data_two['projecao_custos'];
        $investimento = $data_two['investimento'];
        $projecao_fluxo_caixa = $data_two['projecao_fluxo_caixa'];
        $consumo_gas_mes = $data_two['consumo_gas_mes'];
        $demanda_gas_tres_anos = $data_two['demanda_gas_tres_anos'];

        $data_two['projecao_receitas'] = $this->stringToInt($projecao_receitas, 0);
        $data_two['projecao_custos'] = $this->stringToInt($projecao_custos, 0);
        $data_two['investimento'] = $this->stringToInt($investimento, 0);
        $data_two['projecao_fluxo_caixa'] = $this->stringToInt($projecao_fluxo_caixa, 0);

        $data_two['consumo_gas_mes'] = $this->stringToInt(0, $consumo_gas_mes);
        $data_two['demanda_gas_tres_anos'] = $this->stringToInt(0, $demanda_gas_tres_anos);

     
        /**
       *  comprovante_produtos_processos
       */
      $comprovante_produtos_processos = $request->comprovante_produtos_processos;

      $filecomprovante_produtos_processos = time().'.'.$comprovante_produtos_processos->getClientOriginalName();

      $request->comprovante_produtos_processos->move(storage_path(), $filecomprovante_produtos_processos);

      $data_two['comprovante_produtos_processos'] =  $filecomprovante_produtos_processos;

      /**
       *  comprovante_projecao_receitas
       */
      $comprovante_projecao_receitas = $request->comprovante_projecao_receitas;

      $filecomprovante_projecao_receitas = time().'.'.$comprovante_projecao_receitas->getClientOriginalName();

      $request->comprovante_projecao_receitas->move(storage_path(), $filecomprovante_projecao_receitas);

      $data_two['comprovante_projecao_receitas'] =  $filecomprovante_projecao_receitas;

      /**
       *  comprovante_projecao_custos
       */
      $comprovante_projecao_custos = $request->comprovante_projecao_custos;

      $filecomprovante_projecao_custos = time().'.'.$comprovante_projecao_custos->getClientOriginalName();

      $request->comprovante_projecao_custos->move(storage_path(), $filecomprovante_projecao_custos);

      $data_two['comprovante_projecao_custos'] =  $filecomprovante_projecao_custos;

      /**
       *  Comprovante_investimento
       */
      $Comprovante_investimento = $request->Comprovante_investimento;

      $fileComprovante_investimento = time().'.'.$Comprovante_investimento->getClientOriginalName();

      $request->Comprovante_investimento->move(storage_path(), $fileComprovante_investimento);

      $data_two['Comprovante_investimento'] =  $fileComprovante_investimento;

      /**
       *  comprovante_fluxo_caixa
       */
      $comprovante_fluxo_caixa = $request->comprovante_fluxo_caixa;

      $filecomprovante_fluxo_caixa = time().'.'.$comprovante_fluxo_caixa->getClientOriginalName();

      $request->comprovante_fluxo_caixa->move(storage_path(), $filecomprovante_fluxo_caixa);

      $data_two['comprovante_fluxo_caixa'] =  $filecomprovante_fluxo_caixa;

      /**
       *  comprovante_consumo
       */
      $comprovante_consumo = $request->comprovante_consumo;

      $filecomprovante_consumo = time().'.'.$comprovante_consumo->getClientOriginalName();

      $request->comprovante_consumo->move(storage_path(), $filecomprovante_consumo);

      $data_two['comprovante_consumo'] =  $filecomprovante_consumo;

     
      /**
       *  comprovante_demanda
       */
      $comprovante_demanda = $request->comprovante_demanda;

      $filecomprovante_demanda = time().'.'.$comprovante_demanda->getClientOriginalName();

      $request->comprovante_demanda->move(storage_path(), $filecomprovante_demanda);

      $data_two['comprovante_demanda'] =  $filecomprovante_demanda;

      /**
       *  comprovante_percentual_gas
       */
      $comprovante_percentual_gas = $request->comprovante_percentual_gas;

      $filecomprovante_percentual_gas = time().'.'.$comprovante_percentual_gas->getClientOriginalName();

      $request->comprovante_percentual_gas->move(storage_path(), $filecomprovante_percentual_gas);

      $data_two['comprovante_percentual_gas'] =  $filecomprovante_percentual_gas;

      /**
       *  comprovante_quantidade_empregos
       */
      $comprovante_quantidade_empregos = $request->comprovante_quantidade_empregos;

      $filecomprovante_quantidade_empregos = time().'.'.$comprovante_quantidade_empregos->getClientOriginalName();

      $request->comprovante_quantidade_empregos->move(storage_path(), $filecomprovante_quantidade_empregos);

      $data_two['comprovante_quantidade_empregos'] =  $filecomprovante_quantidade_empregos;

      session()->put('data_two', $data_two);

      return redirect()->route('rngas.concessao.create.three');
        
      }

      public function storeThree(StoreConcessaoThree $request) {   
        
        $data_three = $request->all();

        /**
       *  estudo_viabilidade
       */
      $estudo_viabilidade = $request->estudo_viabilidade;

      $fileestudo_viabilidade = time().'.'.$estudo_viabilidade->getClientOriginalName();

      $request->estudo_viabilidade->move(storage_path(), $fileestudo_viabilidade);

      $data_three['estudo_viabilidade'] =  $fileestudo_viabilidade;

      /**
       *  justificativa_tecnico_economica
       */
      $justificativa_tecnico_economica = $request->justificativa_tecnico_economica;

      $filejustificativa_tecnico_economica = time().'.'.$justificativa_tecnico_economica->getClientOriginalName();

      $request->justificativa_tecnico_economica->move(storage_path(), $filejustificativa_tecnico_economica);

      $data_three['justificativa_tecnico_economica'] =  $filejustificativa_tecnico_economica;

      /**
       *  documento_tecnico
       */
      $documento_tecnico = $request->documento_tecnico;

      $filedocumento_tecnico = time().'.'.$documento_tecnico->getClientOriginalName();

      $request->documento_tecnico->move(storage_path(), $filedocumento_tecnico);

      $data_three['documento_tecnico'] =  $filedocumento_tecnico;

      /**
       *  documentos
       */
      if (isset($data_three['documentos'])) {
    
        $documentos = $request->documentos;

        $filedocumentos = time().'.'.$documentos->getClientOriginalName();
  
        $request->documentos->move(storage_path(), $filedocumentos);
  
        $data_three['documentos'] =  $filedocumentos;
      }
        
      $one = session('data');
      $two = session('data_two');

       $all = array_merge($one, $two, $data_three);

       $all['social_name'] = Auth::user()->tenant->social_name;
       $all['nome_empresa'] = Auth::user()->tenant->name;
       $all['cnpj'] = Auth::user()->tenant->cnpj;

      $this->repository->create($all);

      return redirect()->route('rngas.concessao.index');

      }

      public function createUpdateOne() {

        return view('admin.rngas.concessao.edit');
      }

      public function createUpdateTwo() {

        return view('admin.rngas.concessao.edit_two');
      }

      public function createUpdateThree() {

        return view('admin.rngas.concessao.edit_three');
      }

      public function edit($id) {

        session()->put('id', $id);
  
        return view('admin.rngas.concessao.edit');
  
      }

      public function updateOne(Request $request) {     

        $data = $request->all();        

        if (isset($data['requerimento'])) {
    
            $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $data['requerimento'] =  $filerequerimento;
  
            $dat[] =  $data['requerimento'];
  
              $datas = [
                'files_one' => $dat
              ];
          }
  
          if (isset($data['instrumento_constitutivo'])) {
    
            $instrumento_constitutivo = $request->instrumento_constitutivo;

      $fileinstrumento_constitutivo = time().'.'.$instrumento_constitutivo->getClientOriginalName();

      $request->instrumento_constitutivo->move(storage_path(), $fileinstrumento_constitutivo);

      $data['instrumento_constitutivo'] =  $fileinstrumento_constitutivo;
  
            $dat[] =  $data['instrumento_constitutivo'];
  
              $datas = [
                'files_one' => $dat
              ];
          }
    
          if (isset($data['procuracao'])) {
    
            $procuracao = $request->procuracao;

      $fileprocuracao = time().'.'.$procuracao->getClientOriginalName();

      $request->procuracao->move(storage_path(), $fileprocuracao);

      $data['procuracao'] =  $fileprocuracao;
  
            $dat[] =  $data['procuracao'];
  
              $datas = [
                'files_one' => $dat
              ];
          }
    
          if (isset($data['contrato_social_aditivos'])) {
    
            $contrato_social_aditivos = $request->contrato_social_aditivos;

      $filecontrato_social_aditivos = time().'.'.$contrato_social_aditivos->getClientOriginalName();

      $request->contrato_social_aditivos->move(storage_path(), $filecontrato_social_aditivos);

      $data['contrato_social_aditivos'] =  $filecontrato_social_aditivos;
  
            $dat[] =  $data['contrato_social_aditivos'];
  
              $datas = [
                'files_one' => $dat
              ];          
          }
    
          if (isset($data['cartao_cnpj'])) {
    
            $cartao_cnpj = $request->cartao_cnpj;

      $filecartao_cnpj = time().'.'.$cartao_cnpj->getClientOriginalName();

      $request->cartao_cnpj->move(storage_path(), $filecartao_cnpj);

      $data['cartao_cnpj'] =  $filecartao_cnpj;
            
            $dat[] =  $data['cartao_cnpj'];
  
              $datas = [
                'files_one' => $dat
              ];
          }
    
          if (isset($data['inscricao_estadual'])) {
    
            $inscricao_estadual = $request->inscricao_estadual;

            $fileinscricao_estadual = time().'.'.$inscricao_estadual->getClientOriginalName();
      
            $request->inscricao_estadual->move(storage_path(), $fileinscricao_estadual);
      
            $data['inscricao_estadual'] =  $fileinscricao_estadual;
      
            $dat[] =  $data['inscricao_estadual'];
  
              $datas = [
                'files_one' => $dat
              ];
          }
    
          if (isset($data['certidao_federal'])) {
    
            $certidao_federal = $request->certidao_federal;

            $filecertidao_federal = time().'.'.$certidao_federal->getClientOriginalName();
      
            $request->certidao_federal->move(storage_path(), $filecertidao_federal);
      
            $data['certidao_federal'] =  $filecertidao_federal;
  
            $dat[] =  $data['certidao_federal'];
  
              $datas = [
                'files_one' => $dat
              ];          
          }
    
          if (isset($data['certidao_estadual'])) {
    
            $certidao_estadual = $request->certidao_estadual;

      $filecertidao_estadual = time().'.'.$certidao_estadual->getClientOriginalName();

      $request->certidao_estadual->move(storage_path(), $filecertidao_estadual);

      $data['certidao_estadual'] =  $filecertidao_estadual;
            
            $dat[] =  $data['certidao_estadual'];
  
              $datas = [
                'files_one' => $dat
              ]; 
          }
    
          if (isset($data['certidao_municipal'])) {
    
            $certidao_municipal = $request->certidao_municipal;

      $filecertidao_municipal = time().'.'.$certidao_municipal->getClientOriginalName();

      $request->certidao_municipal->move(storage_path(), $filecertidao_municipal);

      $data['certidao_municipal'] =  $filecertidao_municipal;
            
            $dat[] =  $data['certidao_municipal'];
  
              $datas = [
                'files_one' => $dat
              ];
          }
    
          if (isset($data['certidao_trabalhista'])) {
    
            $certidao_trabalhista = $request->certidao_trabalhista;

            $filecertidao_trabalhista = time().'.'.$certidao_trabalhista->getClientOriginalName();
      
            $request->certidao_trabalhista->move(storage_path(), $filecertidao_trabalhista);
      
            $data['certidao_trabalhista'] =  $filecertidao_trabalhista;
  
            $dat[] =  $data['certidao_trabalhista'];
  
              $datas = [
                'files_one' => $dat
              ];
          }
    
          if (isset($data['certidao_fgts'])) {
    
            $certidao_fgts = $request->certidao_fgts;

            $filecertidao_fgts = time().'.'.$certidao_fgts->getClientOriginalName();
      
            $request->certidao_fgts->move(storage_path(), $filecertidao_fgts);
      
            $data['certidao_fgts'] =  $filecertidao_fgts;
  
            $dat[] =  $data['certidao_fgts'];
  
              $datas = [
                'files_one' => $dat
              ];
          }

          if (isset($data['ata_constituicao'])) {
    
            $ata_constituicao = $request->ata_constituicao;

            $fileata_constituicao = time().'.'.$ata_constituicao->getClientOriginalName();
      
            $request->ata_constituicao->move(storage_path(), $fileata_constituicao);
      
            $data['ata_constituicao'] =  $fileata_constituicao; 
  
            $dat[] =  $data['ata_constituicao'];
  
              $datas = [
                'files_one' => $dat
              ];
          }
          
          session()->put('data', $data);

          if(!empty($datas)) {

            session()->put('datas_one', $datas);
          }          

          return view('admin.rngas.concessao.edit_two');
      }

      public function updateTwo(Request $request) {     

        $data_two = $request->all();

        $projecao_receitas = $data_two['projecao_receitas'];
        $projecao_custos = $data_two['projecao_custos'];
        $investimento = $data_two['investimento'];
        $projecao_fluxo_caixa = $data_two['projecao_fluxo_caixa'];

        $consumo_gas_mes = $data_two['consumo_gas_mes'];
        $demanda_gas_tres_anos = $data_two['demanda_gas_tres_anos'];

        //$percentual_gas = $data_two['percentual_gas'];

        //$quantidade_empregos = $data_two['quantidade_empregos'];

        $data_two['projecao_receitas'] = $this->stringToInt($projecao_receitas, 0);
        $data_two['projecao_custos'] = $this->stringToInt($projecao_custos, 0);
        $data_two['investimento'] = $this->stringToInt($investimento, 0);
        $data_two['projecao_fluxo_caixa'] = $this->stringToInt($projecao_fluxo_caixa, 0);

        $data_two['consumo_gas_mes'] = $this->stringToInt(0, $consumo_gas_mes);
        $data_two['demanda_gas_tres_anos'] = $this->stringToInt(0, $demanda_gas_tres_anos);

        //$data_two['percentual_gas'] = $this->stringToInt($faturamento_janeiro);

        //$data_two['quantidade_empregos'] = $this->stringToInt($faturamento_janeiro);

        if( isset($data_two['produtos_processos'])) {


        }

        if (isset($data_two['comprovante_produtos_processos'])) {
    
            $comprovante_produtos_processos = $request->comprovante_produtos_processos;

            $filecomprovante_produtos_processos = time().'.'.$comprovante_produtos_processos->getClientOriginalName();
      
            $request->comprovante_produtos_processos->move(storage_path(), $filecomprovante_produtos_processos);
      
            $data_two['comprovante_produtos_processos'] =  $filecomprovante_produtos_processos;
  
            $dat[] =  $data_two['comprovante_produtos_processos'];
  
              $datas = [
                'files_two' => $dat
              ];
          }
    
          if (isset($data_two['comprovante_projecao_receitas'])) {
    
            $comprovante_projecao_receitas = $request->comprovante_projecao_receitas;

            $filecomprovante_projecao_receitas = time().'.'.$comprovante_projecao_receitas->getClientOriginalName();
      
            $request->comprovante_projecao_receitas->move(storage_path(), $filecomprovante_projecao_receitas);
      
            $data_two['comprovante_projecao_receitas'] =  $filecomprovante_projecao_receitas;
  
            $dat[] =  $data_two['comprovante_projecao_receitas'];
  
              $datas = [
                'files_two' => $dat
              ];          
          }
    
          if (isset($data_two['comprovante_projecao_custos'])) {
    
            $comprovante_projecao_custos = $request->comprovante_projecao_custos;

      $filecomprovante_projecao_custos = time().'.'.$comprovante_projecao_custos->getClientOriginalName();

      $request->comprovante_projecao_custos->move(storage_path(), $filecomprovante_projecao_custos);

      $data_two['comprovante_projecao_custos'] =  $filecomprovante_projecao_custos;
            
            $dat[] =  $data_two['comprovante_projecao_custos'];
  
              $datas = [
                'files_two' => $dat
              ];
          }
    
          if (isset($data_two['Comprovante_investimento'])) {
    
            $Comprovante_investimento = $request->Comprovante_investimento;

            $fileComprovante_investimento = time().'.'.$Comprovante_investimento->getClientOriginalName();
      
            $request->Comprovante_investimento->move(storage_path(), $fileComprovante_investimento);
      
            $data_two['Comprovante_investimento'] =  $fileComprovante_investimento;
      
            $dat[] =  $data_two['Comprovante_investimento'];
  
              $datas = [
                'files_two' => $dat
              ];
          }
    
          if (isset($data_two['comprovante_fluxo_caixa'])) {
    
            $comprovante_fluxo_caixa = $request->comprovante_fluxo_caixa;

            $filecomprovante_fluxo_caixa = time().'.'.$comprovante_fluxo_caixa->getClientOriginalName();
      
            $request->comprovante_fluxo_caixa->move(storage_path(), $filecomprovante_fluxo_caixa);
      
            $data_two['comprovante_fluxo_caixa'] =  $filecomprovante_fluxo_caixa;
  
            $dat[] =  $data_two['comprovante_fluxo_caixa'];
  
              $datas = [
                'files_two' => $dat
              ];          
          }
    
          if (isset($data_two['comprovante_consumo'])) {
    
            $comprovante_consumo = $request->comprovante_consumo;

            $filecomprovante_consumo = time().'.'.$comprovante_consumo->getClientOriginalName();
      
            $request->comprovante_consumo->move(storage_path(), $filecomprovante_consumo);
      
            $data_two['comprovante_consumo'] =  $filecomprovante_consumo;
            
            $dat[] =  $data_two['comprovante_consumo'];
  
              $datas = [
                'files_two' => $dat
              ]; 
          }
    
          if (isset($data_two['comprovante_demanda'])) {
    
            $comprovante_demanda = $request->comprovante_demanda;

      $filecomprovante_demanda = time().'.'.$comprovante_demanda->getClientOriginalName();

      $request->comprovante_demanda->move(storage_path(), $filecomprovante_demanda);

      $data_two['comprovante_demanda'] =  $filecomprovante_demanda;
            
            $dat[] =  $data_two['comprovante_demanda'];
  
              $datas = [
                'files_two' => $dat
              ];
          }
    
          if (isset($data_two['comprovante_percentual_gas'])) {
    
            $comprovante_percentual_gas = $request->comprovante_percentual_gas;

      $filecomprovante_percentual_gas = time().'.'.$comprovante_percentual_gas->getClientOriginalName();

      $request->comprovante_percentual_gas->move(storage_path(), $filecomprovante_percentual_gas);

      $data_two['comprovante_percentual_gas'] =  $filecomprovante_percentual_gas;
  
            $dat[] =  $data_two['comprovante_percentual_gas'];
  
              $datas = [
                'files_two' => $dat
              ];
          }
    
          if (isset($data_two['comprovante_quantidade_empregos'])) {
    
            $comprovante_quantidade_empregos = $request->comprovante_quantidade_empregos;

            $filecomprovante_quantidade_empregos = time().'.'.$comprovante_quantidade_empregos->getClientOriginalName();
      
            $request->comprovante_quantidade_empregos->move(storage_path(), $filecomprovante_quantidade_empregos);
      
            $data_two['comprovante_quantidade_empregos'] =  $filecomprovante_quantidade_empregos;
  
            $dat[] =  $data_two['comprovante_quantidade_empregos'];
  
              $datas = [
                'files_two' => $dat
              ];
          }

          session()->put('data_two', $data_two);

          if(!empty($datas)) {

            session()->put('datas_two', $datas);
          }
        
          return view('admin.rngas.concessao.edit_three');
      }

      public function updateThree(Request $request) {       

        $data_three = $request->all();

        if (isset($data_three['estudo_viabilidade'])) {
    
            $estudo_viabilidade = $request->estudo_viabilidade;

      $fileestudo_viabilidade = time().'.'.$estudo_viabilidade->getClientOriginalName();

      $request->estudo_viabilidade->move(storage_path(), $fileestudo_viabilidade);

      $data_three['estudo_viabilidade'] =  $fileestudo_viabilidade;
            
            $dat[] =  $data_three['estudo_viabilidade'];
  
              $datas = [
                'files' => $dat
              ]; 
          }
    
          if (isset($data_three['justificativa_tecnico_economica'])) {
    
            $justificativa_tecnico_economica = $request->justificativa_tecnico_economica;

            $filejustificativa_tecnico_economica = time().'.'.$justificativa_tecnico_economica->getClientOriginalName();
      
            $request->justificativa_tecnico_economica->move(storage_path(), $filejustificativa_tecnico_economica);
      
            $data_three['justificativa_tecnico_economica'] =  $filejustificativa_tecnico_economica;
            
            $dat[] =  $data_three['justificativa_tecnico_economica'];
  
              $datas = [
                'files' => $dat
              ];
          }
    
          if (isset($data_three['documento_tecnico'])) {
    
            $documento_tecnico = $request->documento_tecnico;

            $filedocumento_tecnico = time().'.'.$documento_tecnico->getClientOriginalName();
      
            $request->documento_tecnico->move(storage_path(), $filedocumento_tecnico);
      
            $data_three['documento_tecnico'] =  $filedocumento_tecnico;
  
            $dat[] =  $data_three['documento_tecnico'];
  
              $datas = [
                'files' => $dat
              ];
          }
    
          if (isset($data_three['documentos'])) {
    
            $documentos = $request->documentos;

            $filedocumentos = time().'.'.$documentos->getClientOriginalName();
      
            $request->documentos->move(storage_path(), $filedocumentos);
      
            $data_three['documentos'] =  $filedocumentos;
  
            $dat[] =  $data_three['documentos'];
  
              $datas = [
                'files' => $dat
              ];
          }

          $one = session('data');
          $two = session('data_two');
          $datas_one = session('datas_one');
          $datas_two = session('datas_two');
          
          if(!empty($datas)) {

            $all = array_merge($one, $two, $data_three, $datas_one, $datas_two, $datas);
          } else {

            $all = array_merge($one, $two, $data_three, $datas_one, $datas_two);
          }

              

       $id = session('id');

       $user_id = Auth::user()->id;

        if ($user = User::find($user_id));

        if (!$pedido = $this->repository->find($id)) {

          return redirect()->back();
       }

       $all['social_name'] = $pedido->social_name;
       $all['nome_empresa'] = Auth::user()->name;
       $all['cnpj'] = $pedido->cnpj;       

       // form_create_two
      
       if(!isset($all['produtos_processos'])) {
          $all['produtos_processos'] = $pedido->produtos_processos;
       }
       if(!isset($all['projecao_receitas'])) {
          $all['projecao_receitas'] = $pedido->projecao_receitas;
       }
       if(!isset($all['projecao_custos'])) {
        $all['projecao_custos'] = $pedido->projecao_custos;
     }
     if(!isset($all['investimento'])) {
      $all['investimento'] = $pedido->investimento;
   }
    if(!isset($all['projecao_fluxo_caixa'])) {
    $all['projecao_fluxo_caixa'] = $pedido->projecao_fluxo_caixa;
 }
  if(!isset($all['consumo_gas_mes'])) {
  $all['consumo_gas_mes'] = $pedido->consumo_gas_mes;
}
  if(!isset($all['demanda_gas_tres_anos'])) {
  $all['demanda_gas_tres_anos'] = $pedido->demanda_gas_tres_anos;
}
  if(!isset($all['percentual_gas'])) {
  $all['percentual_gas'] = $pedido->percentual_gas;
}
  if(!isset($all['quantidade_empregos'])) {
  $all['quantidade_empregos'] = $pedido->quantidade_empregos;
}

// form_create_three

if(!isset($all['nome_tecnico'])) {
  $all['nome_tecnico'] = $pedido->nome_tecnico;
}
if(!isset($all['cpf_tecnico'])) {
  $all['cpf_tecnico'] = $pedido->cpf_tecnico;
}
if(!isset($all['telefone_tecnico'])) {
  $all['telefone_tecnico'] = $pedido->telefone_tecnico;
}
if(!isset($all['endereco_tecnico'])) {
  $all['endereco_tecnico'] = $pedido->endereco_tecnico;
}
if(!isset($all['municipio_tecnico'])) {
  $all['municipio_tecnico'] = $pedido->municipio_tecnico;
}
if(!isset($all['uf_tecnico'])) {
  $all['uf_tecnico'] = $pedido->uf_tecnico;
}      
      if ($user->hasEmail($user->email) && $pedido->editar == 1) {
                
        //dd($all);

        $pedido['editar'] = false;
        $pedido['pedir_editar'] = false;
        
        $pedido->update($all);
        
        //dd($all['files']);

        if(!empty($all['files'])) {

          $file = $all['files'];

          $datas = [
            'files' => $file,
          ];
                   
          $razao_social = $pedido->social_name;
          $nome = $pedido->nome_empresa;
  
          array_push($all, $razao_social, $nome);

          //dd($all);
  
          Mail::to('codit.sedecrn@gmail.com')->send(new EditadoComAnexo($all));
  
          } else {
  
            $razao_social = $pedido->social_name;
            $nome = $pedido->nome_empresa;
  
          array_push($all, $razao_social, $nome);
  
          Mail::to('codit.sedecrn@gmail.com')->send(new Editado($all));
  
          }

      } elseif (!$user->hasEmail($user->email) && $user->name != $pedido->nome_empresa && $pedido->editar == 1) {
        
        $novo = $this->repository->find($pedido->id)->toArray();

        $novo['nome_empresa'] =  auth()->user()->name;
         
       $update = $this->repository->create($novo);

        $update->update($all);

        if(!empty($all['files'])) {

          $file = $all['files'];

          $datas = [
            'files' => $file,
          ];
                   
          $razao_social = $pedido->social_name;
          $nome = auth()->user()->name;
  
          array_push($all, $razao_social, $nome);

          //dd($all);
  
          Mail::to('rafaelduartedelimaa@gmail.com')->send(new EditadoComAnexo($all));
  
          } else {
  
            $razao_social = $pedido->social_name;
            $nome = auth()->user()->name;
  
          array_push($all, $razao_social, $nome);        
  
          }

        Mail::to('rafaelduartedelimaa@gmail.com')->send(new Editado($pedido));

      }  elseif (!$user->hasEmail($user->email) && $user->name == $pedido->nome_empresa && $pedido->editar == 1) {

        $pedido['editar'] = false;
        $pedido['pedir_editar'] = false;

        $pedido->update($all);

        if(!empty($all['files'])) {

          $file = $all['files'];

          $datas = [
            'files' => $file,
          ];
                   
          $razao_social = $pedido->social_name;
          $nome = auth()->user()->name;
  
          array_push($all, $razao_social, $nome);

          //dd($all);
  
          Mail::to('codit.sedecrn@gmail.com')->send(new EditadoComAnexo($all));
  
          } else {
  
            $razao_social = $pedido->social_name;
            $nome = auth()->user()->name;
  
          array_push($all, $razao_social, $nome);
  
          Mail::to('codit.sedecrn@gmail.com')->send(new Editado($all));
  
          }

      }     
       

       /*
       if(!$pedido = $this->repository->find($id)) {

        return redirect()->back();

      } */

          return redirect()->route('rngas.concessao.index');
      }

      public function pedirEdicao($id) {
        
        if (!$pedido = $this->repository->find($id)) {
              return redirect()->back();
        }

        $pedido['pedir_editar'] = true;

        $datas = [];

        $nome = $pedido['social_name'];
        $por = $pedido['nome_empresa'];      

        array_push($datas, $nome, $por);

        //dd($pedido);
  
        //$pedido->update();
  
        Mail::to('rafaelduartedelimaa@gmail.com')->send(new PedirEdicaoConcessao($pedido));
  
        return $this->index();
      }
}
