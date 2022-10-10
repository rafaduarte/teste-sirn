<table class="table table-bordered">
    <thead  class="table-dark" style="background-color: #343a40" >
    <tr>
        <th></th>
        <th>Nome da Empresa</th>
        <th>CNPJ</th>
        <th>Benefícios </th>
        <th>Tem Placa PROEDI? </th>
        <th>Faturamento de Janeiro</th>
        <th>Faturamento de Fevereiro</th>
        <th>Faturamento de Março</th>
        <th>Empregos Gerados Em Janeiro, Até: </th>
        <th>Empregos Gerados Em Fevereiro: </th>
        <th>Empregos Gerados Em Março: </th>
        <th>Quantidade De Empregos Diretos Gerados A Partir Da Adesão Ao PROEDI: </th>
        <th>% Matéria Prima Adquirida no RN (Atual): </th>
        <th>ICMS Total Devido Em Janeiro: </th>
        <th>ICMS Total Devido Em Fevereiro: </th>
        <th>ICMS Total Devido Em Março: </th>
        <th>ICMS Total pago Em Janeiro, Até: </th>
        <th>ICMS Total pago Em Fevereiro: </th>
        <th>ICMS Total pago Em Março: </th>
        <th>Investimento Projetado (Próximo Ano) (R$): </th>
        <th>Investimento Realizado Até Janeiro: </th>
        <th>Investimento Realizado Até Fevereiro: </th>
        <th>Investimento Realizado Até Março: </th>
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
            <td>{{number_format($trimestre->faturamento_janeiro, 2)}}</td>
            <td>{{number_format($trimestre->faturamento_fevereiro, 2)}}</td>
            <td>{{number_format($trimestre->faturamento_marco, 2)}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_janeiro}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_fevereiro}}</td>
            <td>{{$trimestre->empregos_gerados_trimestre_marco}}</td>
            <td>{{$trimestre->empregos_gerados_proedi}}</td>
            <td>{{$trimestre->materia_prima_adquirida_rn}}</td>
            <td>{{number_format( $trimestre->icms_total_devido_janeiro ,2)}}</td>
            <td>{{number_format( $trimestre->icms_total_devido_fevereiro ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_devido_marco ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_pago_janeiro ,2)}}</td>
            <td>{{number_format($trimestre->icms_total_pago_fevereiro ,2) }}</td>
            <td>{{number_format( $trimestre->icms_total_pago_marco ,2)}}</td>
            <td>{{number_format( $trimestre->investimento_projetado ,2) }}</td>                              
            <td>{{number_format( $trimestre->investimento_realizado_janeiro ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_realizado_fevereiro ,2) }}</td>
            <td>{{number_format( $trimestre->investimento_realizado_marco ,2) }}</td>
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
