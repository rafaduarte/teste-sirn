<table class="table table-bordered">
    <thead  class="table-dark" style="background-color: #343a40" >
    <tr>
        <th></th>
        <th>Nome da Empresa</th>
        <th>CNPJ</th>
        <th>Benefícios </th>
        <th>Tem Placa PROEDI? </th>
        <th>Faturamento de Julho</th>
        <th>Faturamento de Agosto</th>
        <th>Faturamento de Setembro</th>
        <th>Empregos Gerados Em Julho </th>
        <th>Empregos Gerados Em Agosto: </th>
        <th>Empregos Gerados Em Setembro: </th>
        <th>Quantidade De Empregos Diretos Gerados A Partir Da Adesão Ao PROEDI: </th>
        <th>% Matéria Prima Adquirida no RN (Atual): </th>
        <th>ICMS Total Devido Em Julho: </th>
        <th>ICMS Total Devido Em Agosto: </th>
        <th>ICMS Total Devido Em Setembro: </th>
        <th>ICMS Total pago Em Julho: </th>
        <th>ICMS Total pago Em Agosto: </th>
        <th>ICMS Total pago Em Setembro: </th>
        <th>Investimento Projetado (Próximo Ano) (R$): </th>
        <th>Investimento Realizado Até Julho: </th>
        <th>Investimento Realizado Até Agosto: </th>
        <th>Investimento Realizado Até Setembro: </th>
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
            <td>{{$trimestre->cnpj}}</td>
            <td>{{$trimestre->outros_beneficios}}</td>            
            <td>{{$trimestre->placa_proedi}}</td>
            <td>{{number_format( $trimestre->faturamento_julho ,2) }}</td>
            <td>{{number_format( $trimestre->faturamento_agosto ,2) }}</td>
            <td>{{number_format( $trimestre->faturamento_setembro,2)}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_julho}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_agosto}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_setembro}}</td>
            <td>{{$trimestre->empregos_gerados_proedi}}</td>
            <td>{{$trimestre->materia_prima_adquirida_rn}}</td>
            <td>{{number_format($trimestre->icms_total_devido_julho ,2) }}</td>
            <td>{{number_format($trimestre->icms_total_devido_agosto ,2) }}</td>
            <td>{{number_format($trimestre->icms_total_devido_setembro ,2) }}</td>
            <td>{{number_format($trimestre->icms_total_pago_julho ,2) }}</td>
            <td>{{number_format($trimestre->icms_total_pago_agosto ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_pago_setembro ,2)}}</td>
            <td>{{number_format( $trimestre->investimento_projetado ,2)}}</td>                              
            <td>{{number_format( $trimestre->investimento_realizado_julho ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_realizado_agosto ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_realizado_setembro ,2)}}</td>
            <td>{{number_format( $trimestre->investimento_total_realizado, 2)}}</td>
            <td>{{$trimestre->n_empregos_diretos_atuais}}</td>
            <td>{{$trimestre->possui_menores_aprendizes}}</td>
            <td>{{$trimestre->possui_estagiarios}}</td>
            <td>{{$trimestre->possui_trainee}}</td>
            <td>{{$trimestre->destino_mercadoria}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
