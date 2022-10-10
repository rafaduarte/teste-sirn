@extends('adminlte::page')

@section('title', "{$pedido->nome_empresa}")

@section('content_header')
    <h1>Arquivo de Requerimento da Empresa <b>{{ $pedido->nome_empresa }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <iframe height="800"  width="900" src="/storage/app/public/{{$pedido->requerimento}}"></iframe>
            </ul>
        </div>
    </div>
        @endsection