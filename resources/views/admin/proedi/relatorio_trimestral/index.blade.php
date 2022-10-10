@extends('adminlte::page')

@section('title', 'Relatórios do PROEDI')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.relatorio.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('proedi.revisao.index')}}">PROEDI</a></li>
    </ol>

    <h1>Relatórios do PROEDI <a href="{{ route('proedi.relatorio.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> Novo Relatório</a></h1>
@stop

@section('content')
    <div class="card">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-first-tab" data-toggle="pill" href="#pills-first" role="tab" aria-controls="pills-first" aria-selected="true">1º Trimestre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-second-tab" data-toggle="pill" href="#pills-second" role="tab" aria-controls="pills-second" aria-selected="false">2º Trimestre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-third-tab" data-toggle="pill" href="#pills-third" role="tab" aria-controls="pills-third" aria-selected="false">3º Trimestre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-fourth-tab" data-toggle="pill" href="#pills-fourth" role="tab" aria-controls="pills-fourth" aria-selected="false">4º Trimestre</a>
              </li>
          </ul>
          
        <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-first" role="tabpanel" aria-labelledby="pills-first-tab">
                   <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Data do Relatório</th>
                            <th>CNPJ</th>
                            <th>Razão Social</th>
                            <th>Solicitado Por</th>
                            <th width="270">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($relatorios as $relatorio)
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($relatorio->created_at))}}</td>
                            <td>{{$relatorio->cnpj}}</td>
                            <td>{{$relatorio->razao_social}}</td>
                            <td>{{$relatorio->nome_fantasia}}</td>
                            <td  style="width=10px">
                                <a href="{{ route('proedi.relatorio.show', $relatorio->id)}}" class="btn btn-warning">Ver</a>                                
                                @if ($relatorio->editar == true)
                                <a href="{{ route('proedi.relatorio.edit', $relatorio->id)}}" class="btn btn-primary">Editar</a>
                                @endif
                                @if ($relatorio->pedir_editar == true && $relatorio->editar == false)
                               <h6><strong>Permissão para editar enviada</strong></h6>
                                @endif
                                @if ($relatorio->pedir_editar == false && $relatorio->editar == false )
                                <a href="{{ route('proedi.relatorio.pedir.edicao', $relatorio->id)}}"  class="btn btn-primary">Autorização para editar</a>
                                @endif 
                            </td>
                        </tr>
                @endforeach
                    </tbody>
                   </table>
                </div>
                <div class="tab-pane fade" id="pills-second" role="tabpanel" aria-labelledby="pills-second-tab">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data do Relatório</th>
                                <th>CNPJ</th>
                                <th>Razão Social</th>
                                <th>Solicitado Por</th>
                                <th width="270">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($segundos as $segundo)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($segundo->created_at))}}</td>
                                <td>{{$segundo->cnpj}}</td>
                                <td>{{$segundo->razao_social}}</td>
                                <td>{{$segundo->nome_fantasia}}</td>
                                <td  style="width=10px">
                                    <a href="{{ route('proedi.relatorio.second.show', $segundo->id)}}" class="btn btn-warning">Ver</a>                                    
                                    @if ($segundo->editar == true)
                                    <a href="{{ route('proedi.relatorio.second.edit', $segundo->id)}}" class="btn btn-primary">Editar</a>                          
                                        @endif
                                        @if ($segundo->pedir_editar == true && $segundo->editar == false)
                                    <h6><strong>Permissão para editar enviada</strong></h6>
                                        @endif
                                        @if ($segundo->pedir_editar == false && $segundo->editar == false )
                                        <a href="{{ route('proedi.relatorio.pedir.edicao.segundo', $segundo->id)}}"  class="btn btn-primary">Autorização para editar</a>
                                    @endif 
                                </td>
                            </tr>
                    @endforeach
                        </tbody>
                       </table>
                </div>
                <div class="tab-pane fade" id="pills-third" role="tabpanel" aria-labelledby="pills-third-tab">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data do Relatório</th>
                                <th>CNPJ</th>
                                <th>Razão Social</th>
                                <th>Solicitado Por</th>
                                <th width="270">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($terceiros as $terceiro)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($terceiro->created_at))}}</td>
                                <td>{{$terceiro->cnpj}}</td>
                                <td>{{ $terceiro->razao_social }}</td>
                                <td>{{ $terceiro->nome_fantasia }}</td>
                                <td  style="width=10px">
                                    <a href="{{ route('proedi.relatorio.third.show', $terceiro->id)}}" class="btn btn-warning">Ver</a>                                    
                                    @if ($terceiro->editar == true)
                                    <a href="{{ route('proedi.relatorio.third.edit', $terceiro->id)}}" class="btn btn-primary">Editar</a>                           
                                        @endif
                                        @if ($terceiro->pedir_editar == true && $terceiro->editar == false)
                                    <h6><strong>Permissão para editar enviada</strong></h6>
                                        @endif
                                        @if ($terceiro->pedir_editar == false && $terceiro->editar == false )
                                        <a href="{{ route('proedi.relatorio.pedir.edicao.terceiro', $terceiro->id)}}"  class="btn btn-primary">Autorização para editar</a>
                                    @endif 
                                </td>
                            </tr>
                    @endforeach
                        </tbody>
                       </table>
                </div>
                <div class="tab-pane fade" id="pills-fourth" role="tabpanel" aria-labelledby="pills-fourth-tab">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data do Relatório</th>
                                <th>CNPJ</th>
                                <th>Razão Social</th>
                                <th>Solicitado Por</th>
                                <th width="270">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quartos as $quarto)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($quarto->created_at))}}</td>
                                <td>{{$quarto->cnpj}}</td>
                                <td>{{$quarto->razao_social}}</td>
                                <td>{{$quarto->nome_fantasia}}</td>
                                <td  style="width=10px">
                                    <a href="{{ route('proedi.relatorio.fourth.show', $quarto->id)}}" class="btn btn-warning">Ver</a>                                    
                                    @if ($quarto->editar == true)
                                    <a href="{{ route('proedi.relatorio.fourth.edit', $quarto->id)}}" class="btn btn-primary">Editar</a>                          
                                        @endif
                                        @if ($quarto->pedir_editar == true && $quarto->editar == false)
                                    <h6><strong>Permissão para editar enviada</strong></h6>
                                        @endif
                                        @if ($quarto->pedir_editar == false && $quarto->editar == false )
                                        <a href="{{ route('proedi.relatorio.pedir.edicao.quarto', $quarto->id)}}"  class="btn btn-primary">Autorização para editar</a>
                                    @endif 
                                </td>
                            </tr>
                    @endforeach
                        </tbody>
                       </table>
                </div>
              </div>            
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $relatorios->appends($filters)->links() !!}   
            @else
               {!!$relatorios->links() !!}
            @endif
        </div>
    </div>
@stop