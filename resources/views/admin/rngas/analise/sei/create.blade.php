@include('admin.includes.alerts')

@extends('adminlte::page')

@section('title', 'Processo SEI')

@section('content_header')
    <h1>Cadastrar Processo SEI do RN Mais Gás</h1>
@stop

@section('content')
    <div class="card">
        <div class="fas fa-file-upload">
            <form action="{{ route('rngas.sei.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <label>Escolha a empresa</label><br>
                <select name="nome_empresa">
                @foreach ($tenant as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>>
                @endforeach
            </select>
                @include('admin.rngas.analise.sei._partials.form')
            </form>
        </div>
    </div>
@endsection