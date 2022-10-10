<!-- scrips da mascara monetaria !-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

@extends('adminlte::page')

@section('title', 'Relatório Trimestral')

@section('content_header')
    <h1>Enviar Relatório do PROEDI</h1>
@stop

@section('content')

    <div class="card">
      @include('admin.includes.alerts')
      <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-first-tab" data-toggle="pill" href="#pills-first" role="tab" aria-controls="pills-first" aria-selected="true">1º Trimestre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-second-tab" data-toggle="pill" href="#pills-second" role="tab" aria-controls="pills-second" aria-selected="false">2º Trimestre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-third-tab" data-toggle="pill" href="#pills-third" role="tab" aria-controls="pills-third" aria-selected="false">3º Trimestre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-fourth-tab" data-toggle="pill" href="#pills-fourth" role="tab" aria-controls="pills-fourth" aria-selected="false">4º Trimestre</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-first" role="tabpanel" aria-labelledby="pills-first-tab">
          <div class="card-header">            
            <h3>Relatório do 1º Trimestre do PROEDI</h3>
        </div>
          <div class="card-body">
            <form action="{{ route('proedi.relatorio.store') }}" class="form"  method="POST" enctype="multipart/form-data">
              @csrf
                @include('admin.proedi.relatorio_trimestral._partials.form')
          </form>
          </div>         
          </div>
          <div class="tab-pane fade" id="pills-second" role="tabpanel" aria-labelledby="pills-second-tab">
            <div class="card-header">            
              <h3>Relatório do 2º Trimestre do PROEDI</h3>
          </div>
            <div class="card-body">
              <form action="{{ route('proedi.relatorio.second_store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                  @include('admin.proedi.relatorio_segundo_trimestre._partials.form')
            </form>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-third" role="tabpanel" aria-labelledby="pills-third-tab">
            <div class="card-header">            
              <h3>Relatório do 3º Trimestre do PROEDI</h3>
          </div>
            <div class="card-body">
              <form action="{{ route('proedi.relatorio.third.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                  @include('admin.proedi.relatorio_terceiro_trimestre._partials.form')
            </form>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-fourth" role="tabpanel" aria-labelledby="pills-fourth-tab">
            <div class="card-header">            
              <h3>Relatório do 4º Trimestre do PROEDI</h3>
          </div>
            <div class="card-body">
              <form action="{{ route('proedi.relatorio.fourth.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                  @include('admin.proedi.relatorio_quarto_trimestre._partials.form')
            </form>
            </div>
          </div>
      </div>       
    </div>
@endsection