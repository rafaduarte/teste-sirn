@extends('adminlte::page')

@section('title', 'Proedi')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.index')}}">Principal</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('proedi.proedi')}}">RN Mais Gás</a></li>
    </ol>

    <h1> Cadastrar empresa no RN Mais Gás <a href="{{ route('rngas.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('proedi.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
                <table class="table table-condensed">
                    @if (count($rngas) > 0)
                    <thead>
                        <tr>
                            <th>Nome da Empresa</th>                          
                            <th>Área de Atuação</th>
                            <th>Produto</th>
                            <th>Tipo de Empresa</th>
                            <th>Município</th>
                            <th>Data de Início</th>
                            <th>Data Final</th>
                            <th width="270">Ações</th>
                        </tr>
                    </thead>
                    @endif
                    @if (count($rngas) < 1)
                    <thead>
                        <tr>
                            <th> 
                                <strong>Nenhuma empresa cadastrada
                    </thead>
                    @endif
                    <tbody>
                        @if (count($rngas) > 0)
                        @foreach ($rngas as $key)
                        <tr>
                            <td>{{$key->name}}</td>
                            <td>{{$key->area_atuacao}}</td>
                            <td>{{$key->produto}}</td>
                            <td>{{$key->tipo_empresa}}</td>
                            <td>{{$key->municipio}}</td>
                            <td>{{ date('d/m/Y', strtotime($key->data_inicio))}}</td>
                            <td>{{ date('d/m/Y', strtotime($key->data_final))}}</td>
                            <td  style="width=10px">
                                <form action="{{route('rngas.destroy', $key->id)}}" method="post">
                                 @csrf
                                 @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar RN Mais Gás</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif               
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
           
        </div>
    </div>
@stop