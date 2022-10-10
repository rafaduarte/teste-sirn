<?php

namespace App\Http\Controllers\Rngas;

use App\Http\Controllers\Controller;
use App\Http\Requests\RnGas\StoreUpdateRequerimentoRnGas;
use App\Models\RnGas\RequerimentoRnGas;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequerimentoRngasController extends Controller
{
    public function __construct(RequerimentoRnGas $requerimento, Tenant $tenant)
    {
        $this->repository = $requerimento;
        $this->tenant = $tenant;
    }

    public function donwload(StoreUpdateRequerimentoRnGas $request) {

        $data = $request->all();

        $cnpj_traco =  str_replace("-", "", $data['cnpj']);
        $cnpj_barra =  str_replace("/", "", $cnpj_traco);
        $cnpj =  str_replace(".", "", $cnpj_barra);

        $data['tenant_id'] = auth()->user()->tenant_id;

         $id = $this->repository->create($data);

        $requerimento = DB::table('requerimento_rn_gases')->where('id', '=', $id['id'] )->latest()->get();

        if(!$empresa = $this->tenant->find($data['tenant_id'])) {
                return redirect()->back();
        }

        $request['cnpj'] = $cnpj;

        $empresa->update($request->all());              
       
        return view('admin.rngas.concessao.requerimento.requerimento');
    }
}
