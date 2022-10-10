@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'PROEDI')

@section('content_header')
    <h1>Cadastrar PROEDI</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('proedi.store') }}" class="form" method="POST">
                @csrf
                <label>Escolha a empresa</label><br>
                <select name="nome_empresa">
                @foreach ($tenants as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>>
                @endforeach
            </select> 
                @include('admin.proedi.proedi._partials.form')
            </form>  
        </div>
    </div>
@endsection
