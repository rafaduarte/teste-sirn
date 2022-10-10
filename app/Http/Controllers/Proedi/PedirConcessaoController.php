<?php

namespace App\Http\Controllers\Proedi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConcessaoProedi;
use App\Http\Requests\UpdateConcessaoProedi;
use App\Mail\proedi\concessao\AtualizarConcessao;
use App\Mail\proedi\concessao\pedirEdicao;
use App\Models\proedi\PedirConcessaoProedi;
use App\Models\Profile;
use App\Models\Tenant;
use App\Notifications\proedi\admin\email\concessao;
use App\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class PedirConcessaoController extends Controller
{   
    public function __construct(PedirConcessaoProedi $pedirProedi, User $user)
    {   
        $this->users = $user;
        $this->repository = $pedirProedi;
    }

    public function test(Request $request) {

      dd($request->all());

    }

    public function index() {

        $pedidos = $this->repository->latest()->paginate();
        
        return view('admin.proedi.concessao.index' , compact('pedidos'));
    }

    public function show($id) {

        if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
        }
        
        return view('admin.proedi.concessao.show', compact('pedido'));
    }
    /**
     * métodos para exibição dos PDFs
     */
    public function file($file) {

        //$pedido = $this->repository->find($id);
        return response()->file(storage_path($file));
           //return view('admin.proedi.files.concessao.requerimento', compact('pedido'));    
    }
    /*
    public function fileProjeto($id) {
        
        $pedido = $this->repository->find($id);

           return view('admin.proedi.files.projeto', compact('pedido'));    
    }

    public function fileInscricaoEstadual($id) {
        
        $pedido = $this->repository->find($id);

           return view('admin.proedi.files.inscricaoestadual', compact('pedido'));    
    }

    public function fileCertidaoFederal($id) {
        
        $pedido = $this->repository->find($id);

           return view('admin.proedi.files.certidaofederal', compact('pedido'));    
    }

    public function fileCertidaoEstadual($id) {
        
        $pedido = $this->repository->find($id);

           return view('admin.proedi.files.certidaoestadual', compact('pedido'));    
    }
        */
    public function create() {

        return view('admin.proedi.concessao.create');
    }

    public function pedirEdicao($id) {
      if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
      }

      $pedido['pedir_editar'] = true;

      $pedido->update();

      Mail::to('codit.sedecrn@gmail.com')->send(new pedirEdicao($pedido));

      return $this->index();
    }

    public function store(StoreConcessaoProedi $request) {

       $data = $request->all();

        $cpf_traco =  str_replace("-", "", $data['cpf_projetista']);
        $cpf =  str_replace(".", "", $cpf_traco);

        $data['cpf_projetista'] = $cpf;

      /**
       * nome e cnpj
       */
      $data['social_name'] = auth()->user()->tenant->social_name;

      $data['nome_empresa'] = auth()->user()->name;

      $tenant = auth()->user()->tenant;
      $data['cnpj'] = $tenant->cnpj;
      
      /**
       *  requerimento
       */
      $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $data['requerimento'] =  $filerequerimento;

       /**
       *  projeto
       */
      $projeto = $request->projeto;

      $fileprojeto = time().'.'.$projeto->getClientOriginalName();

      $request->projeto->move(storage_path(), $fileprojeto);

      $data['projeto'] =  $fileprojeto;

      /**
       *  Documento do Projetista
       */
      $documento_projetista = $request->documento_projetista;

      $filedocumeto = time().'.'.$documento_projetista->getClientOriginalName();

      $request->documento_projetista->move(storage_path(), $filedocumeto);

      $data['documento_projetista'] =  $filedocumeto;

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

      /**
       *  procuracao_responsavel
       */
      $procuracao_responsavel = $request->procuracao_responsavel;

      $fileprocuracao_responsavel = time().'.'.$procuracao_responsavel->getClientOriginalName();

      $request->procuracao_responsavel->move(storage_path(), $fileprocuracao_responsavel);

      $data['procuracao_responsavel'] =  $fileprocuracao_responsavel;

      /**
       *  rg_responsavel
       */
      $rg_responsavel = $request->rg_responsavel;

      $filerg_responsavel = time().'.'.$rg_responsavel->getClientOriginalName();

      $request->rg_responsavel->move(storage_path(), $filerg_responsavel);

      $data['rg_responsavel'] =  $filerg_responsavel;

      /**
       *  comprovante_residencia
       */
      $comprovante_residencia = $request->comprovante_residencia;

      $filecomprovante_residencia = time().'.'.$comprovante_residencia->getClientOriginalName();

      $request->comprovante_residencia->move(storage_path(), $filecomprovante_residencia);

      $data['comprovante_residencia'] =  $filecomprovante_residencia;

      /**
       *  relatorio_gfip
       */
      $relatorio_gfip = $request->relatorio_gfip;

      $filerelatorio_gfip = time().'.'.$relatorio_gfip->getClientOriginalName();

      $request->relatorio_gfip->move(storage_path(), $filerelatorio_gfip);

      $data['relatorio_gfip'] =  $filerelatorio_gfip;

      /**
       *  relatorio_faturamento
       */
      $relatorio_faturamento = $request->relatorio_faturamento;

      $filerelatorio_faturamento = time().'.'.$relatorio_faturamento->getClientOriginalName();

      $request->relatorio_faturamento->move(storage_path(), $filerelatorio_faturamento);

      $data['relatorio_faturamento'] =  $filerelatorio_faturamento;

      /**
       *  documentos
       */
      if (isset($data['documentos'])) {

      $documentos = $request->documentos;

      $filedocumentos = time().'.'.$documentos->getClientOriginalName();

      $request->documentos->move(storage_path(), $filedocumentos);

      $data['documentos'] =  $filedocumentos;
      }

      /**
       *  armazenar no banco de dados
       */
       $pedido = $this->repository->create($data);       
       
       $profiles = Tenant::where('name', '=', 'sedecrn')->first();

       $email = $profiles->users()->first();
             
       Notification::send($email, new concessao($pedido));

        return redirect()->route('proedi.concessao.index');  

    }

    public function edit($id) {

        if(!$pedido = $this->repository->find($id)) {

            return redirect()->back();
        }
        
        return view('admin.proedi.concessao.edit', compact('pedido'));
    }

    public function update(UpdateConcessaoProedi $request, $id) {

        if (!$pedido = $this->repository->find($id)){

            return redirect()->back();
        }

        $data = $request->all();

        $user_id = Auth::user()->id;

        if (!$user = User::find($user_id)) {

            return redirect()->back();
        }

        $datas = [];

        if ($user->hasEmail($user->email) && $pedido->editar == 1) {

             /**
       *  requerimento
       */
      if (isset($data['requerimento'])) {

        $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $data['requerimento'] =  $filerequerimento;

      $dat[] = $data['requerimento'];

        $datas = [
          'files' => $dat
        ];
        }

     /**
      * projeto
     */   
     if (isset($data['projeto'])) {

        $projeto = $request->projeto;

        $fileprojeto = time().'.'.$projeto->getClientOriginalName();

        $request->projeto->move(storage_path(), $fileprojeto);

        $data['projeto'] =  $fileprojeto;

        $dat[] = $data['projeto'];

        $datas = [
          'files' => $dat
        ];
    }

    /**
      * Documento do Projetista
     */   
    if (isset($data['documento_projetista'])) {

      $documento_projetista = $request->documento_projetista;

      $filedocumento_projetista = time().'.'.$documento_projetista->getClientOriginalName();

      $request->documento_projetista->move(storage_path(), $filedocumento_projetista);

      $data['documento_projetista'] =  $filedocumento_projetista;

      $dat[] = $data['documento_projetista'];

      $datas = [
        'files' => $dat
      ];
  }

   /**
    * inscricao estadual
    */

    if (isset($data['inscricao_estadual'])) {

        $inscricao_estadual = $request->inscricao_estadual;

      $fileinscricao_estadual = time().'.'.$inscricao_estadual->getClientOriginalName();

      $request->inscricao_estadual->move(storage_path(), $fileinscricao_estadual);

      $data['inscricao_estadual'] =  $fileinscricao_estadual;

      $dat[] = $data['inscricao_estadual'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_federal
    */

    if (isset($data['certidao_federal'])) {

      $certidao_federal = $request->certidao_federal;

      $filecertidao_federal = time().'.'.$certidao_federal->getClientOriginalName();

      $request->certidao_federal->move(storage_path(), $filecertidao_federal);

      $data['certidao_federal'] =  $filecertidao_federal;

      $dat[] = $data['certidao_federal'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_estadual
    */

    if (isset($data['certidao_estadual'])) {

        $certidao_estadual = $request->certidao_estadual;

        $filecertidao_estadual = time().'.'.$certidao_estadual->getClientOriginalName();
  
        $request->certidao_estadual->move(storage_path(), $filecertidao_estadual);
  
        $data['certidao_estadual'] =  $filecertidao_estadual;

        $dat[] = $data['certidao_estadual'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_municipal
    */

    if (isset($data['certidao_municipal'])) {

        $certidao_municipal = $request->certidao_municipal;

        $filecertidao_municipal = time().'.'.$certidao_municipal->getClientOriginalName();
  
        $request->certidao_municipal->move(storage_path(), $filecertidao_municipal);
  
        $data['certidao_municipal'] =  $filecertidao_municipal;

        $dat[] = $data['certidao_municipal'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_trabalhista
    */

    if (isset($data['certidao_trabalhista'])) {

        $certidao_trabalhista = $request->certidao_trabalhista;

        $filecertidao_trabalhista = time().'.'.$certidao_trabalhista->getClientOriginalName();
  
        $request->certidao_trabalhista->move(storage_path(), $filecertidao_trabalhista);
  
        $data['certidao_trabalhista'] =  $filecertidao_trabalhista;

        $dat[] = $data['certidao_trabalhista'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_fgts
    */

    if (isset($data['certidao_fgts'])) {

        $certidao_fgts = $request->certidao_fgts;

        $filecertidao_fgts = time().'.'.$certidao_fgts->getClientOriginalName();
  
        $request->certidao_fgts->move(storage_path(), $filecertidao_fgts);
  
        $data['certidao_fgts'] =  $filecertidao_fgts;

        $dat[] = $data['certidao_fgts'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * ata_constituicao
    */

    if (isset($data['ata_constituicao'])) {

      $ata_constituicao = $request->ata_constituicao;

      $fileata_constituicao = time().'.'.$ata_constituicao->getClientOriginalName();

      $request->ata_constituicao->move(storage_path(), $fileata_constituicao);

      $data['ata_constituicao'] =  $fileata_constituicao;

      $dat[] = $data['ata_constituicao'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * procuracao_responsavel
    */

    if (isset($data['procuracao_responsavel'])) {

      $procuracao_responsavel = $request->procuracao_responsavel;

      $fileprocuracao_responsavel = time().'.'.$procuracao_responsavel->getClientOriginalName();

      $request->procuracao_responsavel->move(storage_path(), $fileprocuracao_responsavel);

      $data['procuracao_responsavel'] =  $fileprocuracao_responsavel;

      $dat[] = $data['procuracao_responsavel'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * rg_responsavel
    */

    if (isset($data['rg_responsavel'])) {

        $rg_responsavel = $request->rg_responsavel;

        $filerg_responsavel = time().'.'.$rg_responsavel->getClientOriginalName();
  
        $request->rg_responsavel->move(storage_path(), $filerg_responsavel);
  
        $data['rg_responsavel'] =  $filerg_responsavel;

        $dat[] = $data['rg_responsavel'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * comprovante_residencia
    */

    if (isset($data['comprovante_residencia'])) {

      $comprovante_residencia = $request->comprovante_residencia;

      $filecomprovante_residencia = time().'.'.$comprovante_residencia->getClientOriginalName();

      $request->comprovante_residencia->move(storage_path(), $filecomprovante_residencia);

      $data['comprovante_residencia'] =  $filecomprovante_residencia;

      $dat[] = $data['comprovante_residencia'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * relatorio_gfip
    */

    if (isset($data['relatorio_gfip'])) {

        $relatorio_gfip = $request->relatorio_gfip;

        $filerelatorio_gfip = time().'.'.$relatorio_gfip->getClientOriginalName();
  
        $request->relatorio_gfip->move(storage_path(), $filerelatorio_gfip);
  
        $data['relatorio_gfip'] =  $filerelatorio_gfip;

        $dat[] = $data['relatorio_gfip'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * relatorio_faturamento
    */

    if (isset($data['relatorio_faturamento'])) {

      $relatorio_faturamento = $request->relatorio_faturamento;

      $filerelatorio_faturamento = time().'.'.$relatorio_faturamento->getClientOriginalName();

      $request->relatorio_faturamento->move(storage_path(), $filerelatorio_faturamento);

      $data['relatorio_faturamento'] =  $filerelatorio_faturamento;

      $dat[] = $data['relatorio_faturamento'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * documentos
    */

    if (isset($data['documentos'])) {

        $documentos = $request->documentos;

        $filedocumentos = time().'.'.$documentos->getClientOriginalName();
  
        $request->documentos->move(storage_path(), $filedocumentos);
  
        $data['documentos'] =  $filedocumentos;
        
        $dat[] = $data['documentos'];

        $datas = [
          'files' => $dat
        ];
    }

    $pedido['editar'] = false;
    $pedido['pedir_editar'] = false;

        $razao_social = $pedido->social_name;
        $nome = $pedido->nome_empresa;

        array_push($datas, $razao_social, $nome);

    Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarConcessao($datas));

    $pedido->update($data);

        } elseif (!$user->hasEmail($user->email) && $user->name != $pedido->nome_empresa && $pedido->editar == 1) {

        $p = $this->repository->find($id)->toArray();

        $p['nome_empresa'] =  auth()->user()->name;

        /**
       *  requerimento
       */
      if (isset($data['requerimento'])) {

        $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $p['requerimento'] =  $filerequerimento;

      $dat[] = $p['requerimento'];

        $datas = [
          'files' => $dat
        ];
        }

     /**
      * projeto
     */   
     if (isset($data['projeto'])) {

        $projeto = $request->projeto;

        $fileprojeto = time().'.'.$projeto->getClientOriginalName();

        $request->projeto->move(storage_path(), $fileprojeto);

        $p['projeto'] =  $fileprojeto;

        $dat[] = $p['projeto'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
      * Documento do Projetista
     */   
    if (isset($data['documento_projetista'])) {

      $documento_projetista = $request->documento_projetista;

      $filedocumento_projetista = time().'.'.$documento_projetista->getClientOriginalName();

      $request->documento_projetista->move(storage_path(), $filedocumento_projetista);

      $p['documento_projetista'] =  $filedocumento_projetista;

      $dat[] = $p['documento_projetista'];

      $datas = [
        'files' => $dat
      ];
  }

   /**
    * inscricao estadual
    */

    if (isset($data['inscricao_estadual'])) {

        $inscricao_estadual = $request->inscricao_estadual;

      $fileinscricao_estadual = time().'.'.$inscricao_estadual->getClientOriginalName();

      $request->inscricao_estadual->move(storage_path(), $fileinscricao_estadual);

      $p['inscricao_estadual'] =  $fileinscricao_estadual;

      $dat[] = $p['inscricao_estadual'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_federal
    */

    if (isset($data['certidao_federal'])) {

      $certidao_federal = $request->certidao_federal;

      $filecertidao_federal = time().'.'.$certidao_federal->getClientOriginalName();

      $request->certidao_federal->move(storage_path(), $filecertidao_federal);

      $p['certidao_federal'] =  $filecertidao_federal;

      $dat[] = $p['certidao_federal'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_estadual
    */

    if (isset($data['certidao_estadual'])) {

        $certidao_estadual = $request->certidao_estadual;

        $filecertidao_estadual = time().'.'.$certidao_estadual->getClientOriginalName();
  
        $request->certidao_estadual->move(storage_path(), $filecertidao_estadual);
  
        $p['certidao_estadual'] =  $filecertidao_estadual;

        $dat[] = $p['certidao_estadual'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_municipal
    */

    if (isset($data['certidao_municipal'])) {

        $certidao_municipal = $request->certidao_municipal;

        $filecertidao_municipal = time().'.'.$certidao_municipal->getClientOriginalName();
  
        $request->certidao_municipal->move(storage_path(), $filecertidao_municipal);
  
        $p['certidao_municipal'] =  $filecertidao_municipal;

        $dat[] = $p['certidao_municipal'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_trabalhista
    */

    if (isset($data['certidao_trabalhista'])) {

        $certidao_trabalhista = $request->certidao_trabalhista;

        $filecertidao_trabalhista = time().'.'.$certidao_trabalhista->getClientOriginalName();
  
        $request->certidao_trabalhista->move(storage_path(), $filecertidao_trabalhista);
  
        $p['certidao_trabalhista'] =  $filecertidao_trabalhista;

        $dat[] = $p['certidao_trabalhista'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_fgts
    */

    if (isset($data['certidao_fgts'])) {

        $certidao_fgts = $request->certidao_fgts;

        $filecertidao_fgts = time().'.'.$certidao_fgts->getClientOriginalName();
  
        $request->certidao_fgts->move(storage_path(), $filecertidao_fgts);
  
        $p['certidao_fgts'] =  $filecertidao_fgts;

        $dat[] = $p['certidao_fgts'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * ata_constituicao
    */

    if (isset($data['ata_constituicao'])) {

      $ata_constituicao = $request->ata_constituicao;

      $fileata_constituicao = time().'.'.$ata_constituicao->getClientOriginalName();

      $request->ata_constituicao->move(storage_path(), $fileata_constituicao);

      $p['ata_constituicao'] =  $fileata_constituicao;

      $dat[] = $p['ata_constituicao'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * procuracao_responsavel
    */

    if (isset($data['procuracao_responsavel'])) {

      $procuracao_responsavel = $request->procuracao_responsavel;

      $fileprocuracao_responsavel = time().'.'.$procuracao_responsavel->getClientOriginalName();

      $request->procuracao_responsavel->move(storage_path(), $fileprocuracao_responsavel);

      $p['procuracao_responsavel'] =  $fileprocuracao_responsavel;

      $dat[] = $p['procuracao_responsavel'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * rg_responsavel
    */

    if (isset($data['rg_responsavel'])) {

        $rg_responsavel = $request->rg_responsavel;

        $filerg_responsavel = time().'.'.$rg_responsavel->getClientOriginalName();
  
        $request->rg_responsavel->move(storage_path(), $filerg_responsavel);
  
        $p['rg_responsavel'] =  $filerg_responsavel;

        $dat[] = $p['rg_responsavel'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * comprovante_residencia
    */

    if (isset($data['comprovante_residencia'])) {

      $comprovante_residencia = $request->comprovante_residencia;

      $filecomprovante_residencia = time().'.'.$comprovante_residencia->getClientOriginalName();

      $request->comprovante_residencia->move(storage_path(), $filecomprovante_residencia);

      $p['comprovante_residencia'] =  $filecomprovante_residencia;

      $dat[] = $p['comprovante_residencia'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * relatorio_gfip
    */

    if (isset($data['relatorio_gfip'])) {

        $relatorio_gfip = $request->relatorio_gfip;

        $filerelatorio_gfip = time().'.'.$relatorio_gfip->getClientOriginalName();
  
        $request->relatorio_gfip->move(storage_path(), $filerelatorio_gfip);
  
        $p['relatorio_gfip'] =  $filerelatorio_gfip;

        $dat[] = $p['relatorio_gfip'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * relatorio_faturamento
    */

    if (isset($data['relatorio_faturamento'])) {

      $relatorio_faturamento = $request->relatorio_faturamento;

      $filerelatorio_faturamento = time().'.'.$relatorio_faturamento->getClientOriginalName();

      $request->relatorio_faturamento->move(storage_path(), $filerelatorio_faturamento);

      $p['relatorio_faturamento'] =  $filerelatorio_faturamento;

      $dat[] = $p['relatorio_faturamento'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * documentos
    */

    if (isset($data['documentos'])) {

        $documentos = $request->documentos;

        $filedocumentos = time().'.'.$documentos->getClientOriginalName();
  
        $request->documentos->move(storage_path(), $filedocumentos);
  
        $p['documentos'] =  $filedocumentos;
        
        $dat[] = $p['documentos'];

        $datas = [
          'files' => $dat
        ];
    }

    $pedido['editar'] = false;

    $pedido['pedir_editar'] = false;

        $razao_social = $pedido->social_name;
        $nome = $pedido->nome_empresa;

        array_push($datas, $razao_social, $nome);

    Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarConcessao($datas));

    $pedido->update();

    $this->repository->create($p);

    } elseif (!$user->hasEmail($user->email) && $user->name == $pedido->nome_empresa && $pedido->editar == 1) {

             /**
       *  requerimento
       */
      if (isset($data['requerimento'])) {

        $requerimento = $request->requerimento;

      $filerequerimento = time().'.'.$requerimento->getClientOriginalName();

      $request->requerimento->move(storage_path(), $filerequerimento);

      $data['requerimento'] =  $filerequerimento;

      $dat[] = $data['requerimento'];

        $datas = [
          'files' => $dat
        ];
        }

     /**
      * projeto
     */   
     if (isset($data['projeto'])) {

        $projeto = $request->projeto;

        $fileprojeto = time().'.'.$projeto->getClientOriginalName();

        $request->projeto->move(storage_path(), $fileprojeto);

        $data['projeto'] =  $fileprojeto;

        $dat[] = $data['projeto'];

        $datas = [
          'files' => $dat
        ];
    }
    
     /**
      * Documento do Projetista
     */   
    if (isset($data['documento_projetista'])) {

      $documento_projetista = $request->documento_projetista;

      $filedocumento_projetista = time().'.'.$documento_projetista->getClientOriginalName();

      $request->documento_projetista->move(storage_path(), $filedocumento_projetista);

      $data['documento_projetista'] =  $filedocumento_projetista;

      $dat[] = $data['documento_projetista'];

      $datas = [
        'files' => $dat
      ];
  }

   /**
    * inscricao estadual
    */

    if (isset($data['inscricao_estadual'])) {

        $inscricao_estadual = $request->inscricao_estadual;

      $fileinscricao_estadual = time().'.'.$inscricao_estadual->getClientOriginalName();

      $request->inscricao_estadual->move(storage_path(), $fileinscricao_estadual);

      $data['inscricao_estadual'] =  $fileinscricao_estadual;

      $dat[] = $data['inscricao_estadual'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_federal
    */

    if (isset($data['certidao_federal'])) {

      $certidao_federal = $request->certidao_federal;

      $filecertidao_federal = time().'.'.$certidao_federal->getClientOriginalName();

      $request->certidao_federal->move(storage_path(), $filecertidao_federal);

      $data['certidao_federal'] =  $filecertidao_federal;

      $dat[] = $data['certidao_federal'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_estadual
    */

    if (isset($data['certidao_estadual'])) {

        $certidao_estadual = $request->certidao_estadual;

        $filecertidao_estadual = time().'.'.$certidao_estadual->getClientOriginalName();
  
        $request->certidao_estadual->move(storage_path(), $filecertidao_estadual);
  
        $data['certidao_estadual'] =  $filecertidao_estadual;

        $dat[] = $data['certidao_estadual'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_municipal
    */

    if (isset($data['certidao_municipal'])) {

        $certidao_municipal = $request->certidao_municipal;

        $filecertidao_municipal = time().'.'.$certidao_municipal->getClientOriginalName();
  
        $request->certidao_municipal->move(storage_path(), $filecertidao_municipal);
  
        $data['certidao_municipal'] =  $filecertidao_municipal;

        $dat[] = $data['certidao_municipal'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_trabalhista
    */

    if (isset($data['certidao_trabalhista'])) {

        $certidao_trabalhista = $request->certidao_trabalhista;

        $filecertidao_trabalhista = time().'.'.$certidao_trabalhista->getClientOriginalName();
  
        $request->certidao_trabalhista->move(storage_path(), $filecertidao_trabalhista);
  
        $data['certidao_trabalhista'] =  $filecertidao_trabalhista;

        $dat[] = $data['certidao_trabalhista'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * certidao_fgts
    */

    if (isset($data['certidao_fgts'])) {

        $certidao_fgts = $request->certidao_fgts;

        $filecertidao_fgts = time().'.'.$certidao_fgts->getClientOriginalName();
  
        $request->certidao_fgts->move(storage_path(), $filecertidao_fgts);
  
        $data['certidao_fgts'] =  $filecertidao_fgts;

        $dat[] = $data['certidao_fgts'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * ata_constituicao
    */

    if (isset($data['ata_constituicao'])) {

      $ata_constituicao = $request->ata_constituicao;

      $fileata_constituicao = time().'.'.$ata_constituicao->getClientOriginalName();

      $request->ata_constituicao->move(storage_path(), $fileata_constituicao);

      $data['ata_constituicao'] =  $fileata_constituicao;

      $dat[] = $data['ata_constituicao'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * procuracao_responsavel
    */

    if (isset($data['procuracao_responsavel'])) {

      $procuracao_responsavel = $request->procuracao_responsavel;

      $fileprocuracao_responsavel = time().'.'.$procuracao_responsavel->getClientOriginalName();

      $request->procuracao_responsavel->move(storage_path(), $fileprocuracao_responsavel);

      $data['procuracao_responsavel'] =  $fileprocuracao_responsavel;

      $dat[] = $data['procuracao_responsavel'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * rg_responsavel
    */

    if (isset($data['rg_responsavel'])) {

        $rg_responsavel = $request->rg_responsavel;

        $filerg_responsavel = time().'.'.$rg_responsavel->getClientOriginalName();
  
        $request->rg_responsavel->move(storage_path(), $filerg_responsavel);
  
        $data['rg_responsavel'] =  $filerg_responsavel;

        $dat[] = $data['rg_responsavel'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * comprovante_residencia
    */

    if (isset($data['comprovante_residencia'])) {

      $comprovante_residencia = $request->comprovante_residencia;

      $filecomprovante_residencia = time().'.'.$comprovante_residencia->getClientOriginalName();

      $request->comprovante_residencia->move(storage_path(), $filecomprovante_residencia);

      $data['comprovante_residencia'] =  $filecomprovante_residencia;

      $dat[] = $data['comprovante_residencia'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * relatorio_gfip
    */

    if (isset($data['relatorio_gfip'])) {

        $relatorio_gfip = $request->relatorio_gfip;

        $filerelatorio_gfip = time().'.'.$relatorio_gfip->getClientOriginalName();
  
        $request->relatorio_gfip->move(storage_path(), $filerelatorio_gfip);
  
        $data['relatorio_gfip'] =  $filerelatorio_gfip;

        $dat[] = $data['relatorio_gfip'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * relatorio_faturamento
    */

    if (isset($data['relatorio_faturamento'])) {

      $relatorio_faturamento = $request->relatorio_faturamento;

      $filerelatorio_faturamento = time().'.'.$relatorio_faturamento->getClientOriginalName();

      $request->relatorio_faturamento->move(storage_path(), $filerelatorio_faturamento);

      $data['relatorio_faturamento'] =  $filerelatorio_faturamento;

      $dat[] = $data['relatorio_faturamento'];

        $datas = [
          'files' => $dat
        ];
    }

     /**
    * documentos
    */

    if (isset($data['documentos'])) {

        $documentos = $request->documentos;

        $filedocumentos = time().'.'.$documentos->getClientOriginalName();
  
        $request->documentos->move(storage_path(), $filedocumentos);
  
        $data['documentos'] =  $filedocumentos;
        
        $dat[] = $data['documentos'];

        $datas = [
          'files' => $dat
        ];
    }

    $pedido['editar'] = false;

    $pedido['pedir_editar'] = false;

        $razao_social = $pedido->social_name;
        $nome = $pedido->nome_empresa;

        array_push($datas, $razao_social, $nome);

    Mail::to('codit.sedecrn@gmail.com')->send(new AtualizarConcessao($datas));

    $pedido->update($data);

    }      
     return redirect()->route('proedi.concessao.index');
    
    }

    public function search(Request $request) {
       
        $filters = $request->only('filter');
 
        $pedidos = $this->repository
                        ->where(function($query) use ($request){
                            if ($request->filter) {
                                $query->orWhere('cnpj', 'LIKE', "%{$request->filter}%");
                                //$query->orWhere('title', "%{$request->filter}%");
                            }
                        })
                        ->latest()
                        ->paginate();
 
        return view('admin.proedi.concessao.index', compact('pedidos', 'filters'));
    }
}
