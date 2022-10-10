@extends('adminlte::page')

@section('title', "Editar o Usuário {$tenant->social_name}")

@section('content_header')
    <h1>Editar Dados do Cadastro {{ $tenant->social_name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <form action="{{ route('user.update.data', $tenant->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Razão Social:</label>
                    <input type="text" name="social_name" class="form-control" placeholder="{{$tenant->social_name}}" value="{{ $tenant->social_name ?? old('social_name') }}">
                </div>
                <div class="form-group">
                    <label>Nome Fantasia:</label>
                    <input type="text" name="name" class="form-control" placeholder="{{$tenant->name}}" value="{{ $tenant->name ?? old('name') }}">
                </div> 
                <div class="form-group">
                    <label>CNPJ:</label>
                    <input type="text" name="cnpj" class="form-control" placeholder="{{$tenant->cnpj}}" value="{{ $tenant->cnpj ?? old('cnpj') }}">
                </div> 
                <div class="form-group">
                    <label>Inscrição Estadual:</label>
                    <input type="text" name="inscricao_estadual" class="form-control" placeholder="{{$tenant->inscricao_estadual}}" value="{{ $tenant->inscricao_estadual ?? old('inscricao_estadual') }}">
                </div> 
                <div class="form-group">
                    <label>Endereço da Empresa:</label>
                    <input type="text" name="endereco_empresa" class="form-control" placeholder="{{$tenant->endereco_empresa}}" value="{{ $tenant->endereco_empresa ?? old('endereco_empresa') }}">
                </div> 
                <div class="form-group">
                    <label>Município:</label>
                    <input type="text" name="municipio" class="form-control" placeholder="{{$tenant->municipio}}" value="{{ $tenant->municipio ?? old('municipio') }}">
                </div> 
                <div class="form-group">
                    <label>UF:</label>
                    <input type="text" name="uf" class="form-control" placeholder="{{$tenant->uf}}" value="{{ $tenant->uf ?? old('uf') }}">
                </div> 
                <div class="form-group">
                    <label>CEP:</label>
                    <input type="text" name="cep" class="form-control" placeholder="{{$tenant->cep}}" value="{{ $tenant->cep ?? old('cep') }}">
                </div> 
                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="text" name="telefone" class="form-control" placeholder="{{$tenant->telefone}}" value="{{ $tenant->telefone ?? old('telefone') }}">
                </div> 
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="{{$tenant->email}}" value="{{ $tenant->email ?? old('email') }}">
                </div> 
                <div class="form-group">
                    <label>Início da Atividade:</label>
                    <input type="text" name="inicio_atividade" class="form-control" placeholder="{{$tenant->inicio_atividade}}" value="{{ $tenant->inicio_atividade ?? old('inicio_atividade') }}">
                </div> 
                <div class="form-group">
                    <label>Tipo de Empresa:</label>
                    <input type="text" name="tipo_empresa" class="form-control" placeholder="{{$tenant->tipo_empresa}}" value="{{ $tenant->tipo_empresa ?? old('tipo_empresa') }}">
                </div> 
                <div class="form-group">
                    <label>CPF do Representante Legal/Procurador</label>
                    <input type="text" name="cpf" class="form-control" placeholder="{{$tenant->cpf}}" value="{{ $tenant->cpf ?? old('cpf') }}">
                </div> 
                <div class="form-group">
                    <label>Endereço do Representante Legal/Procurador:</label>
                    <input type="text" name="endereco_empresario" class="form-control" placeholder="{{$tenant->endereco_empresario}}" value="{{ $tenant->endereco_empresario ?? old('endereco_empresario') }}">
                </div> 
                <div class="form-group">
                    <label>Município do Representante Legal/Procurador:</label>
                    <input type="text" name="municipio_empresario" class="form-control" placeholder="{{$tenant->municipio_empresario}}" value="{{ $tenant->municipio_empresario ?? old('municipio_empresario') }}">
                </div> 
                <div class="form-group">
                    <label>UF do Representante Legal/Procurador:</label>
                    <input type="text" name="uf_empresario" class="form-control" placeholder="{{$tenant->uf_empresario}}" value="{{ $tenant->uf_empresario ?? old('uf_empresario') }}">
                </div> 
                <div class="form-group">
                    <label>CEP do Representante Legal/Procurador:</label>
                    <input type="text" name="cep_empresario" class="form-control" placeholder="{{$tenant->cep_empresario}}" value="{{ $tenant->cep_empresario ?? old('cep_empresario') }}">
                </div> 
                <div class="form-group">
                    <label>Telefone do Representante Legal/Procurador:</label>
                    <input type="text" name="telefone_empresario" class="form-control" placeholder="{{$tenant->telefone_empresario}}" value="{{ $tenant->telefone_empresario ?? old('telefone_empresario') }}">
                </div> 
                <div class="form-group">
                    <label>E-mail do Representante Legal/Procurador:</label>
                    <input type="text" name="email_empresario" class="form-control" placeholder="{{$tenant->email_empresario}}" value="{{ $tenant->email_empresario ?? old('name') }}">
                </div>                                
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
