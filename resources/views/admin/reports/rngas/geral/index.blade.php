@extends('adminlte::page')

@section('title', 'Relatório RN Mais Gás')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('reports.index')}}">Menu</a></li>        
        <li class="breadcrumb-item active"><a href="{{ route('reports.proedi.index')}}">Relatório do RN Mais Gás</a></li>
        <li class="breadcrumb-item active"><a>Geral </a></li>
    </ol>
 
<form action="{{ route('reports.rngas.geral') }}">
    <div class="btn-group" role="group" aria-label="Basic example">
        <input name="relatorio_excel" class="btn btn-primary" type="submit" value="Baixar Excel(XLSX)">
        <input name="relatorio_csv" class="btn btn-primary" type="submit" value="Baixar CSV">
        <input name="relatorio_ods" class="btn btn-primary" type="submit" value="Baixar ODS">
      </div>
</form>
    
@stop

@section('content')
<div class="card" style="width: 2800px">   
    <div style="width: 50px">
        @include('admin.reports.rngas.geral.form', $empresas)
    </div>
   
</div>
@stop