<!-- scrips da mascara monetaria !-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

   <script>
    $(document).ready(function(){
   $('.money').mask('000.000.000.000.000,00', {reverse: true});
});
   </script>
   
<script src=
"https://code.jquery.com/jquery-1.12.4.min.js"></script>

<div class="form-group">
    <label>Endereço da Empresa</label>
    <input type="text" name="endereco_empresa" class="form-control">
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control">
</div>
<div class="form-group">
    <label>Telefone</label>
    <input type="text" name="telefone" class="form-control">
</div>
<div class="form-group">
    <label>Possui Adesão À Outros Benefícios?</label> <br>
    <input type="radio" name="outros" value="sim" id="outros_beneficios_div"> Sim <br>
    <input type="radio" name="outros" value="nao"> Não
</div>
<script type="text/javascript">
    $('#outros_beneficios_div').change(function() {
        $('#mycheckboxdiv_outros_beneficios').toggle();
    });
    </script>
<div class="form-group" id="mycheckboxdiv_outros_beneficios" style="display: none">
    <label>Quais São Os Outros Benefícios?</label> <br>
    <input type="checkbox" name="outros_beneficios[]" value="RN Gás+">  RN Gás+<br>
    <input type="checkbox" name="outros_beneficios[]" value="Pró Sertão">  Pró Sertão<br>
    <input type="checkbox" name="outros_beneficios[]" value="Áreas Industriais">  Áreas Industriais<br>
    <label>**Outros, Quais?</label>
    <input type="text" name="outros_beneficios[]" value="">
</div>
<div class="form-group">
    <label>Possui Placa PROEDI em Boas Condições?</label> <br>
    <input type="radio" name="placa_proedi" value="sim" id="placa_proedi_div"> Sim <br>
    <input type="radio" name="placa_proedi" value="nao"> Não
</div>
<script type="text/javascript">
    $('#placa_proedi_div').change(function() {
        $('#mycheckboxdiv_placa_proedi').toggle();
    });
    </script>
<div class="form-group" id="mycheckboxdiv_placa_proedi" style="display: none">
    <label>Anexe Uma Foto da Placa PROEDI</label>
    <input type="file" name="placa_proedi_upload" class="form-control">
</div>
<div class="form-group">
    <label>Faturamento da Empresa até 31/03</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="faturamento_janeiro" placeholder="Faturamento em Janeiro" class="form-control"> 
    <input style="width: 100%; border-style: outset" type="text" class="money" name="faturamento_fevereiro" placeholder="Faturamento em Fevereiro" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="faturamento_marco" placeholder="Faturamento em Março" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Faturamento Até 31/03</label>
    <input type="file" name="faturamento_upload" class="form-control">
</div>
<div class="form-group">
    <label>Número de Empregos Diretos Gerados até 31/03</label>
    <input type="text" name="empregos_gerados_trimestre_janeiro" placeholder="Quantidade de Empregos Gerados em Janeiro" class="form-control">
    <input type="text" name="empregos_gerados_trimestre_fevereiro" placeholder="Quantidade de Empregos Gerados em Fevereiro" class="form-control">
    <input type="text" name="empregos_gerados_trimestre_marco" placeholder="Quantidade de Empregos Gerados em Março" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante Com o Número de Empregos Diretos Gerados Até 31/03</label>
    <input type="file" name="empregos_gerados_trimestre_upload" class="form-control">
</div>
<div class="form-group">
    <label>Número de Empregos Diretos Gerados a Partir da Adesão ao PROEDI</label>
    <input type="text" name="empregos_gerados_proedi" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante Com o Número de Empregos Diretos Gerados a Partir da Adesão ao PROEDI </label>
    <input type="file" name="empregos_gerados_proedi_upload" class="form-control">
</div>
<div class="form-group">
    <label>Qual o Percentual De Matéria Prima Adquirida no RN(atual)</label>
    <input type="text" name="materia_prima_adquirida_rn" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante de Matéria Prima Adquirida No RN(atual)</label>
    <input type="file" name="materia_prima_adquirida_rn_upload" class="form-control">
</div>
<div class="form-group">
    <label>ICMS Total devido até 31/03</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_devido_janeiro" placeholder="ICMS total devido em Janeiro" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_devido_fevereiro" placeholder="ICMS total devido em Fevereiro" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_devido_marco" placeholder="ICMS total devido em Março" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do ICMS Total Devido Até 31/03</label>
    <input type="file" name="icms_total_devido_upload" class="form-control">
