@extends('adminlte::page')

@section('title', "Empresa {$terceiro->razao_social}")

@section('content_header')
    <h1>Detalhes do Relatório do 3º Trimestre do PROEDI</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
              <li><strong>Benefícios?</strong> {{ $terceiro->outros_beneficios}}</li>
              <li><strong>Tem Placa PROEDI?</strong> {{ $terceiro->placa_proedi}}</li>
              @if (isset($terceiro->placa_proedi_upload))
              <li>
                <strong>Foto da Placa PROEDI</strong>
                <form action="{{ route('proedi.relatorio.third.file', $terceiro->placa_proedi_upload)}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                </form>              
              </li>
              @endif
                  <li><strong>Faturamento Em Julho:</strong>R$ {{ number_format($terceiro->faturamento_julho ,2) }}</li>
                  <li><strong>Faturamento Em Agosto:</strong>R$ {{ number_format($terceiro->faturamento_agosto ,2) }}</li>
                  <li><strong>Faturamento Em Setembro:</strong>R$ {{ number_format($terceiro->faturamento_setembro ,2) }}</li>
                  <li>
                    <strong>Comprovante De Faturamento Até 30/09</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->faturamento_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>                
                  <li><strong>Empregos Gerados Em Julho:</strong> {{ $terceiro->empregos_gerados_trimestre_julho}}</li>
                  <li><strong>Empregos Gerados Em Agosto:</strong> {{ $terceiro->empregos_gerados_trimestre_agosto}}</li>
                  <li><strong>Empregos Gerados Em Setembro:</strong> {{ $terceiro->empregos_gerados_trimestre_setembro}}</li>
                  <li>
                    <strong>Comprovante De Empregos Gerados Até 30/09</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->empregos_gerados_trimestre_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Empregos Diretos Gerados A Partir Da Adesão ao PROEDI:</strong> {{ $terceiro->empregos_gerados_proedi}}</li>
                  <li>
                    <strong>Comprovante De Empregos Diretos Gerados A Partir Da Adesão ao PROEDI</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->empregos_gerados_proedi_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Matéria Prima Adquirida No RN:</strong> {{ $terceiro->materia_prima_adquirida_rn}}</li>
                  <li>
                    <strong>Comprovante De Matéria Prima Adquirida No RN</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->materia_prima_adquirida_rn_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>ICMS Total Devido em Julho:</strong> R$ {{ number_format($terceiro->icms_total_devido_julho ,2) }}</li>
                  <li><strong>ICMS Total Devido em Agosto:</strong> R$ {{ number_format($terceiro->icms_total_devido_agosto ,2) }}</li>
                  <li><strong>ICMS Total Devido em Setembro:</strong> R$ {{ number_format($terceiro->icms_total_devido_setembro ,2) }}</li>
                  <li>
                    <strong>Comprovante Do ICMS Total Devido Até 30/09</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->icms_total_devido_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>ICMS Total Pago em Julho:</strong> R$ {{ number_format($terceiro->icms_total_pago_julho ,2) }}</li>
                  <li><strong>ICMS Total Pago em Agosto:</strong> R$ {{ number_format($terceiro->icms_total_pago_agosto ,2) }}</li>
                  <li><strong>ICMS Total Pago em Setembro:</strong> R$ {{ number_format($terceiro->icms_total_pago_setembro ,2) }}</li>
                  <li>
                    <strong>Comprovante Do ICMS Total Pago Até 30/09</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->icms_total_pago_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Investimento Projetado:</strong> R$ {{ number_format($terceiro->investimento_projetado, 2) }}</li>
                  <li>
                    <strong>Comprovante Do Investimento Projetado</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->investimento_projetado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Investimento Realizado em Julho:</strong> R$ {{ number_format($terceiro->investimento_realizado_julho ,2) }}</li>
                  <li><strong>Investimento Realizado em Agosto:</strong> R$ {{ number_format($terceiro->investimento_realizado_agosto ,2) }}</li>
                  <li><strong>Investimento Realizado em Setembro:</strong> R$ {{ number_format($terceiro->investimento_realizado_setembro ,2) }}</li>
                  <li>
                    <strong>Comprovante Do Investimento Realizado Até 30/09</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->investimento_realizado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Investimento Total Realizado A Partir Da Adesão Ao PROEDI:</strong> R$ {{ number_format($terceiro->investimento_total_realizado ,2) }}</li>
                  <li>
                    <strong>Comprovante Do Investimento Total Realizado A Partir Da Adesão Ao PROEDI</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->investimento_total_realizado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Número de Empregos Diretos Atuais (Por Função):</strong> {{ $terceiro->n_empregos_diretos_atuais}}</li>
                  <li>
                    <strong>Comprovante Do Número de Empregos Diretos Atuais (Por Função)</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->n_empregos_diretos_atuais_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Quantidade De Menores Aprendizes:</strong> {{ $terceiro->possui_menores_aprendizes}}</li>
                  @if (isset($terceiro->possui_menores_aprendizes_upload))
                  <li>
                    <strong>Comprovante Que Possui Menores Aprendizes</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->possui_menores_aprendizes_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  @endif
                  <li><strong>Quantidade De Estagiários:</strong> {{ $terceiro->possui_estagiarios}}</li>
                  @if (isset($terceiro->possui_estagiarios_upload))
                  <li>
                    <strong>Comprovante Que Possui Estagiários</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->possui_estagiarios_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  @endif                  
                  <li><strong>Quantidade De Trainees:</strong> {{ $terceiro->possui_trainee}}</li>
                  @if (isset( $terceiro->possui_trainee_upload))
                  <li>
                    <strong>Comprovante Que Possui Trainee</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->possui_trainee_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li> 
                  @endif                  
                  <li><strong>Destino da Mercadoria:</strong> {{ $terceiro->destino_mercadoria}}</li>
                  <li>
                    <strong>Comprovante Do Destino da Mercadoria</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $terceiro->destino_mercadoria_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
            </ul>    
        </div>
    </div>
        @endsection