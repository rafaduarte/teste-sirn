@extends('adminlte::page')

@section('title', "Detalhes do perfil {$mensagem->name}")

@section('content_header')
    <h1> <strong>{{ $mensagem->assunto }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
                    {{ $mensagem->mensagem }}
                <br><br>

            @include('admin.includes.alerts')

            <form action="{{ route('admin.mensagem.destroy' , $mensagem->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> APAGAR MENSAGEM</button>
            </form>
        </div>
    </div>
@endsection
