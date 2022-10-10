<?php

namespace App\Http\Controllers\Mensagens;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMensageTenant;
use App\Mail\mensagem\tenantMensagemSemAnexo;
use App\Mail\proedi\mensagem\TenantMensagem as MensagemTenantMensagem;
use App\Models\Mensagens\adminMensagem;
use App\Models\Mensagens\tenantMensagem;
use App\Models\Profile;
use App\Models\Tenant;
use App\Notifications\proedi\user\email\mensagens;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use PhpParser\Node\Stmt\Echo_;

class tenantMensagensController extends Controller
{
   public function __construct(tenantMensagem $tenantMensagem, adminMensagem $mensagem)
   {
       $this->repository = $tenantMensagem;
       $this->visualizar = $mensagem;

   }

   public function index() {

        $name = auth()->user()->name;
       
        $mensagens = DB::table('admin_mensagems')->where('destinatario', '=', $name)->latest()->paginate();

        $user_id = auth()->user()->id;
        $destinatario = auth()->user()->name;

        //$user = User::where('id', '=', $user_id)->first();

        DB::table('admin_mensagems')->where('destinatario', '=', $destinatario)
                                  ->whereNull('read_at')->update(['read_at' => now()]);

        //$user->unreadNotifications->markAsRead();

        return view('admin.mensagens.tenant.index', compact('mensagens'));
   }
   
   public function show($id) {

     $mensagem = $this->visualizar->find($id);

      //$mensagem_id = $mensagem->tenant_id;

     return view('admin.mensagens.tenant.show', compact('mensagem'));
 }

   public function create() {

        return view('admin.mensagens.tenant.create');
   }

   public function store(StoreMensageTenant $request) {
        
      //$name = auth()->user()->name;

        //dd($data);

       //$mensage = $this->repository->create($data);             

       $profiles = Tenant::where('name', '=', 'sedecrn')->first();

       $emails = $profiles->users()->first();

       $datas = [];

       if($request->hasfile('files'))
         {
            foreach($request->file('files') as $file)
            {
                $name = $file->getClientOriginalName();
                
                $file->move(storage_path(), $name);

                $data[] = $name;
                //array_push($datas, $data);  
            }
         }

         if(!empty($data)) {

          $datas = [
               'name' => auth()->user()->name,
               'assunto' => $request['assunto'],
               'mensagem' => $request['mensagem'],
               'files' => $data
          ];

          Mail::to('codit.sedecrn@gmail.com')->send(new MensagemTenantMensagem($datas));

          $datas['files'] = json_encode($data);

         } else {

          $datas = [
               'name' => auth()->user()->name,
               'assunto' => $request['assunto'],
               'mensagem' => $request['mensagem']
          ];

          //Mail::to('codit.sedecrn@gmail.com')->send(new tenantMensagemSemAnexo($datas));
         } 
        
          $mensage = $this->repository->create($datas);
       
        Notification::send($emails, new mensagens($mensage));         

        return redirect()->route('tenant.mensagem.index');
   }

   public function sent() {

        //$name = auth()->user()->name;

        $mensagens = $this->repository->latest()->paginate();

        return view('admin.mensagens.tenant.sent', compact('mensagens'));
   }

}
