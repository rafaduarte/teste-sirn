<?php

namespace App\Http\Controllers\Proedi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProedi;
use App\Models\proedi\Proedi;
use App\Models\Tenant;
use App\Notifications\proedi\user\email\proedi as EmailProedi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

use function PHPUnit\Framework\isNull;

class ProediController extends Controller
{
    public function __construct(Proedi $proedis, Tenant $tenants)
    {
        $this->repository = $proedis;
        $this->tenant = $tenants;
        $this->middleware(['can:proediadmin']);
    }

    public function index() {

        $id = auth()->user()->tenant->id;

        $proedis = DB::table('proedis')->where('tenant_id', "$id")->get();

        $quantidadeProedi = DB::table('proedis')->get('id')->count();

        $quantidadeConcessao = DB::table('pedir_concessao_proedis')->get('id')->count();

        $countRevision = DB::table('pedir_revisao_proedis')->get('id')->count();

        $countReport = DB::table('enviar_relatorio_proedis')->get('id')->count();

        $countFirstReport = DB::table('enviar_relatorio_trimestrals')->get('id')->count();

        $countSecondReport = DB::table('enviar_relatorio_segundo_trimestres')->get('id')->count();

        $countThirdReport = DB::table('enviar_relatorio_terceiro_trimestres')->get('id')->count();

        $countFourthReport = DB::table('enviar_relatorio_quarto_trimestres')->get('id')->count();

        $soma =  $countFirstReport +  $countSecondReport + $countThirdReport +  $countFourthReport;

        //dd( $soma);

        return view('admin.proedi.proedi.index', compact('proedis', 'quantidadeConcessao',
         'quantidadeProedi', 'countRevision', 'countReport', 'soma'));
    }

    public function create() {

        $tenants = DB::table('tenants')->pluck('name', 'cnpj')->except('name','=', '2554536546654');
        //$data = $this->repository
        return view('admin.proedi.proedi.create', compact('tenants'));
    }

    public function store(StoreUpdateProedi $request) {
        
        $data = $request->all();
        //$tenant_id = DB::table('tenants')->select('email', 'cnpj')->where('name', "%{$request->nome_empresa}%")->get();

        $tenant_id = DB::table('tenants')->where('cnpj', "$request->nome_empresa")->first('id');

        $tenant_name = DB::table('tenants')->where('cnpj', "$request->nome_empresa")->first('name');

        //dd($tenant_name);

        //dd($request->cnpj);

        $data['tenant_id'] = $tenant_id->id;
        $data['name'] = $tenant_name->name;
        $data['desconto'] = $request['desconto'] . "%";

        $email = User::where('tenant_id', '=', $tenant_id->id )->first();

        $proedi = $this->repository->create($data);

        Notification::send($email, new EmailProedi($proedi));

        return redirect()->route('proedi.proedi');

    }

    public function proedi() {

        $proedis = DB::table('proedis')->latest()->paginate();

       return view('admin.proedi.proedi.proedi', compact('proedis'));
    }

    public function destroy($id)
    {
        if(!$proedi = $this->repository->find($id)) {
            return redirect()->back();
        }

        $proedi->delete();

        return redirect()->back();
    }
    
    public function search(Request $request) {

        $filters = $request->only('filter');
 
        $proedis = $this->repository
                        ->where(function($query) use ($request){
                            if ($request->filter) {
                                $query->orWhere('municipio', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('desconto', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('area_atuacao', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('produto', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('tipo_empresa', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('municipio', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('data_inicio', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('data_final', 'LIKE', "%{$request->filter}%");
                            }
                        })
                        ->latest()
                        ->paginate();
 
        return view('admin.proedi.proedi.proedi', compact('proedis', 'filters'));
    }

    public function show() {
        //dd("teste");
    }
}
