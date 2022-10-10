@extends('adminlte::page')

@section('title', "Detalhes do usuário {$user->name}")

@section('content_header')
    <h1>Detalhes do usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <h4>Dados do Usuário</h4>
                <li>
                    <strong>Nome:</strong> {{$user->name}}
                </li>
                <li>
                    <strong>E-mail:</strong> {{$user->email}}
                </li>
                <li>
                    <strong>Empresa:</strong> {{$user->tenant->name}}
                </li>
            </ul>
            <ul>
                <h4>Dados do Cadastro</h4>
                <li>
                    <strong>Razão Social:</strong> {{$tenant->social_name}}  
                </li>
                <li>
                    <strong>Nome Empresa:</strong> {{$tenant->name}}
                </li>
                <li>
                    <strong>CNPJ:</strong> {{$tenant->cnpj}}
                </li>
                <li>
                    <strong>Inscrição Estadual:</strong> {{$tenant->inscricao_estadual}}
                </li>
                <li>
                    <strong>Endereço da Empresa:</strong> {{$tenant->endereco_empresa}}
                </li>
                <li>
                    <strong>Município:</strong> {{$tenant->municipio}}
                </li>
                <li>
                    <strong>UF:</strong> {{$tenant->uf}}
                </li>
                <li>
                    <strong>CEP:</strong> {{$tenant->cep}}
                </li>
                <li>
                    <strong>Telefone:</strong> {{$tenant->telefone}}
                </li>
                <li>
                    <strong>Email:</strong> {{$tenant->email}}
                </li>
                <li>
                    <strong>Início da Atividade:</strong> {{$tenant->inicio_atividade}}
                </li>
                <li>
                    <strong>Tipo de Empresa:</strong> {{$tenant->tipo_empresa}}
                </li>
                <li>
                    <strong>Nome do Representante Legal:</strong> {{$tenant->nome_empresario}}
                </li>
                <li>
                    <strong>Município do Representante Legal:</strong> {{$tenant->municipio_empresario}}
                </li>
                <li>
                    <strong>UF do Representante Legal:</strong> {{$tenant->uf_empresario}}
                </li>
                <li>
                    <strong>Telefone do Representante Legal:</strong> {{$tenant->telefone_empresario}}
                </li>
                <li>
                    <strong>Email do Representante Legal:</strong> {{$tenant->email_empresario}}
                </li>
            </ul>
            @include('admin.includes.alerts')
            @if (Auth::user()->isAdmin())
            <form action="{{ route('users.destroy', $user->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o Usuário</button>
            </form> 
            @endif            
        </div>
    </div>
        @endsection