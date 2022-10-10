@extends('adminlte::page')

@section('title', 'RN Mais Gás')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.empresa.index')}}">Menu</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('proedi.empresa.myproedi')}}">RN Mais Gás</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <strong><h3>RN Mais Gás</h3></strong>
        </div>
        <div class="card-body">
                <table class="table table-condensed">
                   
                    @if (count($sei) > 0)
                    <thead>
                        <tr>
                            <th> 
                                <strong>Número de Protocolo</strong>
                            </th>
                            <th>página de andamento do processo</th>
                        </tr>
                    </thead>
                    @endif
                    <tbody>                        
                        @if (count($sei) > 0)
                        @foreach ($sei as $key)
                        <tr>
                            <td>{{$key->numero}}</td>
                            <td style="width=10px"><a href="https://sei.rn.gov.br/sei/controlador_externo.php?acao=usuario_externo_logar&id_orgao_acesso_externo=0" class="btn btn-warning">Página do processo</a></td>
                        </tr>
                        @endforeach
                        @endif
                        @if (count($concessao) > 0 && count($sei) < 1 && count($rngas) < 1)
                        <tr>
                            <td><h3><strong>Estamos analisando o seu pedido</strong></h3></td>
                            <td>Coordenadoria de Desenvolvimento Industrial(CODIT) - SEDEC RN<td>
                        </tr> 
                        @endif
                        @if (count($concessao) < 1 && count($sei) < 1 && count($rngas) < 1)
                        <tr>
                            <td><div class="small-box bg-gradient-blue"   style=" display: inline-block; width: 40%">
                                <div class="inner">
                                  <h5>Faça seu pedido de concessão do RN Mais Gás</h5>
                                  <p>SEDEC RN <strong></strong></p>
                                </div>
                                <div class="icon">
                                  <i class="fas fa-sticky-note"></i>        </div>
                                <a href="{{route('rngas.concessao.create')}}" class="small-box-footer">
                                  Clique aqui para fazer o pedido do RN Mais Gás <i class="fas fa-arrow-circle-right"></i>
                                </a>
                              </div></td>
                        </tr> 
                        @endif                      
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
           
        </div>
    </div>
@stop