<script src=
"https://code.jquery.com/jquery-1.12.4.min.js"></script>

@extends('adminlte::page')

@section('title', 'pedir PROEDI')

@section('content_header')
    <h3></h3>
@stop

@section('content')

    <div class="card">

        @include('admin.includes.alerts')
        <div class="card-body">
            <h3>Editar Pedido de Concessão</h3>
            <h6>(Edite Somente Os Campos Necessários)</h6>
            <form action="{{ route('proedi.concessao.update', $pedido->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.proedi.concessao._partials.edit_form')
            </form>
        </div>
        
    </div>
@endsection