</div>
<div class="form-group">
    <label>ICMS Total Pago Até 31/03</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_pago_janeiro" placeholder="ICMS total pago em Janeiro" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_pago_fevereiro" placeholder="ICMS total pago em Fevereiro" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_pago_marco" placeholder="ICMS total pago em Março" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do ICMS Total Pago até 31/03</label>
    <input type="file" name="icms_total_pago_upload" class="form-control">
</div>
<div class="form-group">
    <label>Investimento Projetado (Próximo Ano) (R$)</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_projetado" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Investimento Projetado (Próximo Ano) (R$)</label>
    <input type="file" name="investimento_projetado_upload" class="form-control">
</div>
<div class="form-group">
    <label>Investimento Realizado até 31/03</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_realizado_janeiro" placeholder="Investimento realizado em Janeiro" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_realizado_fevereiro" placeholder="Investimento realizado em Fevereiro" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_realizado_marco" placeholder="Investimento realizado em Março" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Investimento Realizado Até 31/03</label>
    <input type="file" name="investimento_realizado_upload" class="form-control">
</div>
<div class="form-group">
    <label>Investimento Total Realizado a Partir da Adesão ao PROEDI</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_total_realizado" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Investimento Total Realizado a Partir da Adesão ao PROEDI</label>
    <input type="file" name="investimento_total_realizado_upload" class="form-control">
</div>
<div class="form-group">
    <label>Número de Empregos Diretos Atuais (Por Função)</label>
    <textarea name="n_empregos_diretos_atuais" id="" cols="30" rows="6" class="form-control"></textarea>
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Número de Empregos Diretos Atuais (Por Função)</label>
    <input type="file" name="n_empregos_diretos_atuais_upload" class="form-control">
</div>
<div class="form-group">
    <label>Possui Menores Aprendizes?</label> <br>
    <input type="radio" name="aprendizes" value="sim" id="menores_aprendizes"> Sim <br>
    <input type="radio" name="aprendizes" value="nao"> Não
</div>
<script type="text/javascript">
    $('#menores_aprendizes').change(function() {
        $('#mycheckboxdiv_menores_aprendizes').toggle();
        $('#mycheckboxdiv_menores_aprendizes_dois').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_menores_aprendizes" style="display: none">
    <label>Possui Quantos Menores Aprendizes?</label>
    <input type="text" name="possui_menores_aprendizes" class="form-control">
</div>

<div class="form-group" style="display: none" id="mycheckboxdiv_menores_aprendizes_dois">
    <label>Anexe O Comprovante De Que Possui Menores Aprendizes</label>
    <input type="file" name="possui_menores_aprendizes_upload"  class="form-control">
</div>
<div class="form-group">
    <label>Possui Estagiários?</label><br>
    <input type="radio" name="estagiarios" value="sim" id="possui_estagiarios"> Sim <br>
    <input type="radio" name="estagiarios" value="nao"> Não
</div>

<script type="text/javascript">
    $('#possui_estagiarios').change(function() {
        $('#mycheckboxdiv_possui_estagiarios').toggle();
        $('#mycheckboxdiv_possui_estagiarios_dois').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_possui_estagiarios" style="display: none">
    <label>Possui Quantos Estagiários?</label>
    <input type="text" name="possui_estagiarios" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_possui_estagiarios_dois" style="display: none">
    <label>Anexe O Comprovante De Que Possui Estagiários</label>
    <input type="file" name="possui_estagiarios_upload" class="form-control">
</div>
<div class="form-group">
    <label>Possui Trainee?</label><br>
    <input type="radio" name="trainee" value="sim" id="possui_trainee"> Sim <br>
    <input type="radio" name="trainee" value="nao"> Não
</div>

<script type="text/javascript">
    $('#possui_trainee').change(function() {
        $('#mycheckboxdiv_possui_trainee').toggle();
        $('#mycheckboxdiv_possui_trainee_dois').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_possui_trainee" style="display: none">
    <label>Possui Quantos Trainee?</label>
    <input type="text" name="possui_trainee" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_possui_trainee_dois" style="display: none">
    <label>Anexe O Comprovante De Que Possui Trainee</label>
    <input type="file" name="possui_trainee_upload" class="form-control">
</div>
<div class="form-group">
    <label>O Destino da Mercadoria</label>
    <textarea name="destino_mercadoria"  cols="30" rows="4" placeholder=" Ex.: 50% RN, 10% PB, 5% CE, 35% Exportação" class="form-control"></textarea>
</div>
<div class="form-group">
    <label>Anexe O Comprovante Do Destino da Mercadoria (anexo único)</label>
    <input type="file" name="destino_mercadoria_upload" class="form-control">
</div>
<div class="form-group" id="teste">
    <button type="submit"  class="btn btn-dark" onclick="this.disabled=true;this.form.submit();">Enviar</button>
</div>