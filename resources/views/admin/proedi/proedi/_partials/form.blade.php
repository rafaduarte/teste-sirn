<div class="form-group">
    <br>
    <label>Desconto no ICMS</label>
    <input type="text" name="desconto" class="form-control">
</div>

<div class="form-group">
    <label>Área de Atuação</label>
    <input type="text" name="area_atuacao" class="form-control">
</div>

<div class="form-group">
    <label>Produto</label>
    <input type="text" name="produto" class="form-control">
</div>

<div class="form-group">
    <label>Tipo de Empresa</label>
    <input type="text" name="tipo_empresa" class="form-control">
</div>

<div class="form-group">
    <label>Município</label>
    <input type="text" name="municipio" class="form-control">
</div>

<div>
    <label>Data de Início</label> <br>
    <input type="date" value="{{ request('data_inicio') }}" name="data_inicio">
</div>

<div>
    <br>
    <label>Data Final</label> <br>
    <input type="date" value="{{ request('data_final') }}" name="data_final">  
</div>

<div class="form-group">
    <br>
    <button type="submit" class="btn btn-dark" onclick="this.disabled=true;this.form.submit();">Enviar</button>
</div>