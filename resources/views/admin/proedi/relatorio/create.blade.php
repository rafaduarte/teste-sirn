@extends('adminlte::page')

@section('title', 'Relatório')

@section('content_header')
    <h1>Enviar Relatorio do PROEDI</h1>
@stop

@section('content')
    <div class="card">
        
        @include('admin.includes.alerts')

        <div class="card-body">
            <form action="{{ route('proedi.relatorio.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.proedi.relatorio._partials.form')
            </form>
        </div>
    </div>
@endsection