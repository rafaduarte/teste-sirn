@extends('adminlte::page')

@section('title', " SIRN - Detalhes da mensagem ")

@section('content_header')
    <h1><strong>{{ $mensagem->assunto }} </strong> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">    
            <strong> </strong> {{ $mensagem->mensagem }}                
        </div>
    </div>
@endsection
