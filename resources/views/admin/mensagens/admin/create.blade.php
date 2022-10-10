@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'Cadastrar Nova Permissão')

@section('content_header')
    <h1>Enviar mensagem para uma empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.mensagem.store') }}" class="form" method="POST">
                <label>Escolha a empresa</label><br>
                <select name="destinatario" class="form-control">
                @foreach ($tenants as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>>
                @endforeach
            </select>
                @include('admin.mensagens.admin._partials.form')
            </form>
        </div>
    </div>
@endsection
