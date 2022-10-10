<div class="form-group">
    <label>* Denominação Social</label>
    <input  type="text" name="social_name" value="{{Auth::user()->tenant->social_name}}" class="form-control">
</div>

<div class="form-group">
    <label>* Inscrição Estadual</label>
    <input  type="text" name="inscricao_estadual" value="{{Auth::user()->tenant->inscricao_estadual}}" class="form-control">
</div>

<div class="form-group">
    <label>* CNPJ</label>
    <input  type="text" name="cnpj" value="{{Auth::user()->formatCnpj(Auth::user()->tenant->cnpj)}}" class="form-control">
</div>

<div class="form-group">
    <label>* Endereço</label>
    <input  type="text" name="endereco_empresa" value="{{Auth::user()->tenant->endereco_empresa}}" class="form-control">
</div>

<div class="form-group">
    <label>* Município</label>
    <input  type="text" name="municipio" value="{{Auth::user()->tenant->municipio}}" class="form-control">
</div>

<div class="form-group">
    <label>* CEP</label>
    <input  type="text" name="cep" value="{{Auth::user()->tenant->cep}}" class="form-control">
</div>

<div class="form-group">
    <label>* Telefone </label>
    <input  type="text" name="telefone" value="{{Auth::user()->tenant->telefone}}" class="form-control">
</div>

<div class="form-group">
    <label>* E-mail</label>
    <input  type="text" name="email" value="{{Auth::user()->tenant->email}}" class="form-control">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Gerar PDF</button>
</div>