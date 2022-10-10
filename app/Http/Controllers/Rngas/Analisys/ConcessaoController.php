<?php

namespace App\Http\Controllers\Rngas\Analisys;

use App\Http\Controllers\Controller;
use App\Mail\rngas\PermitirEdicao;
use App\Models\RnGas\ConcessaoRnGas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ConcessaoController extends Controller
{
    public function __construct(ConcessaoRnGas $pedido)
    {
        $this->repository = $pedido;
    }

    public function index() {

        $pedidos = $this->repository->latest()->paginate();
        
        return view('admin.rngas.analise.concessao.index' , compact('pedidos'));
    }

    public function create() {
        
        return view('admin.rngas.analise.concessao.create');
    }

    public function show($id) {

        if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.rngas.analise.concessao.show', compact('pedido'));

    }

    public function destroy($id) {

        if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
        }
            $pedido->delete();

            $pedidos = $this->repository->latest()->paginate();

        return view('admin.rngas.analise.concessao.index', compact('pedidos'));
    }

    public function permitirEditar($id) {

        if (!$pedido = $this->repository->find($id)) {
            
            return redirect()->back();
        }

        $email = DB::table('users')->where('name', $pedido->nome_empresa)->pluck('email');

        $pedido['editar'] = true;
        $pedido['pedir_editar'] = false;
        $pedido->update();

        //dd($email);

        Mail::to($email)->send(new PermitirEdicao($pedido));
        
        return $this->index();
    }

    public function retirarEditar($id) {

        if (!$pedido = $this->repository->find($id)) {
            
            return redirect()->back();
        }

        $pedido['editar'] = false;
        $pedido['pedir_editar'] = false;
        $pedido->update();
        
        return $this->index();
    }
}
