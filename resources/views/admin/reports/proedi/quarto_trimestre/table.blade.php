<table class="table table-bordered">
    <thead  class="table-dark" style="background-color: #343a40" >
    <tr>
        <th></th>
        <th>Nome da Empresa</th>
        <th>CNPJ</th>
        <th>Benefícios </th>
        <th>Tem Placa PROEDI? </th>
        <th>Faturamento de Outubro</th>
        <th>Faturamento de Novembro</th>
        <th>Faturamento de Dezembro</th>
        <th>Empregos Gerados Em Outubro: </th>
        <th>Empregos Gerados Em Novembro: </th>
        <th>Empregos Gerados Em Dezembro: </th>
        <th>Quantidade De Empregos Diretos Gerados A Partir Da Adesão Ao PROEDI: </th>
        <th>% Matéria Prima Adquirida no RN (Atual): </th>
        <th>ICMS Total Devido Em Outubro: </th>
        <th>ICMS Total Devido Em Novembro: </th>
        <th>ICMS Total Devido Em Dezembro: </th>
        <th>ICMS Total pago Em Outubro, Até: </th>
        <th>ICMS Total pago Em Novembro: </th>
        <th>ICMS Total pago Em Dezembro: </th>
        <th>Investimento Projetado (Próximo Ano) (R$): </th>
        <th>Investimento Realizado Até Outubro: </th>
        <th>Investimento Realizado Até Novembro: </th>
        <th>Investimento Realizado Até Dezembro: </th>
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
            <td>{{number_format( $trimestre->faturamento_outubro ,2) }}</td>
            <td>{{number_format( $trimestre->faturamento_novembro ,2) }}</td>
            <td>{{number_format( $trimestre->faturamento_dezembro ,2)}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_outubro}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_novembro}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_dezembro}}</td>
            <td>{{$trimestre->empregos_gerados_proedi}}</td>
            <td>{{$trimestre->materia_prima_adquirida_rn}}</td>
            <td>{{number_format( $trimestre->icms_total_devido_outubro ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_devido_novembro ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_devido_dezembro ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_pago_outubro ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_pago_novembro ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_pago_dezembro ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_projetado ,2) }}</td>                              
            <td>{{number_format( $trimestre->investimento_realizado_outubro ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_realizado_novembro ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_realizado_dezembro ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_total_realizado ,2) }}</td>
            <td>{{$trimestre->n_empregos_diretos_atuais}}</td>
            <td>{{$trimestre->possui_menores_aprendizes}}</td>
            <td>{{$trimestre->possui_estagiarios}}</td>
            <td>{{$trimestre->possui_trainee}}</td>
            <td>{{$trimestre->destino_mercadoria}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
