<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('admin.proedi');

        /**
         * informações do menu principal
         */

        $tenant_id = auth()->user()->tenant->id;

        $sedec = auth()->user()->tenant->social_name;

        $proedis = DB::table('proedis')->where('tenant_id', "$tenant_id")->get();

        $quantidadeProedi = DB::table('proedis')->get('id')->count();

        $quantidadeConcessao = DB::table('pedir_concessao_proedis')->get('id')->count();

        $countRevision = DB::table('pedir_revisao_proedis')->get('id')->count();

        $countReport = DB::table('enviar_relatorio_proedis')->get('id')->count();

        /**
         *  views for industry
         */
        $quantidadeConcessaoEmpresa = DB::table('pedir_concessao_proedis')->where('tenant_id', "$tenant_id")->get('id')->count();

        $countRevisionBusiness = DB::table('pedir_revisao_proedis')->where('tenant_id', "$tenant_id")->get('id')->count();

        $countReportBusiness = DB::table('enviar_relatorio_proedis')->where('tenant_id', "$tenant_id")->get('id')->count();

        /**
         * 
         */

       // $notifications =  Auth::user()->unreadNotifications;

        //dd($notifications);

        if($tenant_id == 1){
            return view('admin.proedi.proedi.index', compact('proedis','quantidadeProedi','quantidadeConcessao',
        'countRevision', 'countReport'));
        }

        if($tenant_id != 1){
            /*
            return view('admin.proedi.tenant.index', compact('quantidadeProedi', 'quantidadeConcessaoEmpresa',
            'countRevisionBusiness', 'countReport')); */

            return redirect()->route('proedi.empresa.index');
        }
        
    }

    public function home()
    {
        return view('auth.login');
    }
}
