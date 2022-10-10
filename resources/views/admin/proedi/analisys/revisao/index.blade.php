@extends('adminlte::page')

@section('title', 'Revisão do PROEDI')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.index')}}">Menu</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('revisao.proedi.index')}}">Pedidos de Revisão PROEDI</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('revisao.proedi.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Filtrar por nome ou CNPJ" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>Solicitado Por</th>
                            <th>CNPJ</th>
                            <th>Data do Pedido</th>
                             <th width="270">Ações</th>
                             <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{$pedido->social_name}}</td>
                        <td>{{$pedido->name}}</td>
                        <td>{{$pedido->formatCnpj($pedido->cnpj)}}</td>
                        <td>{{ date('d/m/Y', strtotime($pedido->created_at))}}</td>
                        <td>
                            <a href="{{ route('proedi.revisao.show', $pedido->id)}}" class="btn btn-warning">Visualizar</a>
                        </td>
                        <td>
                            @if ($pedido->editar == false)
                            <form action="{{ route('revisao.proedi.permitir.editar', $pedido->id) }}" method="POST" class="form form-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" formmethod="post" class="btn btn-success">Permitir Edição</button>                                
                            </form>
                            @else
                            <form action="{{ route('revisao.proedi.retirar.editar', $pedido->id) }}" method="POST" class="form form-inline">
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