@extends('adminlte::page')

@section('title', 'pedir PROEDI')

@section('content')

    <div class="card">

        @include('admin.includes.alerts')

                <div class="card-body">
                    <h3>Fazer Pedido de Concessão do RN Gás+</h3>
                    <form action="{{ route('rngas.atualizar.three') }}" class="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.rngas.concessao._partials.form_edit_three')
                    </form>
                </div> 
             </div>
@endsection