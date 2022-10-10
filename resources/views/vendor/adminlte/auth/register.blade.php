<!-- scrips da mascara monetaria !-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

   <script>
       $(document).ready(function(){
   $('#cnpj').mask('00.000.000/0000-00', {reverse: true});   
});
   </script>

<script>
    $(document).ready(function(){
$('#cpf').mask('000.000.000-00', {reverse: true});   
});
</script>

<script>
    $(document).ready(function(){
$('#cep_um').mask('00000-000', {reverse: true});   
});

$(document).ready(function(){
$('#cep_dois').mask('00000-000', {reverse: true});   
});
</script>

@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
@include('admin.includes.alerts')
    <form action="{{ route('register') }}" method="post">
        {{ csrf_field() }}
       
        {{-- Razão Social field --}}
        <div class="input-group mb-3">
            <input type="text" name="social_name" class="form-control {{ $errors->has('social_name') ? 'is-invalid' : '' }}"
                   value="{{ old('social_name') }}" placeholder="{{ __('Razão Social da Empresa') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-industry {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('social_name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('social_name') }}</strong>
                </div>
            @endif
        </div>

        {{-- Nome Fantasia  field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}"
                   placeholder="{{ __('Nome Fantasia da Empresa') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-industry"></span>
                </div>
            </div>

            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>

         {{-- CNPJ field --}}
         <div class="input-group mb-3">
            <input type="text" id="cnpj" name="cnpj" class="form-control {{ $errors->has('cnpj') ? 'is-invalid' : '' }}"
                 placeholder="CNPJ" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-industry {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('cnpj'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('cnpj') }}</strong>
                </div>
            @endif
        </div>

        {{-- Inscrição Estadual field --}}
        <div class="input-group mb-3">
            <input type="text" name="inscricao_estadual" class="form-control {{ $errors->has('inscricao_estadual') ? 'is-invalid' : '' }}"
                 placeholder="Inscrição Estadual da Empresa" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-industry {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('inscricao_estadual'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('inscricao_estadual') }}</strong>
                </div>
            @endif
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        {{-- Endereço da Empresa field --}}
        <div class="input-group mb-3">
            <input type="text" name="endereco_empresa" class="form-control {{ $errors->has('endereco_empresa') ? 'is-invalid' : '' }}"
                 placeholder="Endereço da Empresa" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marked-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('endereco_empresa'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('endereco_empresa') }}</strong>
                </div>
            @endif
        </div>

        {{-- Município field --}}
        <div class="input-group mb-3">
            <input type="text" name="municipio" class="form-control {{ $errors->has('municipio') ? 'is-invalid' : '' }}"
                 placeholder="municipio" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('municipio'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('municipio') }}</strong>
                </div>
            @endif
        </div>

        {{-- UF field --}}
        <div class="input-group mb-3">
            <input type="text" name="uf" class="form-control {{ $errors->has('uf') ? 'is-invalid' : '' }}"
                 placeholder="UF" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-globe-americas {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('uf'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('uf') }}</strong>
                </div>
            @endif
        </div>

        {{-- CEP field --}}
        <div class="input-group mb-3">
            <input type="text" id="cep_um" name="cep" class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}"
                 placeholder="CEP" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-map {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('cep'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('cep') }}</strong>
                </div>
            @endif
        </div>

        {{-- Telefone field --}}
        <div class="input-group mb-3">
            <input type="text" name="telefone" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}"
                 placeholder="Telefone da Empresa" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('telefone'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('telefone') }}</strong>
                </div>
            @endif
        </div>

        {{-- Início das atividades field --}}
        <label>Início da Atividade da Empresa:</label><br>
        <div class="input-group mb-3">            
            <input type="date" name="inicio_atividade" class="form-control {{ $errors->has('inicio_atividade') ? 'is-invalid' : '' }}"
                 placeholder="Início das Ativiades" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-industry {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('inicio_atividade'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('inicio_atividade') }}</strong>
                </div>
            @endif
        </div>

        {{-- Tipo de Empresa field --}}
        <div class="input-group mb-3">
            <input type="text" name="tipo_empresa" class="form-control {{ $errors->has('tipo_empresa') ? 'is-invalid' : '' }}"
                 placeholder="Tipo de Empresa" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-industry {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('tipo_empresa'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('tipo_empresa') }}</strong>
                </div>
            @endif
        </div>

        {{-- Nome do Empresário field --}}
        <div class="input-group mb-3">
            <input type="text" name="nome_empresario" class="form-control {{ $errors->has('nome_empresario') ? 'is-invalid' : '' }}"
                 placeholder="Nome do Representante Legal" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('nome_empresario'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('nome_empresario') }}</strong>
                </div>
            @endif
        </div>

        {{-- CPF field --}}
        <div class="input-group mb-3">
            <input type="text" id="cpf" name="cpf" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}"
                 placeholder="CPF do Representante Legal" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('cpf'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('cpf') }}</strong>
                </div>
            @endif
        </div>

        {{-- Endereço do Empresário field --}}
        <div class="input-group mb-3">
            <input type="text" name="endereco_empresario" class="form-control {{ $errors->has('endereco_empresario') ? 'is-invalid' : '' }}"
                 placeholder="Endereço do Representante Legal" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marked-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('endereco_empresario'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('endereco_empresario') }}</strong>
                </div>
            @endif
        </div>

        {{-- Município do Empresário field --}}
        <div class="input-group mb-3">
            <input type="text" name="municipio_empresario" class="form-control {{ $errors->has('municipio_empresario') ? 'is-invalid' : '' }}"
                 placeholder="Município do Representante Legal" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('municipio_empresario'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('municipio_empresario') }}</strong>
                </div>
            @endif
        </div>

        {{-- UF do Empresário field --}}
        <div class="input-group mb-3">
            <input type="text" name="uf_empresario" class="form-control {{ $errors->has('uf_empresario') ? 'is-invalid' : '' }}"
                 placeholder="UF do Representante Legal" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-globe-americas {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('uf_empresario'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('uf_empresario') }}</strong>
                </div>
            @endif
        </div>

        {{-- CEP do Empresário field --}}
        <div class="input-group mb-3">
            <input type="text" id="cep_dois" name="cep_empresario" class="form-control {{ $errors->has('cep_empresario') ? 'is-invalid' : '' }}"
                 placeholder="CEP do Representante Legal" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('cep_empresario'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('cep_empresario') }}</strong>
                </div>
            @endif
        </div>

        {{-- Telefone do Empresário field --}}
        <div class="input-group mb-3">
            <input type="text" name="telefone_empresario" class="form-control {{ $errors->has('telefone_empresario') ? 'is-invalid' : '' }}"
                 placeholder="Telefone do Representante Legal" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('telefone_empresario'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('telefone_empresario') }}</strong>
                </div>
            @endif
        </div>

        {{-- E-mail do Empresário field --}}
        <div class="input-group mb-3">
            <input type="text" name="email_empresario" class="form-control {{ $errors->has('email_empresario') ? 'is-invalid' : '' }}"
                 placeholder="E-mail do Representante Legal" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('email_empresario'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email_empresario') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password"
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>           
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>
        <p>A Senha Deve Ter No Mínimo 8 Digitos Com Letra Maiúscula, Número e Caractere Especial(!@#$%&*)</p>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}" onclick="this.disabled=true;this.form.submit();">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
