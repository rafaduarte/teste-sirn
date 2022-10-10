<script src=
"https://code.jquery.com/jquery-1.12.4.min.js"></script>

<div class="form-group">
    <label>* Requerimento de Revisão</label>
    <input type="file" name="requerimento" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão Estadual</label>
    <input type="file" name="certidao_estadual" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão Trabalhista</label>
    <input type="file" name="certidao_trabalhista" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão FGTS</label>
    <input type="file" name="certidao_fgts" class="form-control">
</div>

<div class="form-group">
    <label> Carta de motivos</label>
    <input type="file" name="carta_motivos" class="form-control">
</div>

<div class="form-group">
    <label>Escolha Os Motivos</label> <br/>
    <input type="checkbox" name="motivos[]" value="mudanca de local" id="mudanca_local_um"> Mundança de Local <br/>
    <input type="checkbox" name="motivos[]" value="aumento de faturamento" id="faturamento_um"> Aumento de Faturamento <br/>
    <input type="checkbox" name="motivos[]" value="aumento de empregados" id="empregados_um"> Aumento de Empregados <br/>
    <input type="checkbox" name="motivos[]" value="compra de materia prima" id="materia_prima_um"> Compra de Matéria Prima <br/>
    <input type="checkbox" name="motivos[]" value="investimento em pesquisa" id="investimento_ped_um"> Investimento em Pesquisa e Desenvolvimento <br/>
    <input type="checkbox" name="motivos[]" value="investimento em conservacao" id="investimento_conservacao_um">Investimento em Conservação Ambiental <br/>
    <input type="checkbox" name="motivos[]" value="investimento em mao de obra" id="investimento_mao_obra_um"> Investimento em Capacitação de Mão de Obra Local <br/>
</div>

<script type="text/javascript">
    $('#mudanca_local_um').change(function() {
        $('#mycheckboxdiv_mudanca_local').toggle();
    });
    </script>

<script type="text/javascript">
    $('#faturamento_um').change(function() {
        $('#mycheckboxdiv_faturamento').toggle();
    });
    </script>

<script type="text/javascript">
    $('#empregados_um').change(function() {
        $('#mycheckboxdiv_empregados').toggle();
    });
    </script>

<script type="text/javascript">
    $('#materia_prima_um').change(function() {
        $('#mycheckboxdiv_materia_prima').toggle();
    });
    </script>

<script type="text/javascript">
    $('#investimento_ped_um').change(function() {
        $('#mycheckboxdiv_investimento_ped').toggle();
    });
    </script>

<script type="text/javascript">
    $('#investimento_conservacao_um').change(function() {
        $('#mycheckboxdiv_investimento_conservacao').toggle();
    });
    </script>

<script type="text/javascript">
    $('#investimento_mao_obra_um').change(function() {
        $('#mycheckboxdiv_investimento_mao_obra').toggle();
    });
    </script>

<div class="form-group" id="mycheckboxdiv_mudanca_local" style="display:none">
    <label> Mudança de local(anexar comprovante de residência da empresa)</label>
    <input type="file" name="mudanca_local" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_faturamento" style="display:none">
    <label> Aumento de Faturamento</label>
    <input type="file" name="faturamento" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_empregados" style="display:none">
    <label>  Aumento de Empregados</label>
    <input type="file" name="empregados" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_materia_prima" style="display:none">
    <label>  Compra de Matéria Prima(Anexar CFOP Relatório em PDF)</label>
    <input type="file" name="materia_prima" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_investimento_ped" style="display:none">
    <label>  Investimento em Pesquisa e Desenvolvimento</label>
    <input type="file" name="investimento_ped" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_investimento_conservacao" style="display:none">
    <label>  Investimento em Conservação Ambiental</label>
    <input type="file" name="investimento_conservacao" class="form-control">
</div>

<div class="form-group" id="mycheckboxdiv_investimento_mao_obra" style="display:none">
    <label>  Investimento em Capacitação de Mão de Obra Local</label>
    <input type="file" name="investimento_mao_obra" class="form-control">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark" onclick="this.disabled=true;this.form.submit();">Enviar</button>
</div>