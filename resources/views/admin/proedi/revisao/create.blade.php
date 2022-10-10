@extends('adminlte::page')

@section('title', 'Pedido de Revisão')

@section('content_header')
    <h1>Tem o Requerimento Assinado?</h1>
@stop

@section('content')

    <div class="card">
      @include('admin.includes.alerts')
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><strong>Sim</strong></a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><strong>Não</strong></a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">               
            <div class="card-body">
                <h3>Fazer Pedido de Revisão</h3>
                <form action="{{ route('proedi.revisao.store') }}" class="form" class="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.proedi.revisao._partials.form')
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="card-body">
                <h3>Baixar Requerimento Para Assinar</h3>
                <form action="{{ route('requerimento.revisao.proedi.download') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.proedi.revisao._partials.requerimento_form')
                </form>
            </div>
        </div>
      </div>         
    </div>
@endsection