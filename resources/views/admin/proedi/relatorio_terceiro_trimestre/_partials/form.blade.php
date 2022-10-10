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
    <input type="radio" name="outros" value="sim" id="outros_beneficios_div_third"> Sim <br>
    <input type="radio" name="outros" value="nao"> Não
</div>
<script type="text/javascript">
    $('#outros_beneficios_div_third').change(function() {
        $('#mycheckboxdiv_outros_beneficios_third').toggle();
    });
    </script>
<div class="form-group" id="mycheckboxdiv_outros_beneficios_third" style="display: none">
    <label>Quais São Os Outros Benefícios?</label> <br>
    <input type="checkbox" name="outros_beneficios[]" value="RN Gás+">  RN Gás+<br>
    <input type="checkbox" name="outros_beneficios[]" value="Pró Sertão">  Pró Sertão<br>
    <input type="checkbox" name="outros_beneficios[]" value="Áreas Industriais">  Áreas Industriais<br>
    <label>**Outros, Quais?</label>
    <input type="text" name="outros_beneficios[]" value="">
</div>
<div class="form-group">
    <label>Possui Placa PROEDI em Boas Condições?</label> <br>
    <input type="radio" name="placa_proedi" value="sim" id="placa_proedi_div_third"> Sim <br>
    <input type="radio" name="placa_proedi" value="nao"> Não
</div>
<script type="text/javascript">
    $('#placa_proedi_div_third').change(function() {
        $('#mycheckboxdiv_placa_proedi_third').toggle();
    });
    </script>
<div class="form-group" id="mycheckboxdiv_placa_proedi_third" style="display: none">
    <label>Anexe Uma Foto da Placa PROEDI</label>
    <input type="file" name="placa_proedi_upload" class="form-control">
</div>
<div class="form-group">
    <label>Faturamento até 30/09</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="faturamento_julho" placeholder="Faturamento em Julho" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="faturamento_agosto" placeholder="Faturamento em Agosto" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="faturamento_setembro" placeholder="Faturamento em Setembro" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante de Faturamento Até 30/09</label>
    <input type="file" name="faturamento_upload" class="form-control">
</div>
<div class="form-group">
    <label>Número de Empregos Diretos Gerados até 30/09</label>
    <input type="text" name="empregos_gerados_trimestre_julho" placeholder="Quantidade de Empregos Gerados em Julho" class="form-control">
    <input type="text" name="empregos_gerados_trimestre_agosto" placeholder="Quantidade de Empregos Gerados em Agosto" class="form-control">
    <input type="text" name="empregos_gerados_trimestre_setembro" placeholder="Quantidade de Empregos Gerados em Setembro" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante Com o Número de Empregos Diretos Gerados Até 30/09</label>
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
    <label>ICMS Total devido até 30/09</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_devido_julho" placeholder="ICMS total devido em Julho" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_devido_agosto" placeholder="ICMS total devido em Agosto" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_devido_setembro" placeholder="ICMS total devido em Setembro" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do ICMS Total Devido Até 30/09</label>
    <input type="file" name="icms_total_devido_upload" class="form-control">
</div>
<div class="form-group">
    <label>ICMS Total Pago Até 30/09</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_pago_julho" placeholder="ICMS total pago em julho" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_pago_agosto" placeholder="ICMS total pago em agosto" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_pago_setembro" placeholder="ICMS total pago em setembro" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do ICMS Total Pago até 30/09</label>
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
    <label>Investimento Realizado até 30/09</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_realizado_julho" placeholder="Investimento realizado em Julho" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_realizado_agosto" placeholder="Investimento realizado em Agosto" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_realizado_setembro" placeholder="Investimento realizado em Setembro" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Investimento Realizado Até 30/09</label>
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
    <input type="radio" name="aprendizes" value="sim" id="menores_aprendizes_third"> Sim <br>
    <input type="radio" name="aprendizes" value="nao"> Não
</div>
<script type="text/javascript">
    $('#menores_aprendizes_third').change(function() {
        $('#mycheckboxdiv_menores_aprendizes_third').toggle();
        $('#mycheckboxdiv_menores_aprendizes_dois_third').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_menores_aprendizes_third" style="display: none">
    <label>Possui Quantos Menores Aprendizes?</label>
    <input type="text" name="possui_menores_aprendizes" class="form-control">
</div>

<div class="form-group" style="display: none" id="mycheckboxdiv_menores_aprendizes_dois_third">
    <label>Anexe O Comprovante De Que Possui Menores Aprendizes</label>
    <input type="file" name="possui_menores_aprendizes_upload"  class="form-control">
</div>
<div class="form-group">
    <label>Possui Estagiários?</label><br>
    <input type="radio" name="estagiarios" value="sim" id="possui_estagiarios_third"> Sim <br>
    <input type="radio" name="estagiarios" value="nao"> Não
</div>

<script type="text/javascript">
    $('#possui_estagiarios_third').change(function() {
        $('#mycheckboxdiv_possui_estagiarios_third').toggle();
        $('#mycheckboxdiv_possui_estagiarios_third_dois').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_possui_estagiarios_third" style="display: none">
    <label>Possui Quantos Estagiários?</label>
    <input type="text" name="possui_estagiarios" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_possui_estagiarios_third_dois" style="display: none">
    <label>Anexe O Comprovante De Que Possui Estagiários</label>
    <input type="file" name="possui_estagiarios_upload" class="form-control">
</div>
<div class="form-group">
    <label>Possui Trainee?</label><br>
    <input type="radio" name="trainee" value="sim" id="possui_trainee_third"> Sim <br>
    <input type="radio" name="trainee" value="nao"> Não
</div>

<script type="text/javascript">
    $('#possui_trainee_third').change(function() {
        $('#mycheckboxdiv_possui_trainee_third').toggle();
        $('#mycheckboxdiv_possui_trainee_third_dois').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_possui_trainee_third" style="display: none">
    <label>Possui Quantos Trainee?</label>
    <input type="text" name="possui_trainee" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_possui_trainee_third_dois" style="display: none">
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
<div class="form-group">
    <button type="submit" class="btn btn-dark" onclick="this.disabled=true;this.form.submit();">Enviar</button>
</div>