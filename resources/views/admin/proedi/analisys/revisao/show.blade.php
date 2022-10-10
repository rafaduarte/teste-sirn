@extends('adminlte::page')

@section('title', "Pedido de Revisão do PROEDI {$pedido->nome_empresa}")

@section('content_header')
    <h1>Detalhes do Pedido de Revisão da Empresa <b>{{ $pedido->nome_empresa }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Requerimento</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->requerimento)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Requerimento </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Certidão Estadual</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_estadual)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Estadual </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Certidão Trabalhista</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_trabalhista)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Trabalhista </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Certidão FGTS</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_fgts)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão FGTS </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Carta de motivos</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->carta_motivos)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Carta de motivos </button>
                    </form>              
                  </li>
                  @isset($pedido->mudanca_local)
                  <li>
                    <strong>Mudança de Local</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->mudanca_local)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Mudança de Local </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->faturamento)
                  <li>
                    <strong>Aumento de Faturamento</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->faturamento)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Aumento de Faturamento </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->empregados)
                  <li>
                    <strong>Aumento de Empregados</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->empregados)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Aumento de Empregados </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->materia_prima)
                  <li>
                    <strong>Compra de Matéria Prima</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->materia_prima)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Compra de Matéria Prima </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->investimento_ped)
                  <li>
                    <strong>Investimento em Pesquisa e Desenvolvimento</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->investimento_ped)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Investimento em Pesquisa e Desenvolvimento </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->investimento_conservacao)
                  <li>
                    <strong>Investimento em Conservação Ambiental</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->investimento_conservacao)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Investimento em Conservação Ambiental </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->investimento_mao_obra)
                  <li>
                    <strong>Investimento em Capacitação em Mão de Obra Local</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->investimento_mao_obra)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Investimento em Capacitação em Mão de Obra Local </button>
                    </form>              
                  </li>
                  @endisset
                  
                  @isset($pedido->documentos)
                  <li>
                    <strong>Demais Documentos</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->documentos)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Demais Documentos</button>
                    </form> 
                  </li>
                  @endisset             
            </ul> <br>
            <form action="{{ route('revisao.proedi.destroy', $pedido->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o pedido </button>
            </form>
        </div>
    </div>
        @endsection