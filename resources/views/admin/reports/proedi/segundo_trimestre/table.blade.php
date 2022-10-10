<table class="table table-bordered">
    <thead  class="table-dark" style="background-color: #343a40" >
    <tr>
        <th></th>
        <th>Nome da Empresa</th>
        <th>CNPJ</th>
        <th>Benefícios </th>
        <th>Tem Placa PROEDI? </th>
        <th>Faturamento de Abril</th>
        <th>Faturamento de Maio</th>
        <th>Faturamento de Junho</th>
        <th>Empregos Gerados Em Abril </th>
        <th>Empregos Gerados Em Maio: </th>
        <th>Empregos Gerados Em Junho: </th>
        <th>Quantidade De Empregos Diretos Gerados A Partir Da Adesão Ao PROEDI: </th>
        <th>% Matéria Prima Adquirida no RN (Atual): </th>
        <th>ICMS Total Devido Em Abril: </th>
        <th>ICMS Total Devido Em Maio: </th>
        <th>ICMS Total Devido Em Junho: </th>
        <th>ICMS Total pago Em Abril, Até: </th>
        <th>ICMS Total pago Em Maio: </th>
        <th>ICMS Total pago Em Junho: </th>
        <th>Investimento Projetado (Próximo Ano) (R$): </th>
        <th>Investimento Realizado Até Abril: </th>
        <th>Investimento Realizado Até Maio: </th>
        <th>Investimento Realizado Até Junho: </th>
        <th>Investimento Total Realizado A Partir Da Adesão Ao PROEDI: </th>
        <th>Número De Empregos Diretos Atuais(Por Função):</th>
        <th>Número De Menores Aprendizes:</th>
        <th>Número De Estagiários:</th>
        <th>Número De Trainees:</th>
        <th>Digite O Destino da Mercadoria:</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trimestres as $trimestre)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$trimestre->razao_social}}</td>
            <td>{{(int)$trimestre->cnpj}}</td>
            <td>{{$trimestre->outros_beneficios}}</td>            
            <td>{{$trimestre->placa_proedi}}</td>
            <td>{{number_format( $trimestre->faturamento_abril ,2) }}</td>
            <td>{{number_format( $trimestre->faturamento_maio ,2) }}</td>
            <td>{{number_format( $trimestre->faturamento_junho,2)}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_abril}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_maio}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_junho}}</td>
            <td>{{$trimestre->empregos_gerados_proedi}}</td>
            <td>{{$trimestre->materia_prima_adquirida_rn}}</td>
            <td>{{number_format( $trimestre->icms_total_devido_abril ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_devido_maio ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_devido_junho,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_pago_abril,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_pago_maio ,2)}}</td>
            <td>{{number_format( $trimestre->icms_total_pago_junho,2) }}</td>
            <td>{{number_format( $trimestre->investimento_projetado ,2) }}</td>                              
            <td>{{number_format( $trimestre->investimento_realizado_abril ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_realizado_maio ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_realizado_junho ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_total_realizado,2) }}</td>
            <td>{{$trimestre->n_empregos_diretos_atuais}}</td>
            <td>{{$trimestre->possui_menores_aprendizes}}</td>
            <td>{{$trimestre->possui_estagiarios}}</td>
            <td>{{$trimestre->possui_trainee}}</td>
            <td>{{$trimestre->destino_mercadoria}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
