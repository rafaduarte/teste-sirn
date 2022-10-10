<table class="table table-bordered">
    <thead  class="table-dark" style="background-color: #343a40" >
    <tr>
        <th></th>
        <th>Nome da Empresa</th>
        <th>CNPJ</th>
        <th>Produtos e Processos: </th>
        <th>Projeção de Receitas: </th>
        <th>Investimento: </th>
        <th>Projeção de Fluxos de Caixas: </th>
        <th>Projeção de Fluxos de Custos: </th>
        <th>Previsão de Consumo do Gás Natural Por Mês:</th>
        <th>Previsão da Projeção da Demanda do Gás Natural nos Próximos 3 Anos: </th>
        <th>Indicação do Percentual do Gás Natural nos Próximos 3 Anos: </th>
        <th>Número de Empregos Diretos e Indiretos Existentes ou a Serem Gerados: </th>            
    </tr>
    </thead>
    <tbody>
    @foreach($especificos as $especifico)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$especifico->social_name}}</td>
            <td>{{$especifico->cnpj}}</td>
            <td>{{$especifico->produtos_processos}}</td>
            <td>{{number_format( $especifico->projecao_receitas ,2) }}</td>
            <td>{{number_format( $especifico->investimento ,2) }}</td>
            <td>{{number_format( $especifico->projecao_fluxo_caixa ,2)}}</td>
            <td>{{number_format( $especifico->projecao_custos ,2)}}</td>
            <td>{{$especifico->consumo_gas_mes}}</td>
            <td>{{$especifico->demanda_gas_tres_anos}}</td>
            <td>{{$especifico->percentual_gas}}</td>
            <td>{{$especifico->quantidade_empregos}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
