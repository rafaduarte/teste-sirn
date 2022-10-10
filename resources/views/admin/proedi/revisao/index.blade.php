@extends('adminlte::page')

@section('title', 'Revisão do PROEDI')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.empresa.index')}}">Menu</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('proedi.revisao.index')}}">PROEDI</a></li>
    </ol>

    <h1>Pedir Revisão do PROEDI <a href="{{ route('proedi.revisao.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('proedi.revisao.search') }}" method="POST" class="form form-inline">
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
                            <th>Data do Pedido</th>
                            <th>Seu CNPJ</th>
                            <th>Razão Social</th>
                            <th>Solicitado Por</th>
                             <th width="270">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($pedido->created_at))}}</td>
                        <td>{{$pedido->formatCnpj($pedido->cnpj)}}</td>
                        <td>{{$pedido->social_name}}</td>
                        <td>{{$pedido->name}}</td>
                        <td  style="width=10px">
                            <a href="{{ route('revisao.proedi.show', $pedido->id)}}" class="btn btn-warning">Ver</a>                            
                            @if ($pedido->editar == true)
                            <a href="{{ route('revisao.proedi.edit', $pedido->id)}}" class="btn btn-primary">Editar</a>                            
                            @endif
                            @if ($pedido->pedir_editar == true && $pedido->editar == false)
                           <h6><strong>Permissão para editar enviada</strong></h6>
                            @endif
                            @if ($pedido->pedir_editar == false && $pedido->editar == false )
                            <a href="{{ route('proedi.revisao.pedir.edicao', $pedido->id)}}"  class="btn btn-primary">Autorização para editar</a>
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