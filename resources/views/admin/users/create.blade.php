@extends('adminlte::page')

@section('title', 'Cadastrar Novo Usuário')

@section('content_header')
    <h1>Cadastrar Novo Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <form action="{{ route('users.store') }}" class="form" method="POST">
                @csrf
                @include('admin.users._partials.form')
            </form>
        </div>
    </div>
@endsection