<?php

namespace App\Http\Controllers\Rngas\Analisys;

use App\Http\Controllers\Controller;
use App\Http\Requests\RnGas\StoreRnGas;
use App\Models\RnGas\RnGas;
use App\Models\Tenant;
use App\Notifications\rngas\user\email\Rngas as EmailRngas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use PhpParser\Node\Expr\Cast\String_;

class RngasController extends Controller
{
    public function __construct(RnGas $rngas, Tenant $tenants)
    {
       $this->repository = $rngas;
       $this->tenant = $tenants; 
       $this->middleware(['can:proediadmin']);
    }
    
    public function index() {

        $id = auth()->user()->tenant->id;

        //$rngas = DB::table('rn_gases')->where('tenant_id', "$id")->get();

        $quantidadeRngas = DB::table('rn_gases')->get('id')->count();

        $sei = DB::table('sei_rn_gases')->where('tenant_id', "$id")->get();
        
        $rngas = $this->repository->latest()->paginate();

        $concessao = DB::table('concessao_rn_gases')->where('tenant_id', "$id")->get();

        return view('admin.rngas.analise.rngas.index', compact(['rngas', 'quantidadeRngas',
         'sei', 'concessao']));
    }

    public function create() {

        $tenants = DB::table('tenants')->pluck('name', 'cnpj')->except('name','=', 'sedec');

        return view('admin.rngas.analise.rngas.create', compact('tenants'));
    }

    public function store(StoreRnGas $request) {

        $data = $request->all();

        $tenant_id = $data['name'];

        $name = DB::table('tenants')->where('cnpj', $tenant_id)->first('name');

        $social_name = DB::table('tenants')->where('cnpj', $tenant_id)->first('social_name');

        $tenant = DB::table('tenants')->where('cnpj', $tenant_id)->pluck('id');

        $nome = $name->name;

        $nome_social = $social_name->social_name;
        
        $data['tenant_id'] = $tenant_id;

        $data['name'] = $nome;        

        $email = User::where('tenant_id', '=', $tenant )->first();

        $data['social_name'] = $nome_social;

        $data['name'] = $nome;

        $data['cnpj'] = $tenant_id; 
        
        $data['tenant_id'] = $tenant[0]; 

        //dd($tenant_id);  

        //Mail::to('rafaelduartedelimaa@gmail.com')->send(new AddRngas($datas));
        
        $enviar = $this->repository->create($data);

        Notification::send($email, new EmailRngas($enviar));

        return redirect()->route('rngas.index');
    }

    public function destroy($id) {

        if( !$rngas = $this->repository->find($id)) {
            return redirect()->back();
        }

        $rngas->delete();

        return redirect()->back();

    }
}
