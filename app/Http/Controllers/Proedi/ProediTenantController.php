<?php

namespace App\Http\Controllers\Proedi;

use App\Http\Controllers\Controller;
use App\Models\proedi\Proedi;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProediTenantController extends Controller
{
    public function __construct(Proedi $proedis, Tenant $tenants)
    {
        $this->repository = $proedis;
        $this->tenant = $tenants;
    }

    public function index() {

        $tenant = auth()->user()->tenant->id;

        $quantidadeProedi = DB::table('proedis')->where('tenant_id', "$tenant")->get('id')->count();

        $quantidadeConcessao = DB::table('pedir_concessao_proedis')->where('tenant_id', "$tenant")->get('id')->count();

        $countRevision = DB::table('pedir_revisao_proedis')->where('tenant_id', "$tenant")->get('id')->count();

        $countReport = DB::table('enviar_relatorio_proedis')->where('tenant_id', "$tenant")->get('id')->count();

        //dd($quantidadeConcessao);
        
        return view('admin.proedi.tenant.index', compact('quantidadeProedi', 'quantidadeConcessao',
        'countRevision', 'countReport'));
    }

    public function myProedi() {

        $id = auth()->user()->tenant->id;

        $proedis = DB::table('proedis')->where('tenant_id', "$id")->get();

        $sei = DB::table('sei_proedis')->where('tenant_id', "$id")->get();

        $concessao = DB::table('pedir_concessao_proedis')->where('tenant_id', "$id")->get();

        return view('admin.proedi.tenant.proedi', compact('proedis','sei', 'concessao'));
    }
}
