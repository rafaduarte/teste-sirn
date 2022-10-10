@extends('adminlte::page')

@section('title', 'sirn - mensagens enviadas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.mensagem.index')}}">Principal</a></li>
        <li class="breadcrumb-item active"><a href="" class="active">Enviados</a></li>
    </ol>

    <h1> <a href="{{ route('admin.mensagem.create') }}" class="btn btn-dark">Enviar mensagem para as empresas</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Enviados</h4>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Assunto</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mensagens as $mensagem)
                        <tr>
                            <td>
                                {{ $mensagem->assunto }}
                            </td>
                            <td style="width=10px;">
                                <a href="{{ route('admin.mensagem.show', $mensagem->id)}}" class="btn btn-info">Visualizar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @isset($mensagens)
        <div class="card-footer">
            @if (isset($filters))
                {!! $mensagens->appends($filters)->links() !!}
            @else
                {!! $mensagens->links() !!}
            @endif
        </div>                  
        @endisset
    </div>
@stop
