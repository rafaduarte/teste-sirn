@extends('adminlte::page')

@section('title', 'Menu RN Mais Gás')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('proedi.empresa.index')}}">Menu</a></li>
    </ol>
@stop

@section('content')

<div class="card-body">
    <thead>
      @if ($quantidadeRnGas > 0)   

      <div class="small-box"  style=" background-color: white; display: inline-block; width: 35%; padding: 10px; height: 110px; margin: 10px">
        <a href="{{ route('rngas.meurngas')}}">
        <div class="inner">
          <h4 style="margin: 12%">RN Mais Gás</h4>
          {{--  <p>Total de Empresas: <strong>{{$quantidadeProedi}}</strong></p> --}}
        </div>
        <div class="icon">
            <i>
              <img style="width: 90px; margin-top: -80%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/PROEDI-72.png'))) }}"  alt="">
            </i>
        </div>        
        </a>
      </div>
      @endif  
      
      @if ($quantidadeRnGas < 1)

      <div class="small-box"  style=" background-color: white; display: inline-block; width: 35%; padding: 10px; height: 110px; margin: 10px">
        <a href="{{ route('rngas.meurngas')}}">
        <div class="inner">
          <h4 style="margin: 12%">RN Mais Gás</h4>
          {{--  <p>Total de Empresas: <strong>{{$quantidadeProedi}}</strong></p> --}}
        </div>
        <div class="icon">
            <i>
              <img style="width: 90px; margin-top: -80%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/PROEDI-72.png'))) }}"  alt="">
            </i>
        </div>        
        </a>
      </div>        
            
      @endif
      
      <div class="small-box"  style=" background-color: white; display: inline-block; width: 35%; padding: 10px; height: 110px; margin: 10px">
        <a href="{{route('rngas.concessao.index')}}">
        <div class="inner">
          <h4 style="color: green; margin: 4%">Pedidos <br> de Concessão</h4>
         {{--  <p>Total de Pedidos: <strong>{{$quantidadeConcessao}}</strong></p> --}}
        </div>
        <div class="icon">
            <i>
              <img style="width: 90px; margin-top: -80%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pedidos_concessao.png'))) }}"  alt="">
            </i>           
          </div>       
        </a>
      </div>

      <div class="small-box"  style=" background-color: white; display: inline-block; width: 35%; padding: 10px; height: 110px; margin: 10px">
        <a href="{{ route('tenant.rngas.sei.index')}}">
        <div class="inner">
          <h4 style="color: rgb(4, 12, 122); margin: 4%">SEI</h4>
          {{--  <p>total de Relatórios: <strong>@if (isset($soma)) {{$soma}} @else 0 @endif   --}}           
          </strong></p>
        </div>
        <div class="icon">
          <i>
            <img style="width: 90px; margin-top: -80%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/sei.png'))) }}"  alt="">
          </i>
        </div>        
        </a>
      </div>
      
    </thead>
</div>
@stop