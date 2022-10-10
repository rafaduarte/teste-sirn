@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('users.index')}}">Dashboard de Usuários</a></li>
    </ol>

    <h1>Usuários <a href="{{ route('users.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @if (Auth::user()->tenant_id == 1)
            <a href="{{ route('user.index.tenants')}}" class="btn btn-info">Visualizar Empresas</a> <hr>
            @endif            
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
                        @if (Auth::user()->isAdmin())
                        <td style="width=10px">
                        <a href="{{ route('users.edit', $user->id)}}" class="btn btn-info">Editar</a> 
                        </td>                 
                        @endif                                              
                       @if (Auth::user()->tenant_id == 1)
                       <td  style="width=10px">
                        <a href="{{ route('users.show', $user->id)}}" class="btn btn-warning">Ver</a>
                        <a href="{{ route('users.profiles', $user->id)}}" class="btn btn-info"><i class="fas fa-address-card"></i> SETOR</a>
                    </td> 
                       @else                           
                       <td  style="width=10px">
                        <a href="{{ route('users.edit', $user->id)}}" class="btn btn-info">Edit</a>
                        @if (Auth::user()->editar == true && $user->admin_tenant == true)
                        <a href="{{ route('user.edit.data', $user->id)}}" class="btn btn-info">Dados Cadastrais</a>
                        @endif
                        @if ($user->pedir_editar == true && $user->editar == false)
                        <h6><strong>Permissão para editar dados cadastrais enviada</strong></h6>
                        @endif
                        @if ($user->pedir_editar == false && $user->editar == false && $user->admin_tenant == true)
                        <a href="{{ route('user.pedir.editar', $user->id)}}"  class="btn btn-primary">Autorização para editar cadastro</a>
                        @endif
                        <a href="{{ route('users.show', $user->id)}}" class="btn btn-warning">Ver</a>
                    </td> 
                       @endif
                          
                    </tr>
                @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $users->appends($filters)->links() !!}   
            @else
               {!!$users->links() !!}
            @endif
        </div>
    </div>
@stop