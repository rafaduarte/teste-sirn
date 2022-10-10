@extends('adminlte::page')

@section('title', 'sirn - mensagem')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="" class="active">Caixa de Entrada</a></li>
    </ol>

        <h1 style="display: inline; width: 40%"> <a  href="{{ route('admin.mensagem.create') }}" class="btn btn-dark">Enviar mensagem para uma empresa</a></h1>
        <h1 style="display: inline-block; width: 40%"> <a href="{{ route('admin.mensagem.sent') }}" class="btn btn-dark">Visualizar mensagens enviadas</a></h1> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Caixa de Entrada</h4>
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
