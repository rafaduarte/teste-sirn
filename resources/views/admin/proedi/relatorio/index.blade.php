@extends('adminlte::page')

@section('title', 'Relatórios do PROEDI')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.relatorio.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('proedi.revisao.index')}}">PROEDI</a></li>
    </ol>

    <h1>Relatórios Enviados do PROEDI <a href="{{ route('proedi.relatorio.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('proedi.relatorio.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Data do Relatório</th>
                            <th>CNPJ</th>
                            <th width="270">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($relatorios as $relatorio)
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($relatório->created_at))}}</td>
                            <td>{{$relatorio->cnpj}}</td>
                            <td  style="width=10px">
                                <a href="{{ route('proedi.relatorio.show', $relatorio->id)}}" class="btn btn-warning">Visualizar</a>
                            </td>
                        </tr>
                @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $relatorios->appends($filters)->links() !!}   
            @else
               {!!$relatorios->links() !!}
            @endif
        </div>
    </div>
@stop