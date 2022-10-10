@extends('adminlte::page')

@section('title', "Empresa {$segundo->razao_social}")

@section('content_header')
    <h1>Detalhes do Relatório do 2º Trimestre do PROEDI</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
              <li><strong>Benefícios?</strong> {{ $segundo->outros_beneficios}}</li>
              <li><strong>Tem Placa PROEDI?</strong> {{ $segundo->placa_proedi}}</li>
              @if (isset($segundo->placa_proedi_upload))
              <li>
                <strong>Foto da Placa PROEDI</strong>
                <form action="{{ route('proedi.relatorio.second.file', $segundo->placa_proedi_upload)}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                </form>              
              </li>
              @endif
                  <li><strong>Faturamento Em Abril:</strong> R$ {{ number_format($segundo->faturamento_abril ,2) }}</li>
                  <li><strong>Faturamento Em Maio:</strong> R$ {{ number_format($segundo->faturamento_maio ,2) }}</li>
                  <li><strong>Faturamento Em Junho:</strong> R$ {{ number_format($segundo->faturamento_junho ,2) }}</li>
                  <li>
                    <strong>Comprovante De Faturamento Até 30/06</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->faturamento_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>                
                  <li><strong>Empregos Gerados Em Abril:</strong> {{ $segundo->empregos_gerados_trimestre_abril}}</li>
                  <li><strong>Empregos Gerados Em Maio:</strong> {{ $segundo->empregos_gerados_trimestre_maio}}</li>
                  <li><strong>Empregos Gerados Em Junho:</strong> {{ $segundo->empregos_gerados_trimestre_junho}}</li>
                  <li>
                    <strong>Comprovante De Empregos Gerados Até 30/06</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->empregos_gerados_trimestre_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Empregos Diretos Gerados A Partir Da Adesão ao PROEDI:</strong> {{ $segundo->empregos_gerados_proedi}}</li>
                  <li>
                    <strong>Comprovante De Empregos Diretos Gerados A Partir Da Adesão ao PROEDI</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->empregos_gerados_proedi_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Matéria Prima Adquirida No RN:</strong> {{ $segundo->materia_prima_adquirida_rn}}</li>
                  <li>
                    <strong>Comprovante De Matéria Prima Adquirida No RN</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->materia_prima_adquirida_rn_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>ICMS Total Devido em Abril:</strong> R$ {{ number_format($segundo->icms_total_devido_abril ,2) }}</li>
                  <li><strong>ICMS Total Devido em Maio:</strong> R$ {{ number_format($segundo->icms_total_devido_maio ,2) }}</li>
                  <li><strong>ICMS Total Devido em Junho:</strong> R$ {{ number_format($segundo->icms_total_devido_junho ,2) }}</li>
                  <li>
                    <strong>Comprovante Do ICMS Total Devido Até 30/06</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->icms_total_devido_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>ICMS Total Pago em Abril:</strong> R$ {{ number_format($segundo->icms_total_pago_abril ,2) }}</li>
                  <li><strong>ICMS Total Pago em Maio:</strong> R$ {{ number_format($segundo->icms_total_pago_maio ,2) }}</li>
                  <li><strong>ICMS Total Pago em Junho:</strong> R$ {{ number_format($segundo->icms_total_pago_junho ,2) }}</li>
                  <li>
                    <strong>Comprovante Do ICMS Total Pago Até 30/06</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->icms_total_pago_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Investimento Projetado:</strong> R$ {{ number_format($segundo->investimento_projetado ,2) }}</li>
                  <li>
                    <strong>Comprovante Do Investimento Projetado</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->investimento_projetado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Investimento Realizado em Abril:</strong> R$ {{ number_format($segundo->investimento_realizado_abril ,2) }}</li>
                  <li><strong>Investimento Realizado em Maio:</strong> R$ {{ number_format($segundo->investimento_realizado_maio ,2) }}</li>
                  <li><strong>Investimento Realizado em Junho:</strong> R$ {{ number_format($segundo->investimento_realizado_junho ,2) }}</li>
                  <li>
                    <strong>Comprovante Do Investimento Realizado Até 30/06</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->investimento_realizado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Investimento Total Realizado A Partir Da Adesão Ao PROEDI:</strong> R$ {{ number_format($segundo->investimento_total_realizado ,2) }}</li>
                  <li>
                    <strong>Comprovante Do Investimento Total Realizado A Partir Da Adesão Ao PROEDI</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->investimento_total_realizado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Número de Empregos Diretos Atuais (Por Função):</strong> {{ $segundo->n_empregos_diretos_atuais}}</li>
                  <li>
                    <strong>Comprovante Do Número de Empregos Diretos Atuais (Por Função)</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->n_empregos_diretos_atuais_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Quantidade De Menores Aprendizes:</strong> {{ $segundo->possui_menores_aprendizes}}</li>
                  @if (isset($segundo->possui_menores_aprendizes_upload))
                  <li>
                    <strong>Comprovante Que Possui Menores Aprendizes</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->possui_menores_aprendizes_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  @endif
                  <li><strong>Quantidade De Estagiários:</strong> {{ $segundo->possui_estagiarios}}</li>
                  @if (isset($segundo->possui_estagiarios_upload))
                  <li>
                    <strong>Comprovante Que Possui Estagiários</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->possui_estagiarios_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  @endif                  
                  <li><strong>Quantidade De Trainees:</strong> {{ $segundo->possui_trainee}}</li>
                  @if (isset( $segundo->possui_trainee_upload))
                  <li>
                    <strong>Comprovante Que Possui Trainee</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->possui_trainee_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li> 
                  @endif                  
                  <li><strong>Destino da Mercadoria:</strong> {{ $segundo->destino_mercadoria}}</li>
                  <li>
                    <strong>Comprovante Do Destino da Mercadoria</strong>
                    <form action="{{ route('proedi.relatorio.second.file', $segundo->destino_mercadoria_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
            </ul>    
        </div>
    </div>
        @endsection