@extends('adminlte::page')

@section('title', 'RN Mais Gás')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.empresa.index')}}">Menu</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('proedi.concessao.index')}}">RN Mais Gás</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('proedi.concessao.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Data do pedido</th>
                            <th>CNPJ</th>
                            <th>Empresa</th>
                            <th>Solicitado Por</th>
                            <th>Ações</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($pedido->created_at))}}</td>
                        <td>{{$pedido->formatCnpj($pedido->cnpj)}}</td>
                        <td>{{$pedido->social_name}}</td>
                        <td>{{$pedido->nome_empresa}}</td>
                        <td>
                            <a href="{{ route('concessao.proedi.show', $pedido->id)}}" class="btn btn-warning">Visualizar</a></td>                        
                        <td>
                            @if ($pedido->editar == false)
                            <form action="{{ route('concessao.rngas.permitir.editar', $pedido->id) }}" method="POST" class="form form-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" formmethod="post" class="btn btn-success">Permitir Edição</button>                                
                            </form>
                            @else
                            <form action="{{ route('concessao.rngas.retirar.editar', $pedido->id) }}" method="POST" class="form form-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" formmethod="post" class="btn btn-danger">Retirar Edição</button>                                
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $pedidos->appends($filters)->links() !!}   
            @else
               {!!$pedidos->links() !!}
            @endif
        </div>
    </div>
@stop