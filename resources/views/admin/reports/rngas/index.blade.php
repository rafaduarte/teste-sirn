
<!-- scrips da mascara monetaria !-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

   <script>
       $(document).ready(function(){
   $('.money').mask('000.000.000.000.000,00', {reverse: true});   
});
   </script>
   
   <script>
    $(document).ready(function(){
$('.gas').mask('000.000.000.000.000', {reverse: true});   
});
</script>

@extends('adminlte::page')

@section('title', 'RN Mais Gás')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('reports.index')}}">Menu</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('reports.proedi.index')}}">Relatório do RN Mais Gás</a></li>
    </ol>

@stop

@section('content')
    <div class="card">
        <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Geral</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Específico </a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="card-header">            
                    <h3>Filtros Gerais</h3>
                </div>
                <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <form action="{{ route('reports.rngas.geral') }}" class="form" method="GET">
                                    @csrf
                                    <div class="form-group">
                                        <label>Percentual do Desconto:</label>
                                        <input type="text" value="{{ request('desconto') }}" name="desconto" class="form-control"> 
                                        <h6>* Só Números</h6>
                                    </div>
                                   <div class="form-group">
                                       <label>Área de Atuação:</label>
                                       <input type="text" value="{{ request('area_atuacao') }}" name="area_atuacao" class="form-control"> 
                                   </div>
                                   <div class="form-group">
                                    <label>Produto da Empresa:</label>
                                    <input type="text" value="{{ request('produto') }}" name="produto" class="form-control">
                                    <label>Tipo de Empresa:</label>
                                    <input type="text" value="{{ request('tipo_empresa') }}" name="tipo_empresa" class="form-control"> 
                                </div>
                                   <div class="form-group">
                                    <label>Município da Empresa:</label>
                                    <input type="text" value="{{ request('municipio') }}" name="municipio" class="form-control">
                                       <label>Data de Início:</label>
                                    <input type="date" value="{{ request('data_inicio') }}" name="data_inicio" class="form-control">
                                    <label>Data Final:</label>
                                    <input type="date" value="{{ request('data_fim') }}" name="data_fim" class="form-control"> 
                                   </div>
                                    
                                   <div class="btn-group" role="group" aria-label="Basic example">
                                    <input name="enviar" class="btn btn-primary" type="submit" value="Visualizar">
                                  </div>                                  
                                </form>                               
                        </table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-header">            
                    <h3>Filtros Específicos</h3>
                </div>               
                <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <form action="{{ route('reports.rngas.especifico') }}" class="form" method="GET">
                                    @csrf
                                   <div class="form-group">                                      
                                       <label>Produtos e Processos:</label>
                                       <input type="text" value="{{ request('produtos_processos') }}" name="produtos_processos" class="form-control"> 
                                   </div>
                            <div class="form-group">                                                                   
                                 <label>Projeção de Receitas:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('projecao_receitas') }}" class="form-control" name="projecao_receitas" >                                    
                                 <label>Investimento:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento') }}" class="form-control" name="investimento" >
                                 <label>Projeção de Fluxos de Caixas:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('projecao_fluxo_caixa') }}" name="projecao_fluxo_caixa" class="form-control">
                                 <label>Projeção de Custos:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('projecao_custos') }}" name="projecao_custos" class="form-control">
                             </div>    
                                   <div class="form-group">
                                       <script>
                                           function updateTextInput(val) {
                                                document.getElementById('textInput').value=val; 
                                                }
                                           </script>                                                                          
                                    <label>Previsão de Consumo do Gás Natural Por Mês(m³):</label>
                                    <input style="width: 100%; border-style: outset" type="text" value="{{ request('consumo_gas_mes') }}" name="consumo_gas_mes" class="gas" onchange="updateTextInput(this.value);">                                    
                                    <label>Previsão da Projeção da Demanda do Gás Natural nos Próximos 3 Anos(m³):</label>
                                    <input style="width: 100%; border-style: outset" type="text" value="{{ request('demanda_gas_tres_anos') }}" name="demanda_gas_tres_anos" class="gas">
                                    <label>Indicação do Percentual do Gás Natural nos Próximos 3 Anos:</label>
                                    <input style="width: 100%; border-style: outset" type="text" value="{{ request('percentual_gas') }}" name="percentual_gas" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Número de Empregos Diretos e Indiretos Existentes ou a Serem Gerados:</label>
                                    <input type="text" value="{{ request('quantidade_empregos') }}" name="quantidade_empregos" class="form-control">                                                                          
                                   </div>                                
                                                          
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <input name="enviar" class="btn btn-primary" type="submit" value="Visualizar">                                        
                                      </div>
                                   
                                </form>                                
                        </table>
                </div>
            </div>      
          </div>            
                    
        <div class="card-footer">
        </div>
    </div>
@stop


