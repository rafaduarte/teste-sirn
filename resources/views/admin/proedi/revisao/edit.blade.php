@extends('adminlte::page')

@section('title', 'Pedido de Revisão')

@section('content')

    <div class="card">
      @include('admin.includes.alerts')
      <div class="card-body">
        <h3>Editar Pedido de Revisão</h3>
        <h6>(Edite Somente Os Campos Necessários)</h6>
        <form action="{{ route('revisao.proedi.update', $pedido->id) }}" class="form" class="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.proedi.revisao._partials.edit_form')
        </form>
    </div>        
    </div>
@endsection