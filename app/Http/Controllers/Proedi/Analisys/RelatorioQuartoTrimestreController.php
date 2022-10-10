<?php

namespace App\Http\Controllers\Proedi\Analisys;

use App\Http\Controllers\Controller;
use App\Mail\proedi\relatorio\PermitirEdicaoQuartoRelatorio;
use App\Models\proedi\EnviarRelatorioQuartoTrimestre;
use App\Models\proedi\EnviarRelatorioSegundoTrimestre;
use App\Models\proedi\EnviarRelatorioTerceiroTrimestre;
use App\Models\proedi\EnviarRelatorioTrimestral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RelatorioQuartoTrimestreController extends Controller
{
    public function __construct(EnviarRelatorioTrimestral $primeiros ,EnviarRelatorioSegundoTrimestre $segundos,
     EnviarRelatorioTerceiroTrimestre $terceiros, EnviarRelatorioQuartoTrimestre $quartos)
    {       
        
        $this->terceiros = $terceiros;
        $this->primeiros = $primeiros;
        $this->segundos = $segundos;
        $this->repository = $quartos;
        $this->middleware(['can:proediadmin']);
    }

    public function index()
    {
        $primeiros = $this->primeiros->latest()->paginate();
        $segundos = $this->segundos->latest()->paginate();
        $terceiros = $this->terceiros->latest()->paginate();
        $quartos = $this->repository->latest()->paginate();        
 
        return view('admin.proedi.analisys.relatorio.index', compact(['primeiros', 'segundos',
        'terceiros', 'quartos']));
    }

    public function show($id) {

        if(!$quarto = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.proedi.analisys.relatorio.quarto_trimestre.show', compact('quarto'));
    }
    
    public function destroy($id) {

        if (!$quarto = $this->repository->find($id)) {
            return redirect()->back();
        }

        $quarto->delete();

        $primeiros = $this->primeiros->latest()->paginate();
        $segundos = $this->segundos->latest()->paginate();
        $terceiros = $this->terceiros->latest()->paginate();
        $quartos = $this->repository->latest()->paginate();

        return view('admin.proedi.analisys.relatorio.index', compact(['primeiros', 'segundos', 'terceiros', 'quartos']));
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');
 
        $quartos = $this->repository
                        ->where(function($query) use ($request){
                            if ($request->filter) {
                                $query->orWhere('razao_social', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('cnpj', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('created_at', 'LIKE', "%{$request->filter}%");
                            }
                        })
                        ->latest()
                        ->paginate();

        $primeiros = $this->primeiros->latest()->paginate();
        $segundos = $this->segundos->latest()->paginate();
        $terceiros = $this->terceiros->latest()->paginate();        
 
        return view('admin.proedi.analisys.relatorio.index', compact(['primeiros', 'segundos' ,
        'terceiros', 'quartos', 'filters']));
    }

    public function permitirEditar($id) {

        if (!$relatorio = $this->repository->find($id)) {
            
            return redirect()->back();
        }

        $email = DB::table('users')->where('name', $relatorio->nome_empresa)->pluck('email');

        $relatorio['editar'] = true;
        $relatorio['pedir_editar'] = false;
        $relatorio->update();

        //dd($email);

        Mail::to($email)->send(new PermitirEdicaoQuartoRelatorio($relatorio));
        
        return $this->index();
    }

    public function retirarEditar($id) {

        if (!$relatorio = $this->repository->find($id)) {
            
            return redirect()->back();
        }

        $relatorio['editar'] = false;
        $relatorio->update();
        
        return $this->index();
    }
}
