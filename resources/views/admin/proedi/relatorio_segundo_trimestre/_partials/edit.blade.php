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
    <input type="text" name="endereco_empresa" value="{{ $relatorio->endereco_empresa }}" class="form-control">
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" value="{{ $relatorio->email }}" class="form-control">
</div>
<div class="form-group">
    <label>Telefone</label>
    <input type="text" name="telefone" value="{{ $relatorio->telefone }}" class="form-control">
</div>
<div class="form-group">
    <label>Possui Adesão À Outros Benefícios?</label> <br>
    <input type="radio" name="outros" value="sim" id="outros_beneficios_div_second"> Sim <br>
    <input type="radio" name="outros" value="nao"> Não
</div>
<script type="text/javascript">
    $('#outros_beneficios_div_second').change(function() {
        $('#mycheckboxdiv_outros_beneficios_second').toggle();
    });
    </script>
<div class="form-group" id="mycheckboxdiv_outros_beneficios_second" style="display: none">
    <label>Quais São Os Outros Benefícios?</label> <input type="text" name="beneficios" value="{{ $relatorio->outros_beneficios }}"><br>
    <input type="checkbox" name="outros_beneficios[]" value="RN Gás+">  RN Gás+<br>
    <input type="checkbox" name="outros_beneficios[]" value="Pró Sertão">  Pró Sertão<br>
    <input type="checkbox" name="outros_beneficios[]" value="Áreas Industriais">  Áreas Industriais<br>
    <label>**Outros, Quais?</label>
    <input type="text" name="outros_beneficios[]" value="">
</div>
<div class="form-group">
    <label>Possui Placa PROEDI em Boas Condições?</label> <br>
    <input type="radio" name="placa_proedi" value="sim" id="placa_proedi_div_second"> Sim <br>
    <input type="radio" name="placa_proedi" value="nao"> Não
</div>
<script type="text/javascript">
    $('#placa_proedi_div_second').change(function() {
        $('#mycheckboxdiv_placa_proedi_second').toggle();
    });
    </script>
<div class="form-group" id="mycheckboxdiv_placa_proedi_second" style="display: none">
    <label>Anexe Uma Foto da Placa PROEDI</label>
    <input type="file" name="placa_proedi_upload" class="form-control">
</div>
<div class="form-group">
    <label>Faturamento até 30/06</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="faturamento_abril" value="{{ $relatorio->faturamento_abril }}" placeholder="Faturamento em Abril" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="faturamento_maio" value="{{ $relatorio->faturamento_maio }}" placeholder="Faturamento em Maio" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="faturamento_junho" value="{{ $relatorio->faturamento_junho }}" placeholder="Faturamento em Junho" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante de Faturamento Até 30/06</label>
    <input type="file" name="faturamento_upload" class="form-control">
</div>
<div class="form-group">
    <label>Número de Empregos Diretos Gerados até 30/06</label>
    <input type="text" name="empregos_gerados_trimestre_abril" value="{{ $relatorio->empregos_gerados_trimestre_abril }}" placeholder="Quantidade de Empregos Gerados em Abril" class="form-control">
    <input type="text" name="empregos_gerados_trimestre_maio" value="{{ $relatorio->empregos_gerados_trimestre_maio }}" placeholder="Quantidade de Empregos Gerados em Maio" class="form-control">
    <input type="text" name="empregos_gerados_trimestre_junho" value="{{ $relatorio->empregos_gerados_trimestre_junho }}" placeholder="Quantidade de Empregos Gerados em Junho" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante Com o Número de Empregos Diretos Gerados Até 30/06</label>
    <input type="file" name="empregos_gerados_trimestre_upload" class="form-control">
</div>
<div class="form-group">
    <label>Número de Empregos Diretos Gerados a Partir da Adesão ao PROEDI</label>
    <input type="text" name="empregos_gerados_proedi" value="{{ $relatorio->empregos_gerados_proedi }}" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante Com o Número de Empregos Diretos Gerados a Partir da Adesão ao PROEDI </label>
    <input type="file" name="empregos_gerados_proedi_upload" class="form-control">
</div>
<div class="form-group">
    <label>Qual o Percentual De Matéria Prima Adquirida no RN(atual)</label>
    <input type="text" name="materia_prima_adquirida_rn" value="{{ $relatorio->materia_prima_adquirida_rn }}" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante de Matéria Prima Adquirida No RN(atual)</label>
    <input type="file" name="materia_prima_adquirida_rn_upload" class="form-control">
</div>
<div class="form-group">
    <label>ICMS Total devido até 30/06</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_devido_abril" value="{{ $relatorio->icms_total_devido_abril }}" placeholder="ICMS total devido em Abril" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_devido_maio" value="{{ $relatorio->icms_total_devido_maio }}" placeholder="ICMS total devido em Maio" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_devido_junho" value="{{ $relatorio->icms_total_devido_junho }}" placeholder="ICMS total devido em Junho" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do ICMS Total Devido Até 30/06</label>
    <input type="file" name="icms_total_devido_upload" class="form-control">
</div>
<div class="form-group">
    <label>ICMS Total Pago Até 30/06</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_pago_abril" value="{{ $relatorio->icms_total_pago_abril }}" placeholder="ICMS total pago em Abril" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_pago_maio" value="{{ $relatorio->icms_total_pago_maio }}" placeholder="ICMS total pago em Maio" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="icms_total_pago_junho" value="{{ $relatorio->icms_total_pago_junho }}" placeholder="ICMS total pago em Junho" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do ICMS Total Pago até 30/06</label>
    <input type="file" name="icms_total_pago_upload" class="form-control">
