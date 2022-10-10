<?php

namespace App\Http\Controllers\Proedi\Analisys;

use App\Http\Controllers\Controller;
use App\Mail\proedi\concessao\permitirEdicao;
use App\Models\proedi\PedirConcessaoProedi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ConcessaoController extends Controller
{
    public function __construct(PedirConcessaoProedi $pedirProedi)
    {
        $this->repository = $pedirProedi;
        $this->middleware(['can:proediadmin']);
    }
    
    public function index(){

        $pedidos = $this->repository->latest()->paginate();          

        return view('admin.proedi.analisys.concessao.index', compact('pedidos'));
    }    

    public function show($id) {

        if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
        }
        
        return view('admin.proedi.analisys.concessao.show', compact('pedido'));
    }

    public function destroy($id) {

        if (!$pedido = $this->repository->find($id)) {
            return redirect()->back();
        }
            $pedido->delete();

            $pedidos = $this->repository->latest()->paginate();

        return view('admin.proedi.analisys.concessao.index', compact('pedidos'));
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');
 
        $pedidos = $this->repository
                        ->where(function($query) use ($request){
                            if ($request->filter) {
                                $query->orWhere('nome_empresa', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('tenant_id', 'LIKE', "%{$request->filter}%");
                            }
                        })
                        ->latest()
                        ->paginate();
 
        return view('admin.proedi.analisys.concessao.index', compact('pedidos', 'filters'));
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

        Mail::to($email)->send(new permitirEdicao($pedido));
        
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
