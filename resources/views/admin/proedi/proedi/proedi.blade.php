@extends('adminlte::page')

@section('title', 'Proedi')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.index')}}">Principal</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('proedi.proedi')}}">PROEDI</a></li>
    </ol>

    <h1> Cadastrar empresa no PROEDI <a href="{{ route('proedi.create.proedi')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
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
                    @if (count($proedis) > 0)
                    <thead>
                        <tr>
                            <th>Nome da Empresa</th>
                            <th> 
                                <strong>Desconto do ICMS:</strong>
                            </th>
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
                    @if (count($proedis) < 1)
                    <thead>
                        <tr>
                            <th> 
                                <strong>Nenhuma empresa cadastrada
                    </thead>
                    @endif
                    <tbody>
                        @if (count($proedis) > 0)
                        @foreach ($proedis as $proedi)
                        <tr>
                            <td>{{$proedi->name}}</td>
                            <td>{{$proedi->desconto}}</td>
                            <td>{{$proedi->area_atuacao}}</td>
                            <td>{{$proedi->produto}}</td>
                            <td>{{$proedi->tipo_empresa}}</td>
                            <td>{{$proedi->municipio}}</td>
                            <td>{{ date('d/m/Y', strtotime($proedi->data_inicio))}}</td>
                            <td>{{ date('d/m/Y', strtotime($proedi->data_final))}}</td>
                            <td  style="width=10px">
                                <form action="{{route('proedi.destroy.proedi', $proedi->id)}}" method="post">
                                 @csrf
                                 @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar PROEDI</button>
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