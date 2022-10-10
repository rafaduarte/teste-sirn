<?php

namespace App\Http\Controllers\Proedi\Analisys;

use App\Http\Controllers\Controller;
use App\Mail\proedi\revisao\PermitirEdicaoRevisao;
use App\Models\proedi\PedirRevisaoProedi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RevisaoController extends Controller
{
    public function __construct(PedirRevisaoProedi $pedirRevisao)
    {
        $this->repository = $pedirRevisao;
        $this->middleware(['can:proediadmin']);
    }

    public function index() {
        
        $pedidos = $this->repository->latest()->paginate();
        
        return view('admin.proedi.analisys.revisao.index' , compact('pedidos'));
    }

    public function show($id) {

        if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
        }
        
        return view('admin.proedi.analisys.revisao.show', compact('pedido'));
    }

    public function destroy($id) {

        if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
        }

        $pedido->delete();

        $pedidos = $this->repository->latest()->paginate();
        
        return view('admin.proedi.analisys.revisao.index' , compact('pedidos'));

    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');
 
        $pedidos = $this->repository
                        ->where(function($query) use ($request){
                            if ($request->filter) {
                                $query->orWhere('tenant_id', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                            }
                        })
                        ->latest()
                        ->paginate();
 
        return view('admin.proedi.analisys.revisao.index', compact('pedidos', 'filters'));
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

        Mail::to($email)->send(new PermitirEdicaoRevisao($pedido));
        
        return $this->index();
    }

    public function retirarEditar($id) {

        if (!$pedido = $this->repository->find($id)) {
            
            return redirect()->back();
        }

        $pedido['editar'] = false;
        $pedido->update();
        
        return $this->index();
    }
}
