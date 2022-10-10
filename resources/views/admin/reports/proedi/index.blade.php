
<!-- scrips da mascara monetaria !-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

   <script>
       $(document).ready(function(){
   $('.money').mask('000.000.000.000.000,00', {reverse: true});   
});
   </script> 

@extends('adminlte::page')

@section('title', 'Proedi')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('reports.index')}}">Menu</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('reports.proedi.index')}}">Relatório do PROEDI</a></li>
    </ol>

@stop

@section('content')
    <div class="card">
        <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Geral</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">1º Trimestre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">2º Trimestre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-place-tab" data-toggle="pill" href="#pills-place" role="tab" aria-controls="pills-place" aria-selected="false">3º Trimestre</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-fourth-tab" data-toggle="pill" href="#pills-fourth" role="tab" aria-controls="pills-fourth" aria-selected="false">4º Trimestre</a>
              </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="card-header">            
                    <h3>Filtros Para Geração de Relatórios Gerais</h3>
                </div>
                <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <form action="{{ route('reports.proedi.empresas') }}" class="form" method="GET">
                                    @csrf
                                   <div class="form-group">
                                       <label>Percentual do Benefício:</label>
                                       <input type="text" value="{{ request('desconto') }}" name="desconto" class="form-control">
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
                    <h3>Filtros Para Geração de Relatórios do 1º Trimestre</h3>
                </div>               
                <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <form action="{{ route('reports.proedi.trimestre') }}" class="form" method="GET">
                                    @csrf
                                   <div class="form-group">
                                       <label>Benefícios:</label>
                                       <input type="text"  name="outros_beneficios" class="form-control">
                                       <label>Tem Placa PROEDI?</label>
                                       <input type="text" value="{{ request('placa_proedi') }}" name="placa_proedi" class="form-control"> 
                                   </div>
                            <div class="form-group">                                                                   
                                 <label>Faturamento Em Janeiro:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_janeiro') }}" class="form-control" name="faturamento_janeiro" >                                    
                                 <label>Faturamento Em Fevereiro:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_fevereiro') }}" class="form-control" name="faturamento_fevereiro" >
                                 <label>Faturamento Em Março:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_marco') }}" name="faturamento_marco" class="form-control">
                             </div>    
                                   <div class="form-group">
                                       <script>
                                           function updateTextInput(val) {
                                                document.getElementById('textInput').value=val; 
                                                }
                                           </script>                                                                          
                                    <label>Empregos Gerados Em Janeiro:</label>
                                    <input type="text"  min="0" max="1000" value="{{ request('empregos_gerados_trimestre_janeiro') }}" name="empregos_gerados_trimestre_janeiro" class="form-control" onchange="updateTextInput(this.value);">                                    
                                    <label>Empregos Gerados Em Fevereiro:</label>
                                    <input type="text" value="{{ request('empregos_gerados_trimestre_fevereiro') }}" name="empregos_gerados_trimestre_fevereiro" class="form-control">
                                    <label>Empregos Gerados Em Março:</label>
                                    <input type="text" value="{{ request('empregos_gerados_trimestre_marco') }}" name="empregos_gerados_trimestre_marco" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quantidade De Empregos Diretos Gerados A Partir Da Adesão Ao PROEDI:</label>
                                    <input type="text" value="{{ request('empregos_gerados_proedi') }}" name="empregos_gerados_proedi" class="form-control">
                                    <label>% Matéria Prima Adquirida no RN (Atual):</label>
                                    <input type="text" value="{{ request('materia_prima_adquirida_rn') }}" name="materia_prima_adquirida_rn" class="form-control">                                       
                                   </div>
                                 <div class="form-group">                                                                         
                                 <label>ICMS Total Devido Em Janeiro:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_janeiro') }}" name="icms_total_devido_janeiro" class="form-control">                                    
                                 <label>ICMS Total Devido Em Fevereiro:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_fevereiro') }}" name="icms_total_devido_fevereiro" class="form-control">
                                 <label>ICMS Total Devido Em Março:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_marco') }}" name="icms_total_devido_marco" class="form-control">
                             </div>
                             <div class="form-group">                                                                          
                             <label>ICMS Total pago Em Janeiro:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_janeiro') }}" name="icms_total_pago_janeiro" class="form-control">                                    
                             <label>ICMS Total pago Em Fevereiro:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_fevereiro') }}" name="icms_total_pago_fevereiro" class="form-control">
                             <label>ICMS Total pago Em Março:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_marco') }}" name="icms_total_pago_marco" class="form-control">
                            </div>
                                   <div class="form-group">
                                    <label>Investimento Projetado (Próximo Ano) (R$):</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_projetado') }}" name="investimento_projetado" class="form-control">
                                    </div>
                                    <div class="form-group">                                                                                                   
                                     <label>Investimento Realizado Até Janeiro:</label> 
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_janeiro') }}" name="investimento_realizado_janeiro" class="form-control">                                    
                                     <label>Investimento Realizado Até Fevereiro:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_fevereiro') }}" name="investimento_realizado_fevereiro" class="form-control">
                                     <label>Investimento Realizado Até Março:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_marco') }}" name="investimento_realizado_marco" class="form-control">
                                     <label>Investimento Total Realizado A Partir Da Adesão Ao PROEDI:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_total_realizado') }}" name="investimento_total_realizado" class="form-control">
                                 </div>

                                 <div class="form-group">
                                    <label>Número De Empregos Diretos Atuais(Por Função):</label>
                                    <input type="text" value="{{ request('n_empregos_diretos_atuais') }}" name="n_empregos_diretos_atuais" class="form-control">
                                    </div>

                                   <div class="form-group">
                                    <label>Número De Menores Aprendizes:</label>
                                    <input type="text" value="{{ request('possui_menores_aprendizes') }}" name="possui_menores_aprendizes" class="form-control">
                                    <label>Número De Estagiários:</label>
                                    <input type="text" value="{{ request('possui_estagiarios') }}" name="possui_estagiarios" class="form-control">
                                    <label>Número De Trainees:</label>
                                    <input type="text" value="{{ request('possui_trainee') }}" name="possui_trainee" class="form-control"> 
                                   </div>

                                   <div class="form-group">
                                    <label>Digite O Destino da Mercadoria:</label>
                                    <input type="text" value="{{ request('destino_mercadoria') }}" name="destino_mercadoria" class="form-control">                    
                                    </div>
                                                          
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <input name="enviar" class="btn btn-primary" type="submit" value="Visualizar">                                        
                                      </div>
                                   
                                </form>                                
                        </table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="card-header">            
                    <h3>Filtros Para Geração de Relatórios do 2º Trimestre</h3>
                </div>
                <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <form action="{{ route('reports.proedi.second.trimestre') }}" class="form" method="GET">
                                    @csrf
                                   <div class="form-group">
                                       <label>Benefícios:</label>
                                       <input type="text"  name="outros_beneficios" class="form-control">
                                       <label>Tem Placa PROEDI?</label>
                                       <input type="text" value="{{ request('placa_proedi') }}" name="placa_proedi" class="form-control"> 
                                   </div>
                                   <div class="form-group">                                                                   
                                    <label>Faturamento Em Abril:</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" id="input" value="{{ request('faturamento_abril') }}" class="form-control" name="faturamento_abril" >                                    
                                    <label>Faturamento Em Maio:</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_maio') }}" class="form-control" name="faturamento_maio" >
                                    <label>Faturamento Em Junho:</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_junho') }}" class="form-control" name="faturamento_junho">
                                </div>    
                                   <div class="form-group">
                                       <script>
                                           function updateTextInput(val) {
                                                document.getElementById('textInput').value=val; 
                                                }
                                           </script>                                                                          
                                    <label>Empregos Gerados Em Abril:</label><input type="text" id="textInput" value="" style="border: none">
                                    <input type="text"  min="0" max="1000" value="{{ request('empregos_gerados_trimestre_abril') }}" name="empregos_gerados_trimestre_abril" class="form-control" onchange="updateTextInput(this.value);">                                    
                                    <label>Empregos Gerados Em Maio:</label>
                                    <input type="text" value="{{ request('empregos_gerados_trimestre_maio') }}" name="empregos_gerados_trimestre_maio" class="form-control">
                                    <label>Empregos Gerados Em Junho:</label>
                                    <input type="text" value="{{ request('empregos_gerados_trimestre_junho') }}" name="empregos_gerados_trimestre_junho" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quantidade De Empregos Diretos Gerados A Partir Da Adesão Ao PROEDI:</label>
                                    <input type="text" value="{{ request('empregos_gerados_proedi') }}" name="empregos_gerados_proedi" class="form-control">
                                    <label>% Matéria Prima Adquirida no RN (Atual):</label>
                                    <input type="text" value="{{ request('materia_prima_adquirida_rn') }}" name="materia_prima_adquirida_rn" class="form-control">                                       
                                   </div>
                                 <div class="form-group">                                                                         
                                 <label>ICMS Total Devido Em Abril:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_abril') }}" name="icms_total_devido_abril" class="form-control">                                    
                                 <label>ICMS Total Devido Em Maio:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_maio') }}" name="icms_total_devido_maio" class="form-control">
                                 <label>ICMS Total Devido Em Junho:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_junho') }}" name="icms_total_devido_junho" class="form-control">
                             </div>
                             <div class="form-group">                                                                          
                             <label>ICMS Total pago Em Abril:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_abril') }}" name="icms_total_pago_abril" class="form-control">                                    
                             <label>ICMS Total pago Em Maio:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_maio') }}" name="icms_total_pago_maio" class="form-control">
                             <label>ICMS Total pago Em Junho:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_junho') }}" name="icms_total_pago_junho" class="form-control">
                            </div>
                                   <div class="form-group">
                                    <label>Investimento Projetado (Próximo Ano) (R$):</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_projetado') }}" name="investimento_projetado" class="form-control">
                                    </div>
                                    <div class="form-group">                                                                                                   
                                     <label>Investimento Realizado Até Abril:</label> 
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_abril')}}" name="investimento_realizado_abril" class="form-control">                                    
                                     <label>Investimento Realizado Até Maio:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_maio') }}" name="investimento_realizado_maio" class="form-control">
                                     <label>Investimento Realizado Até Junho:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_junho') }}" name="investimento_realizado_junho" class="form-control">
                                     <label>Investimento Total Realizado A Partir Da Adesão Ao PROEDI:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_total_realizado') }}" name="investimento_total_realizado" class="form-control">
                                 </div>

                                 <div class="form-group">
                                    <label>Número De Empregos Diretos Atuais(Por Função):</label>
                                    <input type="text" value="{{ request('n_empregos_diretos_atuais') }}" name="n_empregos_diretos_atuais" class="form-control">
                                    </div>

                                   <div class="form-group">
                                    <label>Número De Menores Aprendizes:</label>
                                    <input type="text" value="{{ request('possui_menores_aprendizes') }}" name="possui_menores_aprendizes" class="form-control">
                                    <label>Número De Estagiários:</label>
                                    <input type="text" value="{{ request('possui_estagiarios') }}" name="possui_estagiarios" class="form-control">
                                    <label>Número De Trainees:</label>
                                    <input type="text" value="{{ request('possui_trainee') }}" name="possui_trainee" class="form-control"> 
                                   </div>

                                   <div class="form-group">
                                    <label>Digite O Destino da Mercadoria:</label>
                                    <input type="text" value="{{ request('destino_mercadoria') }}" name="destino_mercadoria" class="form-control">                    
                                    </div>
                                                          
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <input name="enviar" class="btn btn-primary" type="submit" value="Visualizar">                                        
                                      </div>
                                   
                                </form>                                
                        </table>
                </div>

            </div>

            <div class="tab-pane fade" id="pills-place" role="tabpanel" aria-labelledby="pills-place-tab">
                <div class="card-header">            
                    <h3>Filtros Para Geração de Relatórios do 3º Trimestre</h3>
                </div>
                <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <form action="{{ route('reports.proedi.third.trimestre') }}" class="form" method="GET">
                                    @csrf
                                   <div class="form-group">
                                       <label>Benefícios:</label>
                                       <input type="text"  name="outros_beneficios" class="form-control">
                                       <label>Tem Placa PROEDI?</label>
                                       <input type="text" value="{{ request('placa_proedi') }}" name="placa_proedi" class="form-control"> 
                                   </div>
                                   <div class="form-group">                                                                   
                                    <label>Faturamento Em Julho:</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_julho') }}" class="form-control" name="faturamento_julho" >                                    
                                    <label>Faturamento Em Agosto:</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_agosto') }}" class="form-control" name="faturamento_agosto" >
                                    <label>Faturamento Em Setembro:</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_setembro') }}" name="faturamento_setembro" class="form-control">
                                </div>     
                                   <div class="form-group">
                                       <script>
                                           function updateTextInput(val) {
                                                document.getElementById('textInput').value=val; 
                                                }
                                           </script>                                                                          
                                    <label>Empregos Gerados Em Julho:</label><input type="text" id="textInput" value="" style="border: none">
                                    <input type="text"  min="0" max="1000" value="{{ request('empregos_gerados_trimestre_julho') }}" name="empregos_gerados_trimestre_julho" class="form-control" onchange="updateTextInput(this.value);">                                    
                                    <label>Empregos Gerados Em Agosto:</label>
                                    <input type="text" value="{{ request('empregos_gerados_trimestre_agosto') }}" name="empregos_gerados_trimestre_agosto" class="form-control">
                                    <label>Empregos Gerados Em Setembro:</label>
                                    <input type="text" value="{{ request('empregos_gerados_trimestre_setembro') }}" name="empregos_gerados_trimestre_junho" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quantidade De Empregos Diretos Gerados A Partir Da Adesão Ao PROEDI:</label>
                                    <input type="text" value="{{ request('empregos_gerados_proedi') }}" name="empregos_gerados_proedi" class="form-control">
                                    <label>% Matéria Prima Adquirida no RN (Atual):</label>
                                    <input type="text" value="{{ request('materia_prima_adquirida_rn') }}" name="materia_prima_adquirida_rn" class="form-control">                                       
                                   </div>
                                 <div class="form-group">                                                                         
                                 <label>ICMS Total Devido Em Julho:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_julho') }}" name="icms_total_devido_julho" class="form-control">                                    
                                 <label>ICMS Total Devido Em Agosto:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_agosto') }}" name="icms_total_devido_agosto" class="form-control">
                                 <label>ICMS Total Devido Em Setembro:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_setembro') }}" name="icms_total_devido_setembro" class="form-control">
                             </div>
                             <div class="form-group">                                                                          
                             <label>ICMS Total pago Em Julho:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_julho') }}" name="icms_total_pago_julho" class="form-control">                                    
                             <label>ICMS Total pago Em Agosto:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_agosto') }}" name="icms_total_pago_agosto" class="form-control">
                             <label>ICMS Total pago Em Setembro:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_setembro') }}" name="icms_total_pago_setembro" class="form-control">
                            </div>
                                   <div class="form-group">
                                    <label>Investimento Projetado (Próximo Ano) (R$):</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_projetado') }}" name="investimento_projetado" class="form-control">
                                    </div>
                                    <div class="form-group">                                                                                                   
                                     <label>Investimento Realizado Até Julho:</label> 
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_julho') }}" name="investimento_realizado_julho" class="form-control">                                    
                                     <label>Investimento Realizado Até Agosto:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_agosto') }}" name="investimento_realizado_agosto" class="form-control">
                                     <label>Investimento Realizado Até Setembro:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_setembro') }}" name="investimento_realizado_setembro" class="form-control">
                                     <label>Investimento Total Realizado A Partir Da Adesão Ao PROEDI:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_total_realizado') }}" name="investimento_total_realizado" class="form-control">
                                 </div>

                                 <div class="form-group">
                                    <label>Número De Empregos Diretos Atuais(Por Função):</label>
                                    <input type="text" value="{{ request('n_empregos_diretos_atuais') }}" name="n_empregos_diretos_atuais" class="form-control">
                                    </div>

                                   <div class="form-group">
                                    <label>Número De Menores Aprendizes:</label>
                                    <input type="text" value="{{ request('possui_menores_aprendizes') }}" name="possui_menores_aprendizes" class="form-control">
                                    <label>Número De Estagiários:</label>
                                    <input type="text" value="{{ request('possui_estagiarios') }}" name="possui_estagiarios" class="form-control">
                                    <label>Número De Trainees:</label>
                                    <input type="text" value="{{ request('possui_trainee') }}" name="possui_trainee" class="form-control"> 
                                   </div>

                                   <div class="form-group">
                                    <label>Digite O Destino da Mercadoria:</label>
                                    <input type="text" value="{{ request('destino_mercadoria') }}" name="destino_mercadoria" class="form-control">                    
                                    </div>
                                                          
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <input name="enviar" class="btn btn-primary" type="submit" value="Visualizar">                                        
                                      </div>
                                   
                                </form>                                
                        </table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-fourth" role="tabpanel" aria-labelledby="pills-fourth-tab">
                <div class="card-header">            
                    <h3>Filtros Para Geração de Relatórios do 4º Trimestre</h3>
                </div>
                <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <form action="{{ route('reports.proedi.fourth.trimestre') }}" class="form" method="GET">
                                    @csrf
                                   <div class="form-group">
                                       <label>Benefícios:</label>
                                       <input type="text"  name="outros_beneficios" class="form-control">
                                       <label>Tem Placa PROEDI?</label>
                                       <input type="text" value="{{ request('placa_proedi') }}" name="placa_proedi" class="form-control"> 
                                   </div>
                                   <div class="form-group">                                                                   
                                    <label>Faturamento Em Outubro:</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_outubro') }}" class="form-control" name="faturamento_outubro" >                                    
                                    <label>Faturamento Em Novembro:</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_novembro') }}" class="form-control" name="faturamento_novembro" >
                                    <label>Faturamento Em Dezembro:</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('faturamento_dezembro') }}" name="faturamento_dezembro" class="form-control">
                                </div>     
                                   <div class="form-group">
                                       <script>
                                           function updateTextInput(val) {
                                                document.getElementById('textInput').value=val; 
                                                }
                                           </script>                                                                          
                                    <label>Empregos Gerados Em Outubro:</label><input type="text" id="textInput" value="" style="border: none">
                                    <input type="text"  min="0" max="1000" value="{{ request('empregos_gerados_trimestre_outubro') }}" name="empregos_gerados_trimestre_outubro" class="form-control" onchange="updateTextInput(this.value);">                                    
                                    <label>Empregos Gerados Em Novembro:</label>
                                    <input type="text" value="{{ request('empregos_gerados_trimestre_novembro') }}" name="empregos_gerados_trimestre_novembro" class="form-control">
                                    <label>Empregos Gerados Em Dezembro:</label>
                                    <input type="text" value="{{ request('empregos_gerados_trimestre_dezembro') }}" name="empregos_gerados_trimestre_dezembro" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quantidade De Empregos Diretos Gerados A Partir Da Adesão Ao PROEDI:</label>
                                    <input type="text" value="{{ request('empregos_gerados_proedi') }}" name="empregos_gerados_proedi" class="form-control">
                                    <label>% Matéria Prima Adquirida no RN (Atual):</label>
                                    <input type="text" value="{{ request('materia_prima_adquirida_rn') }}" name="materia_prima_adquirida_rn" class="form-control">                                       
                                   </div>
                                 <div class="form-group">                                                                         
                                 <label>ICMS Total Devido Em Outubro:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_outubro') }}" name="icms_total_devido_outubro" class="form-control">                                    
                                 <label>ICMS Total Devido Em Novembro:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_novembro') }}" name="icms_total_devido_novembro" class="form-control">
                                 <label>ICMS Total Devido Em Dezembro:</label>
                                 <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_devido_dezembro') }}" name="icms_total_devido_dezembro" class="form-control">
                             </div>
                             <div class="form-group">                                                                          
                             <label>ICMS Total pago Em Outubro:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_outubro') }}" name="icms_total_pago_outubro" class="form-control">                                    
                             <label>ICMS Total pago Em Novembro:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_novembro') }}" name="icms_total_pago_novembro" class="form-control">
                             <label>ICMS Total pago Em Dezembro:</label>
                             <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('icms_total_pago_dezembro') }}" name="icms_total_pago_dezembro" class="form-control">
                            </div>
                                   <div class="form-group">
                                    <label>Investimento Projetado (Próximo Ano) (R$):</label>
                                    <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_projetado') }}" name="investimento_projetado" class="form-control">
                                    </div>
                                    <div class="form-group">                                                                                                   
                                     <label>Investimento Realizado Até Outubro:</label> 
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_outubro') }}" name="investimento_realizado_outubro" class="form-control">                                    
                                     <label>Investimento Realizado Até Novembro:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_novembro') }}" name="investimento_realizado_novembro" class="form-control">
                                     <label>Investimento Realizado Até Dezembro:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_realizado_dezembro') }}" name="investimento_realizado_dezembro" class="form-control">
                                     <label>Investimento Total Realizado A Partir Da Adesão Ao PROEDI:</label>
                                     <input style="width: 100%; border-style: outset" type="text" class="money" value="{{ request('investimento_total_realizado') }}" name="investimento_total_realizado" class="form-control">
                                 </div>

                                 <div class="form-group">
                                    <label>Número De Empregos Diretos Atuais(Por Função):</label>
                                    <input type="text" value="{{ request('n_empregos_diretos_atuais') }}" name="n_empregos_diretos_atuais" class="form-control">
                                    </div>

                                   <div class="form-group">
                                    <label>Número De Menores Aprendizes:</label>
                                    <input type="text" value="{{ request('possui_menores_aprendizes') }}" name="possui_menores_aprendizes" class="form-control">
                                    <label>Número De Estagiários:</label>
                                    <input type="text" value="{{ request('possui_estagiarios') }}" name="possui_estagiarios" class="form-control">
                                    <label>Número De Trainees:</label>
                                    <input type="text" value="{{ request('possui_trainee') }}" name="possui_trainee" class="form-control"> 
                                   </div>

                                   <div class="form-group">
                                    <label>Digite O Destino da Mercadoria:</label>
                                    <input type="text" value="{{ request('destino_mercadoria') }}" name="destino_mercadoria" class="form-control">                    
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


