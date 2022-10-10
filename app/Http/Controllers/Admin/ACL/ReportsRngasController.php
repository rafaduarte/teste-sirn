<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Exports\Rngas\EspecificoExport;
use App\Exports\Rngas\GeralExport;
use App\Http\Controllers\Controller;
use App\Models\RnGas\ConcessaoRnGas;
use App\Models\RnGas\RnGas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsRngasController extends Controller
{
    public function __construct(RnGas $rngas, ConcessaoRnGas $relatorio)
    {   
        $this->repository = $rngas;
        $this->relatorio = $relatorio;
        //$this->middleware(['can:reports']);
    }
    public function index(){
        return view('admin.reports.rngas.index');
    }

    public function stringToInt($money, $gas){

        if ($gas != 0) {

            $cover = str_replace(".", "", $gas);     
       
        $n = intval($cover);

        return $n;

        }

        if ($money != 0) {

            $cover = str_replace(",", "", $money);

            $coverd = str_replace(".", "", $cover);
           
            $var = intval($coverd);
    
            $n = $var / 10;
    
            if ($n == 0) {
                $n = null;
            }

            return $n;
        }       
    }

    public function geral( Request $request){
        //$empresas = DB::table('tenants')->get();
 
         $query = RnGas::query();        

         $area_atuacao = $request->get('area_atuacao');
         $produto = $request->get('produto');
         $tipo_empresa = $request->get('tipo_empresa');
         $municipio = $request->get('municipio');
         $data_inicio = $request->data_inicio; //$request->get('data_inicio');
         $data_fim =  $request->get('data_fim');     
         
         if(isset($area_atuacao)){
             $query->where('area_atuacao', '=', $area_atuacao);
         }
         if(isset($produto)){
             $query->where('produto', '=', $produto);
         }
         if(isset($tipo_empresa)){
             $query->where('tipo_empresa', '=', $tipo_empresa);
         }
         if(isset($municipio)){
             $query->where('municipio', '=', $municipio);
         }
         if(isset($data_inicio )){
             $query->whereDate('data_inicio', '>=', $data_inicio);
         }
         if(isset($data_fim )){
             $query->whereDate('data_final', '<=', $data_fim);
         } 
 
         $empresas = $query->paginate(); 
       
        if($request->input('enviar')){
         session()->put('empresas', $empresas);
         return view('admin.reports.rngas.geral.index', compact('empresas'));
        }
 
        if($request->input('relatorio_excel')){
         $empresas = session('empresas');   
         return Excel::download( new GeralExport($empresas), 'relatorio.xlsx');
        }
 
        if($request->input('relatorio_csv')){
         $empresas = session('empresas');
         return Excel::download( new GeralExport($empresas), 'relatorio.csv');
        }
 
        if($request->input('relatorio_ods')){
         $empresas = session('empresas');
         return Excel::download( new GeralExport($empresas), 'relatorio.ods');
        }
        
        if($request->input('relatorio_pdf')){
         $empresas = session('empresas');
         return Excel::download( new GeralExport($empresas), 'relatorio.pdf');
        }
     }
   
    public function especifico(Request $request){
                     
        $query = ConcessaoRnGas::query();

        $data = $request->all();

        $produtos_processos = $request->get('produtos_processos');
        $projecao_receitas = $request->get('projecao_receitas');

        $projecao_custos = $this->stringToInt($request->get('projecao_custos'), 0);
        $investimento = $this->stringToInt($request->get('investimento'), 0);
        $projecao_fluxo_caixa = $this->stringToInt($request->get('projecao_fluxo_caixa'), 0);
        $projecao_custos = $this->stringToInt($request->get('projecao_custos'), 0);
                
        $consumo_gas_mes = $this->stringToInt(0 , $request->get('consumo_gas_mes')); 
        $demanda_gas_tres_anos = $this->stringToInt(0, $request->get('demanda_gas_tres_anos'));
        $percentual_gas = $request->get('percentual_gas'); 

        $quantidade_empregos = $request->get('quantidade_empregos');         

        $projecao_receitas = $this->stringToInt($projecao_receitas, 0);
        $projecao_receitas = $this->stringToInt($projecao_receitas, 0);
        $investimento = $this->stringToInt($investimento, 0);

        $projecao_fluxo_caixa = $this->stringToInt($projecao_fluxo_caixa, 0);
        $projecao_custos = $this->stringToInt($projecao_custos, 0);

        //dd($data);        
        
        if(isset($produtos_processos)){
            $query->where('produtos_processos', 'LIKE', "%$produtos_processos%");
        }
        if(isset($projecao_receitas)){
            $query->where('projecao_receitas', '<=', $projecao_receitas);
        }
        if(isset($investimento)){
            $query->where('investimento', '<=', $investimento);
        }
        if(isset($projecao_fluxo_caixa)){
            $query->where('projecao_fluxo_caixa', '<=', $projecao_fluxo_caixa);
        }
        if(isset($projecao_custos)){
            $query->where('projecao_custos', '<=', $projecao_custos);
        }
        if(isset($consumo_gas_mes)){
            $query->where('consumo_gas_mes', '<=', $consumo_gas_mes);
        }
        if(isset($demanda_gas_tres_anos)){
            $query->where('demanda_gas_tres_anos', '<=', $demanda_gas_tres_anos);
        }
        if(isset($percentual_gas)){
            $query->where('percentual_gas', '<=', $percentual_gas);
        }
        if(isset($quantidade_empregos)){
            $query->where('quantidade_empregos', '<=', $quantidade_empregos);
        }     
            
        $especificos = $query->paginate(); 
        
       if($request->input('enviar')){
        session()->put('especificos', $especificos);
        return view('admin.reports.rngas.especifico.index', compact('especificos'));
       }
              
       if($request->input('relatorio_excel')){        
         $especificos = session('especificos');        
         return Excel::download( new EspecificoExport($especificos), '1especifico.xlsx');        
       }

       if($request->input('relatorio_csv')){        
        $especificos = session('especificos');        
        return Excel::download( new EspecificoExport($especificos), '1especifico.csv');        
      }
      if($request->input('relatorio_ods')){        
        $especificos = session('especificos');        
        return Excel::download( new EspecificoExport($especificos), '1especifico.ods');        
      }
        
    }
}
