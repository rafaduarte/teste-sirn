@extends('adminlte::page')

@section('title', 'pedir RN Gás Mais')

@section('content')

    <div class="card">

        @include('admin.includes.alerts')

                <div class="card-body">
                    <h3>Fazer Pedido de Concessão do RN Gás+</h3>
                    <form action="{{ route('rngas.atualizar.two') }}" class="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.rngas.concessao._partials.form_edit_two')
                    </form>
                </div> 
             </div>
@endsection