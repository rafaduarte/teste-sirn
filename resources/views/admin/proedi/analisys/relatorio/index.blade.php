@extends('adminlte::page')

@section('title', 'Relatórios do PROEDI')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.relatorio.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('proedi.relatorio.index')}}">Relatórios das Empresas do PROEDI</a></li>
    </ol>
@stop

@section('content')
    <div class="card">         
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">1º Trimestre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">2º Trimestre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-third-tab" data-toggle="pill" href="#pills-third" role="tab" aria-controls="pills-third" aria-selected="false">3º Trimestre</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-fourth-tab" data-toggle="pill" href="#pills-fourth" role="tab" aria-controls="pills-fourth" aria-selected="false">4º Trimestre</a>
              </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"><div class="card-header">
                <form action="{{route('relatorio.proedi.search')}}" method="POST" class="form form-inline">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Filtrar por nome ou CNPJ" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-dark">Filtrar</button>
                </form>
            </div>
            <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data do Relatório</th>
                                <th>CNPJ</th>
                                <th>Razão Social</th>
                                <th>Solicitado Por</th>
                                <th width="270">Ações</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($primeiros as $primeiro)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($primeiro->created_at))}}</td>
                                <td>{{$primeiro->cnpj}}</td>
                                <td>{{$primeiro->razao_social}}</td>
                                <td>{{ $primeiro->nome_fantasia }}</td>
                                <td  style="width=10px">
                                    <a href="{{ route('relatorio.proedi.show', $primeiro->id)}}" class="btn btn-warning" >                                        
                                        Visualizar</a>
                                </td>
                                <td>
                                    @if ($primeiro->editar == false)
                                    <form action="{{ route('primeiro.relatorio.proedi.permitir.editar', $primeiro->id) }}" method="POST" class="form form-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" formmethod="post" class="btn btn-success">Permitir Edição</button>                                
                                    </form>
                                    @else
                                    <form action="{{ route('primeiro.relatorio.proedi.retirar.editar', $primeiro->id) }}" method="POST" class="form form-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" formmethod="post" class="btn btn-danger">Retirar Edição</button>                                
                                    </form>
                                    @endif 
                                </td>
                            </tr>
                    @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="card-footer">
                @if (isset($filters))
                {!! $primeiros->appends($filters)->links() !!}   
                @else
                   {!!$primeiros->links() !!}
                @endif
            </div></div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><div class="card-header">
                <form action="{{route('relatorio.proedi.second.search')}}" method="POST" class="form form-inline">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Filtrar por nome ou CNPJ" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-dark">Filtrar</button>
                </form>
            </div>
            <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data do Relatório</th>
                                <th>CNPJ</th>
                                <th>Razão Social</th>
                                <th>Solicitado Por</th>
                                <th width="270">Ações</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($segundos as $segundo)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($segundo->created_at))}}</td>
                                <td>{{$segundo->cnpj}}</td>
                                <td>{{$segundo->razao_social}}</td>
                                <td>{{ $segundo->nome_fantasia }}</td>
                                <td  style="width=10px">
                                    <a href="{{ route('relatorio.proedi.second.show', $segundo->id)}}" class="btn btn-warning">Visualizar</a>
                                </td>
                                <td>
                                    @if ($segundo->editar == false)
                                    <form action="{{ route('segundo.relatorio.proedi.permitir.editar', $segundo->id) }}" method="POST" class="form form-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" formmethod="post" class="btn btn-success">Permitir Edição</button>                                
                                    </form>
                                    @else
                                    <form action="{{ route('segundo.relatorio.proedi.retirar.editar', $segundo->id) }}" method="POST" class="form form-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" formmethod="post" class="btn btn-danger">Retirar Edição</button>                                
                                    </form>
                                    @endif 
                                </td>
                            </tr>
                    @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="card-footer">
                @if (isset($filters))
                {!! $segundos->appends($filters)->links() !!}   
                @else
                   {!!$segundos->links() !!}
                @endif
            </div></div>
            <div class="tab-pane fade" id="pills-third" role="tabpanel" aria-labelledby="pills-third-tab"><div class="card-header">
                <form action="{{route('relatorio.proedi.third.search')}}" method="POST" class="form form-inline">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Filtrar por nome ou CNPJ" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-dark">Filtrar</button>
                </form>
            </div>
            <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data do Relatório</th>
                                <th>CNPJ</th>
                                <th>Razão Social</th>
                                <th>Solicitado Por</th>
                                <th width="270">Ações</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($terceiros as $terceiro)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($terceiro->created_at))}}</td>
                                <td>{{$terceiro->cnpj}}</td>
                                <td>{{$terceiro->razao_social}}</td>
                                <td>{{ $terceiro->nome_fantasia }}</td>
                                <td  style="width=10px">
                                    <a href="{{ route('relatorio.proedi.third.show', $terceiro->id)}}" class="btn btn-warning">Visualizar</a>
                                </td>
                                <td>
                                    @if ($terceiro->editar == false)
                                    <form action="{{ route('terceiro.relatorio.proedi.permitir.editar', $terceiro->id) }}" method="POST" class="form form-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" formmethod="post" class="btn btn-success">Permitir Edição</button>                                
                                    </form>
                                    @else
                                    <form action="{{ route('terceiro.relatorio.proedi.retirar.editar', $terceiro->id) }}" method="POST" class="form form-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" formmethod="post" class="btn btn-danger">Retirar Edição</button>                                
                                    </form>
                                    @endif 
                                </td>
                            </tr>
                    @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="card-footer">
                @if (isset($filters))
                {!! $terceiros->appends($filters)->links() !!}   
                @else
                   {!!$terceiros->links() !!}
                @endif
            </div></div>
            <div class="tab-pane fade" id="pills-fourth" role="tabpanel" aria-labelledby="pills-fourth-tab"><div class="card-header">
                <form action="{{route('relatorio.proedi.fourth.search')}}" method="POST" class="form form-inline">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Filtrar por nome ou CNPJ" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-dark">Filtrar</button>
                </form>
            </div>
            <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data do Relatório</th>
                                <th>CNPJ</th>
                                <th>Razão Social</th>
                                <th>Solicitado Por</th>
                                <th width="270">Ações</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($quartos))
                                                            
                            @foreach ($quartos as $quarto)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($quarto->created_at))}}</td>
                                <td>{{$quarto->cnpj}}</td>
                                <td>{{$quarto->razao_social}}</td>
                                <td>{{ $quarto->nome_fantasia }}</td>
                                <td  style="width=10px">
                                    <a href="{{ route('relatorio.proedi.fourth.show', $quarto->id)}}" class="btn btn-warning">Visualizar</a>
                                </td>
                                <td>
                                    @if ($quarto->editar == false)
                                    <form action="{{ route('quarto.relatorio.proedi.permitir.editar', $quarto->id) }}" method="POST" class="form form-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" formmethod="post" class="btn btn-success">Permitir Edição</button>                                
                                    </form>
                                    @else
                                    <form action="{{ route('quarto.relatorio.proedi.retirar.editar', $quarto->id) }}" method="POST" class="form form-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" formmethod="post" class="btn btn-danger">Retirar Edição</button>                                
                                    </form>
                                    @endif 
                                </td>
                            </tr>
                    @endforeach
                    @endif
                        </tbody>
                    </table>
            </div>
            <div class="card-footer">
                @if (isset($filters))
                {!! $quartos->appends($filters)->links() !!}   
                @else
                   {!!$quartos->links() !!}
                @endif
                     </div>
                </div>
            </div>
          </div>
@stop