</div>
<div class="form-group">
    <label>Investimento Projetado (Próximo Ano) (R$)</label>
    <input type="text" name="investimento_projetado" value="{{ $relatorio->investimento_projetado }}" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Investimento Projetado (Próximo Ano) (R$)</label>
    <input type="file" name="investimento_projetado_upload" class="form-control">
</div>
<div class="form-group">
    <label>Investimento Realizado até 30/06</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_realizado_abril" value="{{ $relatorio->investimento_realizado_abril }}" placeholder="Investimento realizado em Abril" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_realizado_maio" value="{{ $relatorio->investimento_realizado_maio }}" placeholder="Investimento realizado em Maio" class="form-control">
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_realizado_junho" value="{{ $relatorio->investimento_realizado_junho }}" placeholder="Investimento realizado em Junho" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Investimento Realizado Até 30/06</label>
    <input type="file" name="investimento_realizado_upload" class="form-control">
</div>
<div class="form-group">
    <label>Investimento Total Realizado a Partir da Adesão ao PROEDI</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento_total_realizado" value="{{ $relatorio->investimento_total_realizado }}" class="form-control">
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Investimento Total Realizado a Partir da Adesão ao PROEDI</label>
    <input type="file" name="investimento_total_realizado_upload" class="form-control">
</div>
<div class="form-group">
    <label>Número de Empregos Diretos Atuais (Por Função)</label>
    <textarea name="n_empregos_diretos_atuais" id="" cols="30" rows="6" class="form-control">{{ $relatorio->n_empregos_diretos_atuais }}</textarea>
</div>
<div class="form-group">
    <label>Anexe O Comprovante do Número de Empregos Diretos Atuais (Por Função)</label>
    <input type="file" name="n_empregos_diretos_atuais_upload" class="form-control">
</div>
<div class="form-group">
    <label>Possui Menores Aprendizes?</label> <br>
    <input type="radio" name="aprendizes" value="sim" id="menores_aprendizes_second"> Sim <br>
    <input type="radio" name="aprendizes" value="nao"> Não
</div>
<script type="text/javascript">
    $('#menores_aprendizes_second').change(function() {
        $('#mycheckboxdiv_menores_aprendizes_second').toggle();
        $('#mycheckboxdiv_menores_aprendizes_dois_second').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_menores_aprendizes_second" style="display: none">
    <label>Possui Quantos Menores Aprendizes?</label>
    <input type="text" name="possui_menores_aprendizes" value="{{ $relatorio->possui_menores_aprendizes }}" class="form-control">
</div>

<div class="form-group" style="display: none" id="mycheckboxdiv_menores_aprendizes_dois_second">
    <label>Anexe O Comprovante De Que Possui Menores Aprendizes</label>
    <input type="file" name="possui_menores_aprendizes_upload"  class="form-control">
</div>
<div class="form-group">
    <label>Possui Estagiários?</label><br>
    <input type="radio" name="estagiarios" value="sim" id="possui_estagiarios_second"> Sim <br>
    <input type="radio" name="estagiarios" value="nao"> Não
</div>

<script type="text/javascript">
    $('#possui_estagiarios_second').change(function() {
        $('#mycheckboxdiv_possui_estagiarios_second').toggle();
        $('#mycheckboxdiv_possui_estagiarios_second_dois').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_possui_estagiarios_second" style="display: none">
    <label>Possui Quantos Estagiários?</label>
    <input type="text" name="possui_estagiarios" value="{{ $relatorio->possui_estagiarios }}" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_possui_estagiarios_second_dois" style="display: none">
    <label>Anexe O Comprovante De Que Possui Estagiários</label>
    <input type="file" name="possui_estagiarios_upload" class="form-control">
</div>
<div class="form-group">
    <label>Possui Trainee?</label><br>
    <input type="radio" name="trainee" value="sim" id="possui_trainee_second"> Sim <br>
    <input type="radio" name="trainee" value="nao"> Não
</div>

<script type="text/javascript">
    $('#possui_trainee_second').change(function() {
        $('#mycheckboxdiv_possui_trainee_second').toggle();
        $('#mycheckboxdiv_possui_trainee_second_dois').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_possui_trainee_second" style="display: none">
    <label>Possui Quantos Trainee?</label>
    <input type="text" name="possui_trainee" value="{{ $relatorio->possui_trainee }}" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_possui_trainee_second_dois" style="display: none">
    <label>Anexe O Comprovante De Que Possui Trainee</label>
    <input type="file" name="possui_trainee_upload" class="form-control">
</div>
<div class="form-group">
    <label>O Destino da Mercadoria</label>
    <textarea name="destino_mercadoria"  cols="30" rows="4" placeholder=" Ex.: 50% RN, 10% PB, 5% CE, 35% Exportação" class="form-control">{{ $relatorio->destino_mercadoria }}</textarea>
</div>
<div class="form-group">
    <label>Anexe O Comprovante Do Destino da Mercadoria (anexo único)</label>
    <input type="file" name="destino_mercadoria_upload" class="form-control">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark" onclick="this.disabled=true;this.form.submit();">Enviar</button>
</div>