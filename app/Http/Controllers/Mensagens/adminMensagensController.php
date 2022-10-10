<?php

namespace App\Http\Controllers\Mensagens;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMensageAdmin;
use App\Models\Mensagens\adminMensagem;
use App\Models\Mensagens\tenantMensagem;
use App\Models\Tenant;
use App\Notifications\proedi\admin\email\concessao;
use App\Notifications\proedi\admin\email\mensagens;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\VarDumper\Cloner\Data;

class adminMensagensController extends Controller
{
    public function __construct(adminMensagem $mensagem, tenantMensagem $empresas)
    {
        $this->repository = $mensagem;
        $this->empresas = $empresas;
        $this->middleware(['can:mensagensadmin']);
    }

    public function index() {

        $user_id = auth()->user()->tenant_id;

        //dd($user_id);

        //DB::table('notifications')->where('notifiable_id', '=',  $user_id)->update(['read_at' => now()]);

        //$user = Auth::user()->unreadNotifications;

        //$user->unreadNotifications()->update(['read_at' => now()]);

        $user_id = auth()->user()->tenant_id;

        $user = User::where('id', '=', $user_id)->first();

        //$user->unreadNotifications->markAsRead();

        DB::table('tenant_mensagems')->where('destinatario_tenant_id', '=', $user_id)
                                  ->whereNull('read_at')->update(['read_at' => now()]);

        
        $mensagens = $this->empresas->latest()->paginate();

        return view('admin.mensagens.admin.index', compact('mensagens'));
        //dd( $mensagens);
    }

    public function show($id) {

        if (!$mensagem = $this->empresas->find($id)) {
            return redirect()->back();
        }
        
        //DB::table('notifications')->where('notifiable_id', '=',  $id)->update(['read_at' => now()]);
        
        return view('admin.mensagens.admin.show', compact('mensagem'));
    }

    public function destroy($id) {

        if (!$mensagem = $this->empresas->find($id)) {
            return redirect()->back();
        }

        $mensagem->delete();

        return redirect()->route('admin.mensagem.index');

    }

    public function create() {

        $tenants = DB::table('tenants')->pluck('name', 'cnpj')->except('name','=', '2554536546654');

        return view('admin.mensagens.admin.create', compact('tenants'));
    }

    public function store(StoreMensageAdmin $request) {
        
        $data = $request->all();

        $data['name'] = auth()->user()->name;

        $data['tenant_id'] = auth()->user()->tenant_id;

        $cnpj = $data['destinatario'];        

        $destinatario = DB::table('tenants')->where('cnpj', '=',  $cnpj)->first('name');

        $data['destinatario'] =  $destinatario->name;
        
        $mensagen =  $this->repository->create($data);

        $user = Tenant::where('name', '=',  $destinatario->name)->first();
        
        $emails = $user->users()->get();
       
        Notification::send($emails, new mensagens($mensagen));

        return redirect()->route('admin.mensagem.index');
    }

    public function sent() {

        $name = auth()->user()->name;

        $mensagens = DB::table('admin_mensagems')->where('name', '=', $name)->latest()->paginate();

        return view('admin.mensagens.admin.sent', compact('mensagens'));
    }
    
    public function notification() {

        if (isset(Auth::user()->unreadNotifications)) {
                
            //$notifications =  Auth::user()->unreadNotifications;

            //$user = Auth::user()->unreadNotifications;

            //$user->unreadNotifications()->update(['read_at' => now()]);
            
            return view('vendor.adminlte.partials.navbar.menu-item-fullscreen-widget.blade', compact('notifications'));
            

          //$qtd =  Auth::user()->unreadNotifications;

          
        }
    } 

}
