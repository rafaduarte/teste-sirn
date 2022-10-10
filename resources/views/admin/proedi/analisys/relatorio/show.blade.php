@extends('adminlte::page')

@section('title', "Empresa {$relatorio->razao_social}")

@section('content_header')
    <h1>Detalhes do Relatório <b>{{ $relatorio->razao_social }}</b></h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
          <ul>
            <li><strong>Benefícios?</strong> {{ $relatorio->outros_beneficios}}</li>
            <li><strong>Tem Placa PROEDI?</strong> {{ $relatorio->placa_proedi}}</li>
            @if (isset($relatorio->placa_proedi_upload))
            <li>
              <strong>Foto da Placa PROEDI</strong>
              <form action="{{ route('proedi.relatorio.file', $relatorio->placa_proedi_upload)}}" method="get">
                  @csrf
                  <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
              </form>              
            </li>
            @endif
            <li><strong>Faturamento Em Janeiro:</strong>R$ {{ number_format($relatorio->faturamento_janeiro, 2) }}</li>
            <li><strong>Faturamento Em Fevereiro:</strong>R$ {{ number_format($relatorio->faturamento_fevereiro, 2) }}</li>
            <li><strong>Faturamento Em Março:</strong>R$ {{ number_format($relatorio->faturamento_marco, 2) }}</li>
            <li>
              <strong>Comprovante De Faturamento Até 31/03</strong>
              <form action="{{ route('proedi.relatorio.file', $relatorio->faturamento_upload)}}" method="get">
                  @csrf
                  <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
              </form>              
            </li>                
                <li><strong>Empregos Gerados Em Janeiro:</strong> {{ $relatorio->empregos_gerados_trimestre_janeiro}}</li>
                <li><strong>Empregos Gerados Em Fevereiro:</strong> {{ $relatorio->empregos_gerados_trimestre_fevereiro}}</li>
                <li><strong>Empregos Gerados Em Março:</strong> {{ $relatorio->empregos_gerados_trimestre_marco}}</li>
                <li>
                  <strong>Comprovante De Empregos Gerados Até 31/03</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->empregos_gerados_trimestre_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                <li><strong>Empregos Diretos Gerados A Partir Da Adesão ao PROEDI:</strong> {{ $relatorio->empregos_gerados_proedi}}</li>
                <li>
                  <strong>Comprovante De Empregos Diretos Gerados A Partir Da Adesão ao PROEDI</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->empregos_gerados_proedi_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                <li><strong>Matéria Prima Adquirida No RN:</strong> {{ $relatorio->materia_prima_adquirida_rn}}</li>
                <li>
                  <strong>Comprovante De Matéria Prima Adquirida No RN</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->materia_prima_adquirida_rn_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                <li><strong>ICMS Total Devido em Janeiro:</strong> {{ $relatorio->icms_total_devido_janeiro}}</li>
                <li><strong>ICMS Total Devido em Fevereiro:</strong> {{ $relatorio->icms_total_devido_fevereiro}}</li>
                <li><strong>ICMS Total Devido em Março:</strong> {{ $relatorio->icms_total_devido_marco}}</li>
                <li>
                  <strong>Comprovante Do ICMS Total Devido Até 31/03</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->icms_total_devido_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                <li><strong>ICMS Total Pago em Janeiro:</strong> {{ $relatorio->icms_total_pago_janeiro}}</li>
                <li><strong>ICMS Total Pago em Fevereiro:</strong> {{ $relatorio->icms_total_pago_fevereiro}}</li>
                <li><strong>ICMS Total Pago em Março:</strong> {{ $relatorio->icms_total_pago_marco}}</li>
                <li>
                  <strong>Comprovante Do ICMS Total Pago Até 31/03</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->icms_total_pago_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                <li><strong>Investimento Projetado:</strong> {{ $relatorio->investimento_projetado}}</li>
                <li>
                  <strong>Comprovante Do Investimento Projetado</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->investimento_projetado_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                <li><strong>Investimento Realizado em Janeiro:</strong> {{ $relatorio->investimento_realizado_janeiro}}</li>
                <li><strong>Investimento Realizado em Fevereiro:</strong> {{ $relatorio->investimento_realizado_fevereiro}}</li>
                <li><strong>Investimento Realizado em Março:</strong> {{ $relatorio->investimento_realizado_marco}}</li>
                <li>
                  <strong>Comprovante Do Investimento Realizado Até 31/03</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->investimento_realizado_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                <li><strong>Investimento Total Realizado A Partir Da Adesão Ao PROEDI:</strong> {{ $relatorio->investimento_total_realizado}}</li>
                <li>
                  <strong>Comprovante Do Investimento Total Realizado A Partir Da Adesão Ao PROEDI</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->investimento_total_realizado_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                <li><strong>Número de Empregos Diretos Atuais (Por Função):</strong> {{ $relatorio->n_empregos_diretos_atuais}}</li>
                <li>
                  <strong>Comprovante Do Número de Empregos Diretos Atuais (Por Função)</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->n_empregos_diretos_atuais_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                <li><strong>Quantidade De Menores Aprendizes:</strong> {{ $relatorio->possui_menores_aprendizes}}</li>
                @if (isset($relatorio->possui_menores_aprendizes_upload))
                <li>
                  <strong>Comprovante Que Possui Menores Aprendizes</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->possui_menores_aprendizes_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                @endif
                <li><strong>Quantidade De Estagiários:</strong> {{ $relatorio->possui_estagiarios}}</li>
                @if (isset($relatorio->possui_estagiarios_upload))
                <li>
                  <strong>Comprovante Que Possui Estagiários</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->possui_estagiarios_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
                @endif                  
                <li><strong>Quantidade De Trainees:</strong> {{ $relatorio->possui_trainee}}</li>
                @if (isset( $relatorio->possui_trainee_upload))
                <li>
                  <strong>Comprovante Que Possui Trainee</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->possui_trainee_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li> 
                @endif                  
                <li><strong>Destino da Mercadoria:</strong> {{ $relatorio->destino_mercadoria}}</li>
                <li>
                  <strong>Comprovante Do Destino da Mercadoria</strong>
                  <form action="{{ route('proedi.relatorio.file', $relatorio->destino_mercadoria_upload)}}" method="get">
                      @csrf
                      <button type="submit" class="btn btn-info" style="width:500px">Visualizar </button>
                  </form>              
                </li>
          </ul>
                  <br>
            <form action="{{ route('relatorio.proedi.destroy', $relatorio->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o relatório</button>
            </form>
        </div>
    </div>
        @endsection