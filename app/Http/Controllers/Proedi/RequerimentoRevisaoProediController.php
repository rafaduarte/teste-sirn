<?php

namespace App\Http\Controllers\Proedi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequerimentoRevisaoProedi;
use App\Models\proedi\requerimentoRevisaoProedi;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequerimentoRevisaoProediController extends Controller
{
    public function __construct(requerimentoRevisaoProedi $requerimento, Tenant $tenant)
    {
        $this->repository = $requerimento;
        $this->tenant = $tenant;
    }

    public function donwload(StoreRequerimentoRevisaoProedi $request) {

        $data = $request->all();

        $cnpj_traco =  str_replace("-", "", $data['cnpj']);
        $cnpj_barra =  str_replace("/", "", $cnpj_traco);
        $cnpj =  str_replace(".", "", $cnpj_barra);

        $data['tenant_id'] = auth()->user()->tenant_id;

       $requerimento = $this->repository->create($data);
       
        
        if(!$empresa = $this->tenant->find($data['tenant_id'])) {

            return redirect()->back();
        }

        $request['cnpj'] = $cnpj;

        $empresa->update($request->all());

        return view('admin.proedi.requerimento.revisao.requerimento');
    }
}
