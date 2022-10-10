@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label>Assunto:</label>
    <input type="text" name="assunto" class="form-control" placeholder="Assunto:">
</div>
<div class="form-group">
    <label>Mensagem:</label>
    <textarea name="mensagem" id="" cols="30" rows="10" class="form-control"  placeholder="Mensagem:"></textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark" onclick="this.disabled=true;this.form.submit();">Enviar</button>
</div>
