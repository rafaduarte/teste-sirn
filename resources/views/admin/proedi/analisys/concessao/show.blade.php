@extends('adminlte::page')

@section('title', "Pedido de Concessão do PROEDI {$pedido->nome_empresa}")

@section('content_header')
    <h1>Detalhes do Pedido de Concessão da Empresa <b>{{ $pedido->nome_empresa }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Requerimento</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->requerimento)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info"  style="width:500px">Visualizar Requerimento </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Projeto</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->projeto)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Projeto </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Inscrição Estadual</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->inscricao_estadual)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Inscrição Estadual </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Certidão Federal</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_federal)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Federal </button>
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
                    <strong>Certidão Municipal</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_municipal)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Municipal </button>
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
                    <strong>Ata de Constituição</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->ata_constituicao)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Ata de Constituição </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Procuração do Responsável</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->procuracao_responsavel)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Procuração do Responsável</button>
                    </form>              
                  </li>
                  <li>
                    <strong>RG do Responsável</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->rg_responsavel)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar RG do Responsável</button>
                    </form>              
                  </li>
                  <li>
                    <strong>Comprovante de Residência do Responsável</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->comprovante_residencia)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Comprovante de Residência do Responsável</button>
                    </form>              
                  </li>
                  <li>
                    <strong>Relatório GFIP</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->relatorio_gfip)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Relatório GFIP</button>
                    </form>              
                  </li>
                  <li>
                    <strong>Relatório do Faturamento</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->relatorio_faturamento)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Relatório do Faturamento</button>
                    </form>              
                  </li>
                  @isset($pedido->documentos)
                  <li>
                    <strong>Demais Documentos</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->documentos)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Demais Documentos</button>
                    </form> 
                  </li>
                  @endisset             
            </ul>
            <br>
            <form action="{{ route('concessao.proedi.destroy', $pedido->id)}}" method="POST">
                
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o pedido </button>
            </form>
        </div>
    </div>
        @endsection