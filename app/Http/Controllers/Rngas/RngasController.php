<?php

namespace App\Http\Controllers\Rngas;

use App\Http\Controllers\Controller;
use App\Mail\rngas\AddRngas;
use App\Models\RnGas\RnGas;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RngasController extends Controller
{
    public function __construct(RnGas $rngas, Tenant $tenants)
    {
       $this->repository = $rngas;
       $this->tenant = $tenants; 
       //$this->middleware(['can:proediadmin']);
    }
    
    public function index() {

        $id = auth()->user()->tenant->id;

        $rngas = DB::table('rn_gases')->where('tenant_id', "$id")->get();

        $quantidadeRngas = DB::table('rn_gases')->get('id')->count();

        $sei = DB::table('sei_rn_gases')->where('tenant_id', "$id")->get();
  
        $concessao = DB::table('concessao_rn_gases')->where('tenant_id', "$id")->get();

        return view('admin.rngas.meu_rngas.index', compact(['rngas', 'quantidadeRngas', 'sei', 'concessao']));
    }

    public function create() {

        $tenants = DB::table('tenants')->pluck('name', 'cnpj')->except('name','=', 'sedec');

        return view('admin.rngas.analise.rngas.create', compact('tenants'));
    }

    public function store(Request $request) {

        $data = $request->all();

        $rngas_id = DB::table('tenants')->where('cnpj', "$request->nome_empresa")->first('id');

        $rngas_social_name = DB::table('tenants')->where('cnpj', "$request->nome_empresa")->first('social_name');

        $rngas_name = DB::table('tenants')->where('cnpj', "$request->nome_empresa")->first('name');


        $rngas_cnpj = DB::table('tenants')->where('cnpj', "$request->nome_empresa")->first('cnpj');

        $rngas_email = DB::table('tenants')->where('cnpj', "$request->nome_empresa")->first('email');



        $data['tenant_id'] = $rngas_id->id;
        $data['cnpj'] = $rngas_cnpj->cnpj;
        $data['name'] = $rngas_name->name;
        $data['social_name'] = $rngas_social_name->social_name;

        
        $datas = [
            'name' => $data['name']
        ];

        //dd($data);
        
        Mail::to('rafaelduartedelimaa@gmail.com')->send(new AddRngas($datas));
        
        //$this->repository->create($datas);

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
