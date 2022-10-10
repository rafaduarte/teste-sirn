<?php

namespace App\Http\Controllers\Proedi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConcessaoProedi;
use App\Http\Requests\StoreRevisaoProedi;
use App\Mail\proedi\revisao\AtualizarRevisao;
use App\Mail\proedi\revisao\PedirEdicaoRevisao;
use App\Models\proedi\PedirConcessaoProedi;
use App\Models\Tenant;
use App\Models\proedi\PedirRevisaoProedi;
use App\Models\Profile;
use App\Notifications\proedi\admin\email\revisao;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

use function PHPUnit\Framework\isNull;

class PedirRevisaoController extends Controller
{
    public function __construct(PedirRevisaoProedi $pedirProedi)
    {
        $this->repository = $pedirProedi;
    }

    public function index() {

        $pedidos = $this->repository->latest()->paginate();
        
        return view('admin.proedi.revisao.index' , compact('pedidos'));
    }
    public function show($id) {

      if (!$pedido = $this->repository->find($id)) {
          return redirect()->back();
      }
      
      return view('admin.proedi.revisao.show', compact('pedido'));
  }
  /**
   * métodos para exibição dos PDFs
   */
  public function file($file) {

      //$pedido = $this->repository->find($id);
      return response()->file(storage_path($file));
         //return view('admin.proedi.files.concessao.requerimento', compact('pedido'));    
  }

    public function create() {

        return view('admin.proedi.revisao.create');
    }

    public function pedirEdicao($id) {
      
      if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
      }

      $pedido['pedir_editar'] = true;

      $pedido->update();

      Mail::to('codit.sedecrn@gmail.com')->send(new PedirEdicaoRevisao($pedido));

