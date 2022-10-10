@extends('adminlte::page')

@section('title', 'pedir PROEDI')

@section('content_header')
    <h1>Possui Requerimento Assinado?</h1>
@stop

@section('content')

    <div class="card">

        @include('admin.includes.alerts')

                <div class="card-body">
                    <h3>Fazer Pedido de Concessão do RN Gás+</h3>
                    <form action="{{ route('rngas.concessao.store.three') }}" class="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.rngas.concessao._partials.form_create_three')
                    </form>
                </div> 
             </div>
@endsection