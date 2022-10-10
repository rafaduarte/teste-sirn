<div class="form-group">
    <label>* Requerimento Assinado</label>
    <input  type="file" name="requerimento"  value="{{$pedido->requerimento}}" class="form-control">
</div>

<div class="form-group">
    <label>* Projeto de Viabilidade</label>
    <input  type="file" name="projeto" value="{{$pedido->projeto}}" class="form-control">
</div>

<div>
    <label>* Nome do Projetista</label>
    <input  type="text" name="nome_projetista" value="{{$pedido->nome_projetista}}" class="form-control">
    <label>* CPF do Projetista</label>
    <input  type="text" name="cpf_projetista" value="{{$pedido->cpf_projetista}}" class="form-control">
    <label>* Telefone do Projetista</label>
    <input  type="text" name="telefone_projetista" value="{{$pedido->telefone_projetista}}" class="form-control">
    <label>* Endereço do Projetista</label>
    <input  type="text" name="endereco_projetista" value="{{$pedido->endereco_projetista}}" class="form-control">
    <label>* Município do Projetista</label>
    <input  type="text" name="municipio_projetista" value="{{$pedido->municipio_projetista}}" class="form-control">
    <label>* UF do Projetista</label>
    <input  type="text" name="uf_projetista" value="{{$pedido->uf_projetista}}" class="form-control">
</div>

<div class="form-group">
    <label>* Documento do Projetista</label>
    <input  type="file" name="documento_projetista" value="{{$pedido->documento_projetista}}" class="form-control">
</div>

<div class="form-group">
    <label>* Inscrição Estadual</label>
    <input  type="file" name="inscricao_estadual" value="{{$pedido->inscricao_estadual}}" class="form-control">
</div>

<div class="form-group">
    <label>* Inscrição Federal</label>
    <input  type="file" name="certidao_federal" value="{{$pedido->certidao_federal}}" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão Estadual</label>
    <input  type="file" name="certidao_estadual" value="{{$pedido->certidao_estadual}}" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão Municipal</label>
    <input  type="file" name="certidao_municipal" value="{{$pedido->certidao_municipal}}" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão Trabalhista</label>
    <input  type="file" name="certidao_trabalhista" value="{{$pedido->certidao_trabalhista}}" class="form-control">
</div>

<div class="form-group">
    <label>* Certidão FGTS</label>
    <input  type="file" name="certidao_fgts" value="{{$pedido->certidao_fgts}}" class="form-control">
</div>

<div class="form-group">
    <label>* Ata de Constituição</label>
    <input  type="file" name="ata_constituicao" value="{{$pedido->ata_constituicao}}" class="form-control">
</div>

<div class="form-group">
    <label>* Procuração do Responsável</label>
    <input  type="file" name="procuracao_responsavel" value="{{$pedido->procuracao_responsavel}}" class="form-control">
</div>

<div class="form-group">
    <label>* RG do Responsável</label>
    <input  type="file" name="rg_responsavel" value="{{$pedido->rg_responsavel}}" class="form-control">
</div>

<div class="form-group">
    <label>* Comprovante de Residência do Responsável</label>
    <input  type="file" name="comprovante_residencia" value="{{$pedido->comprovante_residencia}}" class="form-control">
</div>

<div class="form-group">
    <label>* Relatório GFIP</label>
    <input  type="file" name="relatorio_gfip" value="{{$pedido->relatorio_gfip}}" class="form-control">
</div>

<div class="form-group">
    <label>* Relatório do Faturamento</label>
    <input  type="file" name="relatorio_faturamento" value="{{$pedido->relatorio_faturamento}}" class="form-control">
</div>

<div class="form-group">
    <label> Demais Documentos</label>
    <input  type="file" name="documentos" value="" class="form-control">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Enviar</button> 
</div>