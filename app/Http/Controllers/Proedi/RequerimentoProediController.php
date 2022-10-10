<?php

namespace App\Http\Controllers\Proedi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequerimentoProedi;
use App\Models\proedi\EnviarRelatorioTrimestral;
use App\Models\proedi\requerimentoProedi;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequerimentoProediController extends Controller
{
    public function __construct(requerimentoProedi $requerimento, EnviarRelatorioTrimestral $relatorio, Tenant $tenant)
    {
        $this->repository = $requerimento;
        $this->relatorio = $relatorio;
        $this->tenant = $tenant;
    }

    public function donwload(StoreRequerimentoProedi $request) {

        $data = $request->all();

        $cnpj_traco =  str_replace("-", "", $data['cnpj']);
        $cnpj_barra =  str_replace("/", "", $cnpj_traco);
        $cnpj =  str_replace(".", "", $cnpj_barra);

        $data['tenant_id'] = auth()->user()->tenant_id;

         $id = $this->repository->create($data);

        $requerimento = DB::table('requerimento_proedis')->where('id', '=', $id['id'] )->latest()->get();

        if(!$empresa = $this->tenant->find($data['tenant_id'])) {
                return redirect()->back();
        }

        $request['cnpj'] = $cnpj;

        $empresa->update($request->all());              
       
        return view('admin.proedi.requerimento.requerimento');
    }
}
