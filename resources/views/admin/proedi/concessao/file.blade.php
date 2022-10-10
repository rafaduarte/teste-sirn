@extends('adminlte::page')

@section('title', "Detalhes do Pedido da {$pedido->name}")

@section('content_header')
    <h1>Detalhes do Pedido de Concessão da Empresa <b>{{ $pedido->requerimento }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <iframe height="400"  width="400" src="/assets/{{$pedido->requerimento}}"></iframe>
            </ul>
        </div>
    </div>
        @endsection