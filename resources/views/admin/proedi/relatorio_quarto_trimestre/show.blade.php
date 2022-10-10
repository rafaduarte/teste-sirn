@extends('adminlte::page')

@section('title', "Empresa {$quarto->razao_social}")

@section('content_header')
    <h1>Detalhes do Relatório do 4º Trimestre do PROEDI</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
              <li><strong>Benefícios?</strong> {{ $quarto->outros_beneficios}}</li>
              <li><strong>Tem Placa PROEDI?</strong> {{ $quarto->placa_proedi}}</li>
              @if (isset($quarto->placa_proedi_upload))
              <li>
                <strong>Foto da Placa PROEDI</strong>
                <form action="{{ route('proedi.relatorio.third.file', $quarto->placa_proedi_upload)}}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                </form>              
              </li>
              @endif
                  <li><strong>Faturamento Em Outubro:</strong> R$ {{ number_format($quarto->faturamento_outubro ,2 ) }}</li>
                  <li><strong>Faturamento Em Novembro:</strong> R$ {{ number_format($quarto->faturamento_novembro ,2) }}</li>
                  <li><strong>Faturamento Em Dezembro:</strong> R$ {{ number_format($quarto->faturamento_dezembro ,2) }}</li>
                  <li>
                    <strong>Comprovante De Faturamento Até 31/12</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->faturamento_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>                
                  <li><strong>Empregos Gerados Em Outubro:</strong> {{ $quarto->empregos_gerados_trimestre_outubro}}</li>
                  <li><strong>Empregos Gerados Em Novembro:</strong> {{ $quarto->empregos_gerados_trimestre_novembro}}</li>
                  <li><strong>Empregos Gerados Em Dezembro:</strong> {{ $quarto->empregos_gerados_trimestre_dezembro}}</li>
                  <li>
                    <strong>Comprovante De Empregos Gerados Até 31/12</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->empregos_gerados_trimestre_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Empregos Diretos Gerados A Partir Da Adesão ao PROEDI:</strong> {{ $quarto->empregos_gerados_proedi}}</li>
                  <li>
                    <strong>Comprovante De Empregos Diretos Gerados A Partir Da Adesão ao PROEDI</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->empregos_gerados_proedi_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Matéria Prima Adquirida No RN:</strong> {{ $quarto->materia_prima_adquirida_rn}}</li>
                  <li>
                    <strong>Comprovante De Matéria Prima Adquirida No RN</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->materia_prima_adquirida_rn_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>ICMS Total Devido em Outubro:</strong> R$ {{ number_format($quarto->icms_total_devido_outubro ,2) }}</li>
                  <li><strong>ICMS Total Devido em Novembro:</strong> R$ {{ number_format($quarto->icms_total_devido_novembro ,2) }}</li>
                  <li><strong>ICMS Total Devido em Dezembro:</strong> R$ {{ number_format($quarto->icms_total_devido_dezembro ,2) }}</li>
                  <li>
                    <strong>Comprovante Do ICMS Total Devido Até 31/12</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->icms_total_devido_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>ICMS Total Pago em Outubro:</strong> R$ {{ number_format($quarto->icms_total_pago_outubro ,2) }}</li>
                  <li><strong>ICMS Total Pago em Novembro:</strong> R$ {{ number_format($quarto->icms_total_pago_novembro ,2) }}</li>
                  <li><strong>ICMS Total Pago em Dezembro:</strong> R$ {{ number_format($quarto->icms_total_pago_dezembro ,2) }}</li>
                  <li>
                    <strong>Comprovante Do ICMS Total Pago Até 31/12</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->icms_total_pago_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Investimento Projetado:</strong> R$ {{ number_format($quarto->investimento_projetado ,2) }}</li>
                  <li>
                    <strong>Comprovante Do Investimento Projetado</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->investimento_projetado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Investimento Realizado em Outubro:</strong> R$ {{ number_format( $quarto->investimento_realizado_outubro ,2)}}</li>
                  <li><strong>Investimento Realizado em Novembro:</strong> R$ {{ number_format($quarto->investimento_realizado_novembro ,2) }}</li>
                  <li><strong>Investimento Realizado em Dezembro:</strong> R$ {{ number_format($quarto->investimento_realizado_dezembro ,2) }}</li>
                  <li>
                    <strong>Comprovante Do Investimento Realizado Até 31/12</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->investimento_realizado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Investimento Total Realizado A Partir Da Adesão Ao PROEDI:</strong> R$ {{ number_format($quarto->investimento_total_realizado ,2) }}</li>
                  <li>
                    <strong>Comprovante Do Investimento Total Realizado A Partir Da Adesão Ao PROEDI</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->investimento_total_realizado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Número de Empregos Diretos Atuais (Por Função):</strong> {{ $quarto->n_empregos_diretos_atuais}}</li>
                  <li>
                    <strong>Comprovante Do Número de Empregos Diretos Atuais (Por Função)</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->n_empregos_diretos_atuais_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  <li><strong>Quantidade De Menores Aprendizes:</strong> {{ $quarto->possui_menores_aprendizes}}</li>
                  @if (isset($quarto->possui_menores_aprendizes_upload))
                  <li>
                    <strong>Comprovante Que Possui Menores Aprendizes</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->possui_menores_aprendizes_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  @endif
                  <li><strong>Quantidade De Estagiários:</strong> {{ $quarto->possui_estagiarios}}</li>
                  @if (isset($quarto->possui_estagiarios_upload))
                  <li>
                    <strong>Comprovante Que Possui Estagiários</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->possui_estagiarios_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
                  @endif                  
                  <li><strong>Quantidade De Trainees:</strong> {{ $quarto->possui_trainee}}</li>
                  @if (isset( $quarto->possui_trainee_upload))
                  <li>
                    <strong>Comprovante Que Possui Trainee</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->possui_trainee_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li> 
                  @endif                  
                  <li><strong>Destino da Mercadoria:</strong> {{ $quarto->destino_mercadoria}}</li>
                  <li>
                    <strong>Comprovante Do Destino da Mercadoria</strong>
                    <form action="{{ route('proedi.relatorio.third.file', $quarto->destino_mercadoria_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                    </form>              
                  </li>
            </ul>    
        </div>
    </div>
        @endsection