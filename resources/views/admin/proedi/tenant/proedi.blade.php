@extends('adminlte::page')

@section('title', 'Proedi')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.empresa.index')}}">Menu</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('proedi.empresa.myproedi')}}">PROEDI</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <strong><h3>Meu PROEDI</h3></strong>
        </div>
        <div class="card-body">
                <table class="table table-condensed">
                    @if (count($proedis) > 0)
                    <thead>
                        <tr>
                            <th>Desconto do ICMS </th>
                            <th>Área de Atuação </th>
                            <th>Produto da Empresa </th>
                            <th>Tipo de Empresa </th>
                            <th>Município da Empresa </th>
                            <th>Data de Início </th>
                            <th>Data Final </th>
                            <th width="270">Ações</th>
                        </tr>
                    </thead>
                    @endif
                    @if (count($sei) > 0 && count($proedis) < 1)
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
                        @if (count($proedis) > 0)
                        @foreach ($proedis as $proedi)
                        <tr>                          
                            <td>{{$proedi->desconto}}</td>
                            <td>{{$proedi->area_atuacao}}</td>
                            <td>{{$proedi->produto}}</td>
                            <td>{{$proedi->tipo_empresa}}</td>
                            <td>{{$proedi->municipio}}</td>
                            <td>{{ date('d/m/Y', strtotime($proedi->data_inicio))}}</td>
                            <td>{{ date('d/m/Y', strtotime($proedi->data_final))}}</td>
                            <td  style="width=10px">
                                <a href="{{route('proedi.revisao.create')}}" class="btn btn-warning">Pedir Revisão do PROEDI</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        @if (count($sei) > 0 && count($proedis) < 1)
                        @foreach ($sei as $key)
                        <tr>
                            <td>{{$key->numero}}</td>
                            <td style="width=10px"><a href="https://sei.rn.gov.br/sei/controlador_externo.php?acao=usuario_externo_logar&id_orgao_acesso_externo=0" class="btn btn-warning">Página do processo</a></td>
                        </tr>
                        @endforeach
                        @endif
                        @if (count($concessao) > 0 && count($sei) < 1 && count($proedis) < 1)
                        <tr>
                            <td><h3><strong>Estamos analisando o seu pedido</strong></h3></td>
                            <td>Coordenadoria de Desenvolvimento Industrial(CODIT) - SEDEC RN<td>
                        </tr> 
                        @endif
                        @if (count($concessao) < 1 && count($sei) < 1 && count($proedis) < 1)
                        <tr>
                            <td><div class="small-box bg-gradient-blue"   style=" display: inline-block; width: 40%">
                                <div class="inner">
                                  <h5>Faça seu pedido de concessão do PROEDI</h5>
                                  <p>SEDEC RN <strong></strong></p>
                                </div>
                                <div class="icon">
                                  <i class="fas fa-sticky-note"></i>        </div>
                                <a href="{{route('proedi.concessao.create')}}" class="small-box-footer">
                                  Clique aqui para fazer o pedido do PROEDI <i class="fas fa-arrow-circle-right"></i>
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