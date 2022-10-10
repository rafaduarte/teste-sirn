@extends('adminlte::page')

@section('title', 'Relatório Trimestral')

@section('content_header')
    <h1>Alterar Relatório do PROEDI</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">            
        <h3>Relatório do 4º Trimestre do PROEDI</h3>
        <p>(Edite Somente Os Campos Necessários)</p>
    </div>
      <div class="card-body">
        <form action="{{ route('proedi.relatorio.fourth.update', $relatorio->id) }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.proedi.relatorio_quarto_trimestre._partials.edit')
      </form>
      </div>

</div>

@endsection