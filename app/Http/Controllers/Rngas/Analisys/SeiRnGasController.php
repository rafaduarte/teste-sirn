<?php

namespace App\Http\Controllers\Rngas\Analisys;

use App\Http\Controllers\Controller;
use App\Http\Requests\RnGas\SeiRnGas as RnGasSeiRnGas;
use App\Http\Requests\RnGas\StoreRnGas;
use App\Models\RnGas\SeiRnGas;
use App\Notifications\rngas\user\email\SeiRngas as EmailSeiRngas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class SeiRnGasController extends Controller
{
    private $repository;

    public function __construct(SeiRnGas $sei)
    {
        $this->repository = $sei;
        $this->middleware(['can:proediadmin']);
    }
    
    public function index() {
        
        //$id = auth()->user()->tenant->id;

        $sei = DB::table('sei_rn_gases')->latest()->paginate();

        //dd($sei);

        return view('admin.rngas.analise.sei.index', compact('sei'));
    }

    public function create(){

        $tenant = DB::table('tenants')->pluck('name','id')->except('name','=', '1');

        
        return view('admin.rngas.analise.sei.create', compact('tenant'));
    }

    public function store(RnGasSeiRnGas $request) {

        $data = $request->all();

        $tenant_id = $data['nome_empresa'];

        $name = DB::table('tenants')->where('id', $tenant_id)->first('name');

        $nome = $name->name;
        
        $data['tenant_id'] = $tenant_id;

        $data['name'] = $nome;

        $link = "https://sei.rn.gov.br/sei/controlador_externo.php?acao=usuario_externo_logar&id_orgao_acesso_externo=0";

        $data['link'] = $link;

        $sei = $this->repository->create($data);

        //dd($data);

        $email = User::where('tenant_id', '=', $tenant_id )->first();

        //dd($email);

        Notification::send($email, new EmailSeiRngas($sei));

        return redirect()->route('rngas.sei.index');

    }

    public function destroy($id) {

        $sei = $this->repository->where('id', $id)->first();

        if(!$sei)
            return redirect()->back();

        $sei->delete();

        return redirect()->back();

    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');
 
        $sei = $this->repository
                        ->where(function($query) use ($request){
                            if ($request->filter) {
                                $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('numero', 'LIKE', "%{$request->filter}%");
                            }
                        })
                        ->latest()
                        ->paginate();       
 
        return view('admin.proedi.sei.index',
                    compact('sei', 'filters'));
    }
}
