<?php

namespace App\Http\Controllers\Rngas\Analisys;

use App\Http\Controllers\Controller;
use App\Models\RnGas\ConcessaoRnGas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    public function __construct(ConcessaoRnGas $pedir)
    {
        $this->repository = $pedir;
        $this->middleware(['can:proediadmin']);
    }

    public function index() {

        $pedidos = $this->repository->latest()->paginate();
        
        return view('admin.rngas.analise.menu', compact('pedidos'));
    }

}
