@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'RN Mais Gás')

@section('content_header')
    <h1>Cadastrar Empresa no RN Mais Gás</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('rngas.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <label>Escolha a empresa</label><br>
                <select name="name">
                @foreach ($tenants as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>>
                @endforeach
            </select> 
                @include('admin.rngas.analise.rngas._partials.form')
            </form>  
        </div>
    </div>
@endsection
