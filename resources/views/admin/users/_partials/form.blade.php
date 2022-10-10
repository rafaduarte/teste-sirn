<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>E-mail:</label>
    <input type="email" name="email" class="form-control" placeholder="Nome:" value="{{ $user->email ?? old('email') }}">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha">
    <p>A Senha Deve Ter No Mínimo 8 Digitos Com Letra Maiúscula, Número e Caractere Especial(!@#$%&*)</p>
</div>
<div class="form-group">
    <label>Confirme A Sua Senha:</label>
    <input type="password" name="confirm_password" class="form-control" placeholder="Confirme a Senha">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark" onclick="this.disabled=true;this.form.submit();">Enviar</button>
</div>