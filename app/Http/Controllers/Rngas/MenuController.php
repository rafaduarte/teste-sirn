<?php

namespace App\Http\Controllers\Rngas;

use App\Http\Controllers\Controller;
use App\Models\RnGas\RnGas;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function __construct(RnGas $rngas, Tenant $tenant)
    {
       $this->repository = $rngas;
       $this->tenant = $tenant; 
    }
    public function index() {

        $tenant = auth()->user()->tenant->id;

        $quantidadeRnGas = DB::table('rn_gases')->where('tenant_id', "$tenant")->get('id')->count();

        $quantidadeConcessao = DB::table('concessao_rn_gases')->where('tenant_id', "$tenant")->get('id')->count();


        $quantidadeConcessao = 0;
        $countRevision = 0;
        
        return view('admin.rngas.menu.menu',
         compact(['quantidadeRnGas', 'quantidadeConcessao']));
    }
}
