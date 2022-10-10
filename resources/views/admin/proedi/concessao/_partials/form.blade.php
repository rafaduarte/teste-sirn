<!-- scrips da mascara monetaria !-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

<script>
    $(document).ready(function(){
$('#cpf').mask('000.000.000-00', {reverse: true});   
});
</script>

<div class="form-group">
    <label>* Requerimento Assinado</label>
    <input  type="file" name="requerimento" class="form-control">
</div>

<div class="form-group">
    <label>* Projeto de Viabilidade</label>
    <input  type="file" name="projeto" class="form-control">
</div>

<div>
    <label>* Nome do Projetista</label>
    <input  type="text" name="nome_projetista" class="form-control">
    <label>* CPF do Projetista</label>
    <input  type="text" id="cpf" name="cpf_projetista" class="form-control">
    <label>* Telefone do Projetista</label>
    <input  type="text" name="telefone_projetista" class="form-control">
    <label>* Endereço do Projetista</label>
    <input  type="text" name="endereco_projetista" class="form-control">
    <label>* Município do Projetista</label>
    <input  type="text" name="municipio_projetista" class="form-control">
    <label>* UF do Projetista</label>
    <input  type="text" name="uf_projetista" class="form-control">
</div>

<div class="form-group">
    <label>* Documento do Projetista</label>
    <input  type="file" name="documento_projetista" class="form-control">
</div>

<div class="form-group">
    <label>* Inscrição Estadual</label>
    <input  type="file" name="inscricao_estadual" class="form-control">
</div>

<div class="form-group">
    <label>* Inscrição Federal</label>
    <input  type="file" name="certidao_federal" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão Estadual</label>
    <input  type="file" name="certidao_estadual" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão Municipal</label>
    <input  type="file" name="certidao_municipal" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão Trabalhista</label>
    <input  type="file" name="certidao_trabalhista" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão FGTS</label>
    <input  type="file" name="certidao_fgts" class="form-control">
</div>

<div class="form-group">
    <label>* Ata de Constituição</label>
    <input  type="file" name="ata_constituicao" class="form-control">
</div>

<div class="form-group">
    <label>* Procuração do Responsável</label>
    <input  type="file" name="procuracao_responsavel" class="form-control">
</div>

<div class="form-group">
    <label>* RG do Responsável</label>
    <input  type="file" name="rg_responsavel" class="form-control">
</div>

<div class="form-group">
    <label>* Comprovante de Residência do Responsável</label>
    <input  type="file" name="comprovante_residencia" class="form-control">
</div>

<div class="form-group">
    <label>* Relatório GFIP</label>
    <input  type="file" name="relatorio_gfip" class="form-control">
</div>

<div class="form-group">
    <label>* Relatório do Faturamento</label>
    <input  type="file" name="relatorio_faturamento" class="form-control">
</div>

<div class="form-group">
    <label> Demais Documentos</label>
    <input  type="file" name="documentos" class="form-control">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Enviar</button> 
</div>