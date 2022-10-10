<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Mail\usuarios\PedirEdicaoDados;
use App\Mail\usuarios\PermitirEdicaoDados;
use App\Models\Profile;
use App\Models\Tenant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user, Tenant $tenant)
    {
         $this->repository = $user;

         $this->tenant = $tenant;
         
        $this->middleware(['can:usuario']);

    }
    public function index()
    {
        // 1 $users = $this->repository->paginate();

        $users = $this->repository->latest()->tenantUser()->paginate();
 
        return view('admin.users.index', compact('users'));
    }

    public function indexTenant()
    {            
        $users = DB::table('users')->where('admin_tenant', true)->get();         
        
         return view('admin.users.index_tenant', compact('users'));
    }

    
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        //$data['password'] = bcrypt($data['password']); // encrypt a senha

        $senha = $data['password'];
        $corfirmar_senha = $data['confirm_password'];

        if($senha != $corfirmar_senha) {

            return redirect()->back()->with('message','A Confirmação da senha está diferente');
        }

        if($senha == $corfirmar_senha) {
                        
            $data['password'] = bcrypt($data['password']); // encrypt a senha

            $user = $this->repository->create($data);

            if($data['tenant_id'] != 1) {

                $setor = Profile::where('name', '=', 'empresa')->first();
                
                $user->profiles()->attach($setor);
            }
             
            return redirect()->route('users.index');

        }
    }

    public function edit($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }
        
        return view('admin.users.edit', compact('user'));
    }

    public function editDatas($id)
    {
        if (!$tenant = $this->tenant->find($id)) {
            return redirect()->back();
        }

        return view('admin.users.edit_tenant', compact('tenant'));
    }

    public function pedirEdicao($id) {
      
        if (!$user = $this->repository->find($id)) {
              return redirect()->back();
        }
  
        $user['pedir_editar'] = true;
  
        $user->update();
  
        Mail::to('codit.sedecrn@gmail.com')->send(new PedirEdicaoDados($user));
  
        return $this->index();
      }


    public function update(StoreUpdateUser $request, $id)
    {
    
     if (!$user = $this->repository->find($id)) {
         return redirect()->back();
     }

     //$data = $request->only(['name', 'email','password']);

     $data = $request->all();

     $user->update($data);
 
     return redirect()->route('users.index');         
         
    }

    public function updateDatas(Request $request, $id)
    {
        if (!$tenant = $this->tenant->find($id)) {
            return redirect()->back();
        }

        $user_id = Auth::user()->id;

        if (!$user = $this->repository->find($id)) {

            return redirect()->back();
        }

        $user['editar'] = false;
        $user['pedir_editar'] = false;

        $user->update();

        $data = $request->all();
        
        $tenant->update($data);

        return redirect()->route('users.index');

    }


    public function show($id)
    {
        $user = $this->repository->find($id);
 
        if (!$user) {
            return redirect()->back();
        }

        if (!$tenant = $this->tenant->find($user->tenant_id)) {
            return redirect()->back();
        }

        $cnpj = $tenant['cnpj'];

        $cnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
 
        $tenant['cnpj'] = $cnpj;

        return view('admin.users.show', compact('user', 'tenant'));
    }

    public function destroy($id)
    {
     if (!$user = $this->repository->find($id)) {
         return redirect()->back();
     }
     $user->delete();
 
     return redirect()->route('users.index');
    }

    public function permitirEditar($id) {

        if (!$user = $this->repository->find($id)) {
            
            return redirect()->back();
        }

        if (!$tenant = $this->tenant->find($user->tenant_id)) {

            return redirect()->back();
        }

        $email = DB::table('users')->where('name', $tenant->name)->pluck('email');

        $user['editar'] = true;
        $user['pedir_editar'] = false;
        $user->update();

        Mail::to($email)->send(new PermitirEdicaoDados($user));
        
        return redirect()->route('user.index.tenants');
    }

    public function retirarEditar($id) {

        if (!$user = $this->repository->find($id)) {
            
            return redirect()->back();
        }

        $user['editar'] = false;
        $user->update();
        
        return redirect()->route('user.index.tenants');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');
 
        $users = $this->repository
                        ->where(function($query) use ($request){
                            if ($request->filter) {
                                $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('email', "%{$request->filter}%");
                            }
                        })
                        ->paginate();
 
        return view('admin.pages.users.index', [
         'users' => $users,
         'filters' => $filters,
     ]);
    }
}
