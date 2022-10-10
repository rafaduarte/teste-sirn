@extends('adminlte::page')

@section('title', 'PROEDI')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.empresa.index')}}">Menu PROEDI</a></li>
    </ol>
@stop

@section('content')

<div class="card-body">
    <thead>
      @if ($quantidadeProedi > 0)

      <div class="small-box"  style=" background-color: white; display: inline-block; width: 35%; padding: 10px; height: 110px; margin: 10px">
        <a href="{{ route('proedi.empresa.myproedi')}}">
        <div class="inner">
          <h4 style="margin: 12%; text-align: left">PROEDI</h4>
          {{--  <p>Visualizar meu PROEDI <strong></strong></p> --}}
        </div>
        <div class="icon">
            <i>
              <img style="width: 90px; margin-top: -80%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/PROEDI-72.png'))) }}"  alt="">
            </i>
        </div>       
        </a>
      </div>
      @endif  
      
      @if ($quantidadeProedi < 1)
      
      <div class="small-box"  style=" background-color: white; display: inline-block; width: 35%; padding: 10px; height: 110px; margin: 10px">
        <a href="{{ route('proedi.empresa.myproedi')}}">
        <div class="inner">
          <h4 style="margin: 5%">PROEDI <br> <p>Acompanhar processo do PROEDI <strong></strong></p></h4>
        
        </div>
        <div class="icon">
            <i>
              <img style="width: 90px; margin-top: -80%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/PROEDI-72.png'))) }}"  alt="">
            </i>
        </div>        
      </a>
      </div>
      @endif
      
     
      <div class="small-box"   style=" background-color: white; display: inline-block; width: 35%; padding: 10px; height: 110px; margin: 10px">
        <a href="{{route('proedi.concessao.index')}}">
        <div class="inner">
          <h4 style="color: green; margin: 4%">Pedidos <br> de Concessão</h4>
          {{--<p>Total de Pedidos: <strong>{{$quantidadeConcessao}}</strong></p> --}}
        </div>
        <div class="icon">
          <i>
            <img style="width: 90px; margin-top: -80%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pedidos_concessao.png'))) }}"  alt="">
          </i>        
        </div>
      </a>
      </div>
    
      <div class="small-box"  style=" background-color: white; display: inline-block; width: 35%; padding: 10px; height: 110px; margin: 10px">
        <a href="{{route('proedi.revisao.index')}}">
        <div class="inner">
          <h4 style="color: #de991a; margin: 4%">Pedidos <br> de Revisão</h4>
          {{--  <p>Total de Pedidos: <strong>{{$countRevision}}</strong></p> --}}
        </div>
        <div class="icon">
          <i>
            <img style="width: 90px; margin-top: -80%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pedidos_revisao.png'))) }}"  alt="">
          </i>
         </div>
      </a>
      </div>
    
      <div class="small-box"  style=" background-color: white; display: inline-block; width: 35%; padding: 10px; height: 110px; margin: 10px">
        <a href="{{ route('proedi.relatorio.index')}}">
        <div class="inner">
          <h4 style="color: rgb(176, 16, 10); margin: 4%">Informações <br> Periódicas</h4>
          {{--  <p>Envie Formulário de Acompanhamento Trimestral</p> --}}
        </div>
        <div class="icon">
          <i>
            <img style="width: 90px; margin-top: -80%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/infos_periodicas.png'))) }}"  alt="">
          </i>
        </div>        
      </a>
      </div>
    </thead>
</div>


@stop