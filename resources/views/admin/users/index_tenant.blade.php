@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('users.index')}}">Dashboard de Usuários</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="" method="POST" class="form form-inline">
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
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            @if ($user->editar == false)
                            <form action="{{ route('user.permitir.editar', $user->id) }}" method="POST" class="form form-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" formmethod="post" class="btn btn-success">Permitir Edição</button>                                
                            </form>
                            @else
                            <form action="{{ route('user.retirar.editar', $user->id) }}" method="POST" class="form form-inline">
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
           
        </div>
    </div>
@stop