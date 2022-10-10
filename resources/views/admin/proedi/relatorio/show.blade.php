@extends('adminlte::page')

@section('title', "Empresa {$relatorio->razao_social}")

@section('content_header')
    <h1>Detalhes do Relatório <b>{{ $relatorio->razao_social }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Foto da Placa PROEDI</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->placa_proedi_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante De Empregos Gerados Até 31/03</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->empregos_gerados_trimestre_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante De Empregos A Partir Da Adesão ao PROEDI</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->empregos_gerados_proedi_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante De Matéria Prima Adquirida No RN</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->materia_prima_adquirida_rn_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Do ICMS Total Devido Até 31/03</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->icms_total_devido_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Do ICMS Total Pago Até 31/03</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->icms_total_pago_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Do Investimento Projetado</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->investimento_projetado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Do Investimento Realizado Até 31/03</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->investimento_realizado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Do Investimento Total Realizado A Partir Da Adesão Ao PROEDI</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->investimento_total_realizado_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Do Número de Empregos Diretos Atuais (Por Função)</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->n_empregos_diretos_atuais_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Que Possui Menores Aprendizes</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->possui_menores_aprendizes_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Que Possui Estagiários</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->possui_estagiarios_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Que Possui Trainee</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->possui_trainee_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante Do Destino da Mercadoria</strong>
                    <form action="{{ route('proedi.relatorio.file', $relatorio->destino_mercadoria_upload)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info">Visualizar </button>
                    </form>              
                  </li>
                  <br>
            <form action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o relatório</button>
            </form>
        </div>
    </div>
        @endsection