@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'Cadastrar Nova Permissão')

@section('content_header')
    <h1>Enviar mensagem para a SEDEC</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenant.mensagem.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @include('admin.mensagens.tenant._partials.form')
            </form>
        </div>
    </div>
@endsection
