<!-- scrips da mascara monetaria !-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

   <script>
    $(document).ready(function(){
   $('.money').mask('000.000.000.000.000,00', {reverse: true});
});
   </script>

<script>
    $(document).ready(function(){
$('.gas').mask('000.000.000.000.000', {reverse: true});   
});
</script>

<script src=
"https://code.jquery.com/jquery-1.12.4.min.js"></script>

<div class="form-group">
    <label> Produtos e Processos</label>
    <input  type="text" name="produtos_processos" class="form-control">
</div>
<div class="form-group">
    <label> Comprovante Produtos e Processos</label>
    <input  type="file" name="comprovante_produtos_processos" class="form-control">
</div>
<div class="form-group">
    <label> Projeção de Receitas</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="projecao_receitas" class="form-control">
</div>
<div class="form-group">
    <label> Comprovante Projeção de Receitas</label>
    <input  type="file" name="comprovante_projecao_receitas" class="form-control">
</div>
<div class="form-group">
    <label> Projeção de Custos</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="projecao_custos" class="form-control">
</div>
<div class="form-group">
    <label> Comprovante Projeção de Custos</label>
    <input  type="file" name="comprovante_projecao_custos" class="form-control">
</div>
<div class="form-group">
    <label> Investimento</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="investimento" class="form-control">
</div>
<div class="form-group">
    <label> Comprovante do Investimento</label>
    <input  type="file" name="Comprovante_investimento" class="form-control">
</div>
<div class="form-group">
    <label> Projeção dos Fluxos de Caixas</label>
    <input style="width: 100%; border-style: outset" type="text" class="money" name="projecao_fluxo_caixa" class="form-control">
</div>
<div class="form-group">
    <label> Projeção dos Fluxos de Caixas</label>
    <input  type="file" name="comprovante_fluxo_caixa" class="form-control">
</div>
<div class="form-group">
    <label> Previsão de Consumo do Gás Natural Por Mês(m³)</label>
    <input style="width: 100%; border-style: outset" type="text" name="consumo_gas_mes" class="gas" class="form-control">
</div>
<div class="form-group">
    <label> Comprovante de Previsão de Consumo do Gás Natural Por Mês</label>
    <input  type="file" name="comprovante_consumo" class="form-control">
</div>
<div class="form-group">
    <label> Previsão da Projeção da Demanda do Gás Natural Nos Próximos 3 Anos(m³)</label>
    <input style="width: 100%; border-style: outset" type="text" name="demanda_gas_tres_anos" class="gas" class="form-control">
</div>
<div class="form-group">
    <label> Comprovante Previsão da Projeção da Demanda do Gás Natural Nos Próximos 3 Anos</label>
    <input  type="file" name="comprovante_demanda" class="form-control">
</div>
<div class="form-group">
    <label> Indicar o Percentual do Gás Natural Na Composição da Matriz Energética da Empresa</label>
    <input  type="text" name="percentual_gas" class="form-control">
</div>
<div class="form-group">
    <label> Comprovante de Indicar o Percentual do Gás Natural Na Composição da Matriz Energética da Empresa</label>
    <input  type="file" name="comprovante_percentual_gas" class="form-control">
</div>
<div class="form-group">
    <label> Número de Empregos Diretos e Indiretos Existentes ou a Serem Gerados</label>
    <input  type="text" name="quantidade_empregos" class="form-control">
</div>
<div class="form-group">
    <label> Comprovante Número de Empregos Diretos e Indiretos Existentes ou a Serem Gerados</label>
    <input  type="file" name="comprovante_quantidade_empregos" class="form-control">
</div>
<div class="form-group">
    <button type="submitsubmit" class="btn btn-dark" onclick="this.disabled=true;this.form.submit();">Próximo</button> 
</div>