      return $this->index();
    }

    public function store(StoreRevisaoProedi $request) {
        
        //dd($request->all());

        $data = $request->all();

        $data['social_name'] =  auth()->user()->tenant->social_name;

        $data['name'] =  auth()->user()->name;

        $tenant = auth()->user()->tenant; 

        $data['cnpj'] = $tenant->cnpj;

        /**
         * concatena os motivos
         */
        $arrayToString = implode(',', $request->input('motivos'));
        $data['motivos'] = $arrayToString;

       /**
       *  requerimento
       */
      $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $data['requerimento'] =  $filerequerimento;

       /**
       *  certidao_estadual
       */
      $certidao_estadual = $request->certidao_estadual;

      $filecertidao_estadual = time().'.'.$certidao_estadual->getClientOriginalName();

      $request->certidao_estadual->move(storage_path(), $filecertidao_estadual);

      $data['certidao_estadual'] =  $filecertidao_estadual;

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
       *  carta_motivos
       */
      $carta_motivos = $request->carta_motivos;

      $filecarta_motivos = time().'.'.$carta_motivos->getClientOriginalName();

      $request->carta_motivos->move(storage_path(), $filecarta_motivos);

      $data['carta_motivos'] =  $filecarta_motivos;

      /**
       *  mudanca_local
       */
      if (isset($data['mudanca_local'])) {

      $mudanca_local = $request->mudanca_local;

      $filemudanca_local = time().'.'.$mudanca_local->getClientOriginalName();

      $request->mudanca_local->move(storage_path(), $filemudanca_local);

      $data['mudanca_local'] =  $filemudanca_local;
      }

      /**
       *  faturamento
       */
      if (isset($data['faturamento'])) {

      $faturamento = $request->faturamento;

      $filefaturamento = time().'.'.$faturamento->getClientOriginalName();

      $request->faturamento->move(storage_path(), $filefaturamento);

      $data['faturamento'] =  $filefaturamento;

      }

      /**
       *  empregados
       */
      if (isset($data['empregados'])) {
        
      $empregados = $request->empregados;

      $fileempregados = time().'.'.$empregados->getClientOriginalName();

      $request->empregados->move(storage_path(), $fileempregados);

      $data['empregados'] =  $fileempregados;

      }

      /**
       *  materia_prima
       */
      if (isset($data['materia_prima'])) {
        
      $materia_prima = $request->materia_prima;

      $filemateria_prima = time().'.'.$materia_prima->getClientOriginalName();

      $request->materia_prima->move(storage_path(), $filemateria_prima);

      $data['materia_prima'] =  $filemateria_prima;

      }

      /**
       *  investimento_ped
       */
      if (isset($data['investimento_ped'])) {
        
        $investimento_ped = $request->investimento_ped;

        $fileinvestimento_ped = time().'.'.$investimento_ped->getClientOriginalName();
  
        $request->investimento_ped->move(storage_path(), $fileinvestimento_ped);
  
        $data['investimento_ped'] =  $fileinvestimento_ped;
      }

      /**
       *  investimento_conservacao
       */
      if ( isset($data['investimento_conservacao'])) {
        
        $investimento_conservacao = $request->investimento_conservacao;

        $fileinvestimento_conservacao = time().'.'.$investimento_conservacao->getClientOriginalName();
  
        $request->investimento_conservacao->move(storage_path(), $fileinvestimento_conservacao);
  
        $data['investimento_conservacao'] =  $fileinvestimento_conservacao;
      }

       /**
       *  investimento_mao_obra
       */
      if (isset($data['investimento_mao_obra'])) {
       
        $investimento_mao_obra = $request->investimento_mao_obra;

        $fileinvestimento_mao_obra = time().'.'.$investimento_mao_obra->getClientOriginalName();
  
        $request->investimento_mao_obra->move(storage_path(), $fileinvestimento_mao_obra);
  
        $data['investimento_mao_obra'] =  $fileinvestimento_mao_obra;
      }
           
       $revisao = $this->repository->create($data);

       /*
       $profiles = Profile::where('name', '=', 'codit')->first();

       $emails = $profiles->users()->get(); 

       */

      $profiles = Tenant::where('name', '=', 'sedecrn')->first();

      $email = $profiles->users()->first();

      Notification::send($email, new revisao($revisao));

       return redirect()->route('proedi.revisao.index');
    }

    public function edit($id) {

      if (!$pedido = $this->repository->find($id)) {

        return redirect()->back();
      }

      return view('admin.proedi.revisao.edit', compact('pedido'));
    }

    public function update(Request $request, $id, User $user) {

      if (!$pedido = $this->repository->find($id)) {

        return redirect()->back();
      }

      $data = $request->all();

      $user_id = Auth::user()->id;

      if(!$user = User::find($user_id)) {

        return redirect()->back();
      }

      $datas = [];

      /**
       * 
       */
      if ($user->hasEmail($user->email) && $pedido->editar == 1) {

         /**
       *  requerimento
       */
      if (isset($data['requerimento'])) {
       
        $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $data['requerimento'] =  $filerequerimento;

      $dat[] =  $data['requerimento'];

      $datas = [
        'files' => $dat
      ];
      }

      /**
       *  certidao_estadual
       */
      if (isset($data['certidao_estadual'])) {
       
        $certidao_estadual = $request->certidao_estadual;

        $filecertidao_estadual = time().'.'.$certidao_estadual->getClientOriginalName();
  
        $request->certidao_estadual->move(storage_path(), $filecertidao_estadual);
  
        $data['certidao_estadual'] =  $filecertidao_estadual;

        $dat[] =  $data['certidao_estadual'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  certidao_trabalhista
       */
      if (isset($data['certidao_trabalhista'])) {
       
        $certidao_trabalhista = $request->certidao_trabalhista;

      $filecertidao_trabalhista = time().'.'.$certidao_trabalhista->getClientOriginalName();

      $request->certidao_trabalhista->move(storage_path(), $filecertidao_trabalhista);

      $data['certidao_trabalhista'] =  $filecertidao_trabalhista;

      $dat[] =  $data['certidao_trabalhista'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  certidao_fgts
       */
      if (isset($data['certidao_fgts'])) {
       
        $certidao_fgts = $request->certidao_fgts;

      $filecertidao_fgts = time().'.'.$certidao_fgts->getClientOriginalName();

      $request->certidao_fgts->move(storage_path(), $filecertidao_fgts);

      $data['certidao_fgts'] =  $filecertidao_fgts;

      $dat[] =  $data['certidao_fgts'];

        $datas = [
          'files' => $dat
        ];
      
      }

      /**
       *  carta_motivos
       */
      if (isset($data['carta_motivos'])) {
       
        $carta_motivos = $request->carta_motivos;

        $filecarta_motivos = time().'.'.$carta_motivos->getClientOriginalName();
  
        $request->carta_motivos->move(storage_path(), $filecarta_motivos);
  
        $data['carta_motivos'] =  $filecarta_motivos;

        $dat[] =  $data['carta_motivos'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  mudanca_local
       */
      if (isset($data['mudanca_local'])) {
       
        $mudanca_local = $request->mudanca_local;

        $filemudanca_local = time().'.'.$mudanca_local->getClientOriginalName();
  
        $request->mudanca_local->move(storage_path(), $filemudanca_local);
  
        $data['mudanca_local'] =  $filemudanca_local;

        $dat[] =  $data['mudanca_local'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  faturamento
       */
      if (isset($data['faturamento'])) {
       
        $faturamento = $request->faturamento;

        $filefaturamento = time().'.'.$faturamento->getClientOriginalName();
  
        $request->faturamento->move(storage_path(), $filefaturamento);
  
        $data['faturamento'] =  $filefaturamento;

        $dat[] =  $data['faturamento'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  empregados
       */
      if (isset($data['empregados'])) {
       
        $empregados = $request->empregados;

        $fileempregados = time().'.'.$empregados->getClientOriginalName();
  
        $request->empregados->move(storage_path(), $fileempregados);
  
        $data['empregados'] =  $fileempregados;

        $dat[] =  $data['empregados'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  materia_prima
       */
      if (isset($data['materia_prima'])) {
       
        $materia_prima = $request->materia_prima;

      $filemateria_prima = time().'.'.$materia_prima->getClientOriginalName();

      $request->materia_prima->move(storage_path(), $filemateria_prima);

      $data['materia_prima'] =  $filemateria_prima;

      $dat[] =  $data['materia_prima'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  investimento_ped
       */
      if (isset($data['investimento_ped'])) {
       
        $investimento_ped = $request->investimento_ped;

        $fileinvestimento_ped = time().'.'.$investimento_ped->getClientOriginalName();
  
        $request->investimento_ped->move(storage_path(), $fileinvestimento_ped);
  
        $data['investimento_ped'] =  $fileinvestimento_ped;

        $dat[] =  $data['investimento_ped'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  investimento_conservacao
       */
      if (isset($data['investimento_conservacao'])) {
       
        $investimento_conservacao = $request->investimento_conservacao;

        $fileinvestimento_conservacao = time().'.'.$investimento_conservacao->getClientOriginalName();
  
        $request->investimento_conservacao->move(storage_path(), $fileinvestimento_conservacao);
  
        $data['investimento_conservacao'] =  $fileinvestimento_conservacao;

        $dat[] =  $data['investimento_conservacao'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  investimento_mao_obra
       */
      if (isset($data['investimento_mao_obra'])) {
       
        $investimento_mao_obra = $request->investimento_mao_obra;

        $fileinvestimento_mao_obra = time().'.'.$investimento_mao_obra->getClientOriginalName();
  
        $request->investimento_mao_obra->move(storage_path(), $fileinvestimento_mao_obra);

        $data['investimento_mao_obra'] =  $fileinvestimento_mao_obra;

        $dat[] =  $data['investimento_mao_obra'];

        $datas = [
          'files' => $dat
        ];
      }      

      $pedido['editar'] = false;

      $pedido['pedir_editar'] = false;

        $razao_social = $pedido->social_name;
        $nome = $pedido->name;

        array_push($datas, $razao_social, $nome);

    Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRevisao($datas));

      $pedido->update($data);

      }  elseif (!$user->hasEmail($user->email) && $user->name != $pedido->name && $pedido->editar == 1) {
        
        $p = $this->repository->find($id)->toArray();

        $p['name'] =  auth()->user()->name;


       /**
       *  requerimento
       */
      if (isset($data['requerimento'])) {
       
      $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $p['requerimento'] =  $filerequerimento;

      $dat[] =  $p['requerimento'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  certidao_estadual
       */
      if (isset($data['certidao_estadual'])) {
       
        $certidao_estadual = $request->certidao_estadual;

        $filecertidao_estadual = time().'.'.$certidao_estadual->getClientOriginalName();
  
        $request->certidao_estadual->move(storage_path(), $filecertidao_estadual);
  
        $p['certidao_estadual'] =  $filecertidao_estadual;

        $dat[] =  $p['certidao_estadual'];

        $datas = [
          'files' => $dat
        ];        
      }

      /**
       *  certidao_trabalhista
       */
      if (isset($data['certidao_trabalhista'])) {
       
        $certidao_trabalhista = $request->certidao_trabalhista;

      $filecertidao_trabalhista = time().'.'.$certidao_trabalhista->getClientOriginalName();

      $request->certidao_trabalhista->move(storage_path(), $filecertidao_trabalhista);

      $p['certidao_trabalhista'] =  $filecertidao_trabalhista;
      
      $dat[] =  $p['certidao_trabalhista'];

        $datas = [
          'files' => $dat
        ]; 
      }

      /**
       *  certidao_fgts
       */
      if (isset($data['certidao_fgts'])) {
       
        $certidao_fgts = $request->certidao_fgts;

      $filecertidao_fgts = time().'.'.$certidao_fgts->getClientOriginalName();

      $request->certidao_fgts->move(storage_path(), $filecertidao_fgts);

      $p['certidao_fgts'] =  $filecertidao_fgts;

      $dat[] =  $p['certidao_fgts'];

        $datas = [
          'files' => $dat
        ]; 
      }

      /**
       *  carta_motivos
       */
      if (isset($data['carta_motivos'])) {
       
        $carta_motivos = $request->carta_motivos;

        $filecarta_motivos = time().'.'.$carta_motivos->getClientOriginalName();
  
        $request->carta_motivos->move(storage_path(), $filecarta_motivos);
  
        $p['carta_motivos'] =  $filecarta_motivos;

        $dat[] =  $p['carta_motivos'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  mudanca_local
       */
      if (isset($data['mudanca_local'])) {
       
        $mudanca_local = $request->mudanca_local;

        $filemudanca_local = time().'.'.$mudanca_local->getClientOriginalName();
  
        $request->mudanca_local->move(storage_path(), $filemudanca_local);
  
        $p['mudanca_local'] =  $filemudanca_local;

        $dat[] =  $p['mudanca_local'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  faturamento
       */
      if (isset($data['faturamento'])) {
       
        $faturamento = $request->faturamento;

        $filefaturamento = time().'.'.$faturamento->getClientOriginalName();
  
        $request->faturamento->move(storage_path(), $filefaturamento);
  
        $p['faturamento'] =  $filefaturamento;

        $dat[] =  $p['faturamento'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  empregados
       */
      if (isset($data['empregados'])) {
       
        $empregados = $request->empregados;

        $fileempregados = time().'.'.$empregados->getClientOriginalName();
  
        $request->empregados->move(storage_path(), $fileempregados);
  
        $p['empregados'] =  $fileempregados;

        $dat[] =  $p['empregados'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  materia_prima
       */
      if (isset($data['materia_prima'])) {
       
        $materia_prima = $request->materia_prima;

      $filemateria_prima = time().'.'.$materia_prima->getClientOriginalName();

      $request->materia_prima->move(storage_path(), $filemateria_prima);

      $p['materia_prima'] =  $filemateria_prima;

      $dat[] =  $p['materia_prima'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  investimento_ped
       */
      if (isset($data['investimento_ped'])) {
       
        $investimento_ped = $request->investimento_ped;

        $fileinvestimento_ped = time().'.'.$investimento_ped->getClientOriginalName();
  
        $request->investimento_ped->move(storage_path(), $fileinvestimento_ped);
  
        $p['investimento_ped'] =  $fileinvestimento_ped;

        $dat[] =  $p['investimento_ped'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  investimento_conservacao
       */
      if (isset($data['investimento_conservacao'])) {
       
        $investimento_conservacao = $request->investimento_conservacao;

        $fileinvestimento_conservacao = time().'.'.$investimento_conservacao->getClientOriginalName();
  
        $request->investimento_conservacao->move(storage_path(), $fileinvestimento_conservacao);
  
        $p['investimento_conservacao'] =  $fileinvestimento_conservacao;

        $dat[] =  $p['investimento_conservacao'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  investimento_mao_obra
       */
      if (isset($data['investimento_mao_obra'])) {
       
        $investimento_mao_obra = $request->investimento_mao_obra;

        $fileinvestimento_mao_obra = time().'.'.$investimento_mao_obra->getClientOriginalName();
  
        $request->investimento_mao_obra->move(storage_path(), $fileinvestimento_mao_obra);
  
        $p['investimento_mao_obra'] =  $fileinvestimento_mao_obra;

        $p['investimento_conservacao'] =  $fileinvestimento_conservacao;

        $dat[] =  $p['investimento_conservacao'];

        $datas = [
          'files' => $dat
        ];
      }

      $pedido['editar'] = false;

      $pedido['pedir_editar'] = false;

        $razao_social = $pedido->social_name;
        $nome = $pedido->name;

        array_push($datas, $razao_social, $nome);

      Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRevisao($datas));

      $pedido->update();
      
      $this->repository->create($p);

      
    } elseif (!$user->hasEmail($user->email) && $user->name == $pedido->name && $pedido->editar == 1) {

      /**
       *  requerimento
       */
      if (isset($data['requerimento'])) {
       
        $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $data['requerimento'] =  $filerequerimento;
      
      $dat[] =  $data['requerimento'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  certidao_estadual
       */
      if (isset($data['certidao_estadual'])) {
       
        $certidao_estadual = $request->certidao_estadual;

        $filecertidao_estadual = time().'.'.$certidao_estadual->getClientOriginalName();
  
        $request->certidao_estadual->move(storage_path(), $filecertidao_estadual);
  
        $data['certidao_estadual'] =  $filecertidao_estadual;

        $dat[] =  $data['certidao_estadual'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  certidao_trabalhista
       */
      if (isset($data['certidao_trabalhista'])) {
       
        $certidao_trabalhista = $request->certidao_trabalhista;

      $filecertidao_trabalhista = time().'.'.$certidao_trabalhista->getClientOriginalName();

      $request->certidao_trabalhista->move(storage_path(), $filecertidao_trabalhista);

      $data['certidao_trabalhista'] =  $filecertidao_trabalhista;
      
      $dat[] =  $data['certidao_trabalhista'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  certidao_fgts
       */
      if (isset($data['certidao_fgts'])) {
       
        $certidao_fgts = $request->certidao_fgts;

      $filecertidao_fgts = time().'.'.$certidao_fgts->getClientOriginalName();

      $request->certidao_fgts->move(storage_path(), $filecertidao_fgts);

      $data['certidao_fgts'] =  $filecertidao_fgts;

      $dat[] =  $data['certidao_fgts'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  carta_motivos
       */
      if (isset($data['carta_motivos'])) {
       
        $carta_motivos = $request->carta_motivos;

        $filecarta_motivos = time().'.'.$carta_motivos->getClientOriginalName();
  
        $request->carta_motivos->move(storage_path(), $filecarta_motivos);
  
        $data['carta_motivos'] =  $filecarta_motivos;

        $dat[] =  $data['carta_motivos'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  mudanca_local
       */
      if (isset($data['mudanca_local'])) {
       
        $mudanca_local = $request->mudanca_local;

        $filemudanca_local = time().'.'.$mudanca_local->getClientOriginalName();
  
        $request->mudanca_local->move(storage_path(), $filemudanca_local);
  
        $data['mudanca_local'] =  $filemudanca_local;

        $dat[] =  $data['mudanca_local'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  faturamento
       */
      if (isset($data['faturamento'])) {
       
        $faturamento = $request->faturamento;

        $filefaturamento = time().'.'.$faturamento->getClientOriginalName();
  
        $request->faturamento->move(storage_path(), $filefaturamento);
  
        $data['faturamento'] =  $filefaturamento;

        $dat[] =  $data['faturamento'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  empregados
       */
      if (isset($data['empregados'])) {
       
        $empregados = $request->empregados;

        $fileempregados = time().'.'.$empregados->getClientOriginalName();
  
        $request->empregados->move(storage_path(), $fileempregados);
  
        $data['empregados'] =  $fileempregados;

        $dat[] =  $data['empregados'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  materia_prima
       */
      if (isset($data['materia_prima'])) {
       
        $materia_prima = $request->materia_prima;

      $filemateria_prima = time().'.'.$materia_prima->getClientOriginalName();

      $request->materia_prima->move(storage_path(), $filemateria_prima);

      $data['materia_prima'] =  $filemateria_prima;

      $dat[] =  $data['materia_prima'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  investimento_ped
       */
      if (isset($data['investimento_ped'])) {
       
        $investimento_ped = $request->investimento_ped;

        $fileinvestimento_ped = time().'.'.$investimento_ped->getClientOriginalName();
  
        $request->investimento_ped->move(storage_path(), $fileinvestimento_ped);
  
        $data['investimento_ped'] =  $fileinvestimento_ped;

        $dat[] =  $data['investimento_ped'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  investimento_conservacao
       */
      if (isset($data['investimento_conservacao'])) {
       
        $investimento_conservacao = $request->investimento_conservacao;

        $fileinvestimento_conservacao = time().'.'.$investimento_conservacao->getClientOriginalName();
  
        $request->investimento_conservacao->move(storage_path(), $fileinvestimento_conservacao);
  
        $data['investimento_conservacao'] =  $fileinvestimento_conservacao;

        $dat[] =  $data['investimento_conservacao'];

        $datas = [
          'files' => $dat
        ];
      }

      /**
       *  investimento_mao_obra
       */
      if (isset($data['investimento_mao_obra'])) {
       
        $investimento_mao_obra = $request->investimento_mao_obra;

        $fileinvestimento_mao_obra = time().'.'.$investimento_mao_obra->getClientOriginalName();
  
        $request->investimento_mao_obra->move(storage_path(), $fileinvestimento_mao_obra);
  
        $data['investimento_mao_obra'] =  $fileinvestimento_mao_obra;

        $dat[] =  $data['investimento_mao_obra'];

        $datas = [
          'files' => $dat
        ];
      }

      $pedido['editar'] = false;

      $pedido['pedir_editar'] = false;

        $razao_social = $pedido->social_name;
        $nome = $pedido->name;

        array_push($datas, $razao_social, $nome);

      Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarRevisao($datas));

      $pedido->update($data);
    }     

      return redirect()->route('proedi.revisao.index');

    }
}
