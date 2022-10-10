@extends('adminlte::page')

@section('title', 'Relatório Proedi')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('reports.index')}}">Menu</a></li>        
        <li class="breadcrumb-item active"><a href="{{ route('reports.proedi.index')}}">Relatório do PROEDI</a></li>
        <li class="breadcrumb-item active"><a>Relatório do 1º Trimestre do PROEDI</a></li>
    </ol>
 
<form action="{{ route('reports.proedi.trimestre') }}">
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
        @include('admin.reports.proedi.excel_trimestre', $trimestres)
    </div>
   
</div>
@stop