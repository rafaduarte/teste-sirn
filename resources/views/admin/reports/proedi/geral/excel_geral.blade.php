<table class="table table-bordered">
    <thead  class="table-dark" style="background-color: #343a40" >
        @isset($empresas)
        <tr>
            <th>Nome </th>
            <th>Desconto </th>
            <th>Área de Atuação </th>
            <th>Produto da Empresa </th>
            <th>Tipo de Empresa </th>
            <th>Município da Empresa </th>
            <th>Data de Início </th>
            <th>Data Final </th>
        </tr>
        @endisset
    </thead>
    <tbody>
        @isset($empresas)
        @foreach ($empresas as $empresa)
           <tr>
               <td>{{$empresa->name}}</td>
               <td>{{$empresa->desconto}}</td>
               <td>{{$empresa->area_atuacao}}</td>
               <td>{{$empresa->produto}}</td>
               <td>{{$empresa->tipo_empresa}}</td>
               <td>{{$empresa->municipio}}</td>
               <td>{{ date('d/m/Y', strtotime($empresa->data_inicio))}}</td>
               <td>{{ date('d/m/Y', strtotime($empresa->data_final))}}</td>                               
        </tr>         
    </tbody>
    @endforeach
    @endisset
    </tbody>
</table>
