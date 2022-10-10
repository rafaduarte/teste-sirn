@extends('adminlte::page')

@section('title', 'Proedi')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.sei.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('proedi.sei.index')}}">SEI PROEDI</a></li>
    </ol>

    <h1><strong>Processos do SEI</strong> <a href="{{ route('proedi.sei.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i>  ADD </a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('proedi.sei.search') }}" method="POST" class="form form-inline">
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
                            <th>Nome da Empresa</th>
                            <th>Número do Protocolo</th>
                            <th>Link de Acesso</th>
                            <th width="270">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sei as $key)
                    <tr>
                        <td>{{$key->name}}</td>
                        <td>{{$key->numero}}</td>
                        <td><a  class="btn btn-warning" href="{{$key->link}}">Visualizar</a></td>
                            <td style="width=10px">
                                <form action="{{ route('proedi.sei.destroy', $key->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Deletar</button>
                               </form>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $sei->appends($filters)->links() !!}   
            @else
               {!!$sei->links() !!}
            @endif
        </div>
    </div>
@stop