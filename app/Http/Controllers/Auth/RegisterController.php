<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use App\Services\TenantService;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Tenant $tenant)
    {   
        $this->tenant = $tenant;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'social_name' => ['required', 'min:3', 'max:255'],
            'name' => ['required', 'min:3', 'max:255'],
            'cnpj' => 'required',
            'inscricao_estadual' => ['required', 'numeric'],
            'endereco_empresa' => ['required', 'min:5', 'max:255'],
            'municipio' => ['required', 'min:2', 'max:255'],
            'uf' => ['required', 'min:2', 'max:255'],
            'cep' => 'required',
            'telefone' => ['required', 'numeric', 'min:6'],
            'email' => 'regex:/^.+@.+$/i',
            'inicio_atividade' => 'required|date',
            'tipo_empresa' => ['required', 'min:2'],
            'cpf' => 'required',
            'endereco_empresario' => ['required', 'min:5', 'max:255'],
            'municipio_empresario' => ['required', 'min:2', 'max:255'],
            'uf_empresario' => ['required', 'min:2', 'max:255'],
            'cep_empresario' => 'required',
            'telefone_empresario' => ['required', 'numeric', 'min:6'],
            'email_empresario' => 'regex:/^.+@.+$/i',
            'password' =>  ['required', 'string', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\w!@#$%&*]{8,}$/', 'confirmed'],            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return App\User
     */
    protected function create(array $data)
    {                    
        $cnpj_traco =  str_replace("-", "", $data['cnpj']);
        $cnpj_barra =  str_replace("/", "", $cnpj_traco);
        $cnpj =  str_replace(".", "", $cnpj_barra);
       
        $cpf_traco =  str_replace("-", "", $data['cpf']);
        $cpf =  str_replace(".", "", $cpf_traco); 

        $cep = str_replace("-", "", $data['cep']);
        $cep_empresario = str_replace("-", "", $data['cep_empresario']);
        
            $tenant = Tenant::create([
                'social_name' => $data['social_name'],
                'name' => $data['name'],
                'cnpj' => $cnpj,
                'inscricao_estadual' => $data['inscricao_estadual'],
                'endereco_empresa' => $data['endereco_empresa'],
                'municipio' => $data['municipio'],
                'uf' => $data['uf'],
                'cep' => $cep,
                'telefone' => $data['telefone'],
                'email' => $data['email'],
                'inicio_atividade' => $data['inicio_atividade'],
                'tipo_empresa' => $data['tipo_empresa'],
                'nome_empresario' => $data['nome_empresario'],
                'cpf' => $cpf,
                'endereco_empresario' => $data['endereco_empresario'],
                'municipio_empresario' => $data['municipio_empresario'],
                'uf_empresario' => $data['uf_empresario'],
                'cep_empresario' => $cep_empresario,
                'telefone_empresario' => $data['telefone_empresario'],
                'email_empresario' => $data['email_empresario'],
                
                'subscription' => now(),
                //'expires_at' => now()->addDays(7), // o acesso expira em sete dias            
            ]);            

        $setor = Profile::where('name', '=', 'empresa')->first();          
           
         $user = $tenant->users()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'admin_tenant' => true,
            'password' => bcrypt($data['password']),
        ]);
        
        $user->profiles()->attach($setor);

        return $user;        
     

       

     /*$user = $tenant->users()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user; */

     /*  return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cnpj' => ['required', 'numeric', 'min:3', 'unique:tenants,name'],
        ]); */

        /*$tenantService = app(TenantService::class); // cria uma instância da classe
        $user = $tenantService->make($data);

        return $user; */
    }
}
