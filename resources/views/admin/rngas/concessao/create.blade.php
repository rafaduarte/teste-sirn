<script src=
"https://code.jquery.com/jquery-1.12.4.min.js"></script>

@extends('adminlte::page')

@section('title', 'pedir PROEDI')

@section('content_header')
    <h1>Possui Requerimento Assinado?</h1>
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
                    <h3>Fazer Pedido de Concessão do RN Gás+</h3>
                    <form action="{{ route('rngas.concessao.store') }}" class="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.rngas.concessao._partials.form_create')
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    <h3>Baixar Requerimento Para Assinar</h3>
                    <form action="{{ route('requerimento.rngas.download') }}" class="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.rngas.concessao._partials.requerimento_form')
                    </form>
                </div>
            </div>
          </div> 
    </div>
@endsection