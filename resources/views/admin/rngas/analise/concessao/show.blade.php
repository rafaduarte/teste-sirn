@extends('adminlte::page')

@section('title', "Empresa {$pedido->nome_empresa}")

@section('content_header')
    <h1>Detalhes do Pedido de Concessão do RN Mais Gás <b>{{ $pedido->nome_empresa }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Requerimento</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->requerimento)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Requerimento </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Instrumento constitutivo da empresa e eventuais alterações ou do contrato social consolidado</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->instrumento_constitutivo)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Estadual </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Estudo de Viabilidade Técnico Econômico de Sua Empresa</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->estudo_viabilidade)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Trabalhista </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Justificativa técnico-econômica assinada por um técnico responsável</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->justificativa_tecnico_economica)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão FGTS </button>
                    </form>              
                  </li>
                  <li>
                    <strong>PROCURAÇÃO (quando houver);</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->procuracao)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Carta de motivos </button>
                    </form>              
                  </li>
                  @isset($pedido->mudanca_local)
                  <li>
                    <strong>Contrato Social e Aditivos</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->contrato_social_aditivos)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Mudança de Local </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->faturamento)
                  <li>
                    <strong>Cartão CNPJ</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->cartao_cnpj)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Aumento de Faturamento </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->empregados)
                  <li>
                    <strong>Inscrição Estadual</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->inscricao_estadual)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Aumento de Empregados </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->materia_prima)
                  <li>
                    <strong>Certidão Federal</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_federal)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Compra de Matéria Prima </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->certidao_estadual)
                  <li>
                    <strong>Certidão Estadual</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_estadual)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Investimento em Pesquisa e Desenvolvimento </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->certidao_municipal)
                  <li>
                    <strong>Certidão Municipal</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_municipal)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Investimento em Conservação Ambientalo </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->certidao_trabalhista)
                  <li>
                    <strong>Certidão Trabalhista</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_trabalhista)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Investimento em Capacitação em Mão de Obra Local </button>
                    </form>              
                  </li>
                  @endisset
                  
                  @isset($pedido->certidao_fgts)
                  <li>
                    <strong>Certidão FGTS</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->certidao_fgts)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Demais Documentos</button>
                    </form> 
                  </li>
                  @endisset 
                  
                  <li>
                    <strong>Ata de Constituição</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->ata_constituicao)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Requerimento </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Produtos e Processos</strong>
                    {{$pedido->produtos_processos}}              
                  </li>
                  @isset($pedido->comprovante_produtos_processos)
                  <li>
                    <strong>Comprovante de Produtos e Processos</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->comprovante_produtos_processos)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Aumento de Faturamento </button>
                    </form>              
                  </li>
                  @endisset
                  <li>
                    <strong>Projeção de Receitas</strong>
                    R$ {{ number_format($pedido->projecao_receitas ,2)}}             
                  </li>
                  <li>
                    <strong>Comprovante Projeção de Receitas</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->comprovante_projecao_receitas)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Trabalhista </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Projeção de Custos</strong>
                     R$ {{number_format($pedido->projecao_custos ,2) }}             
                  </li>
                  @isset($pedido->comprovante_projecao_custos)
                  <li>
                    <strong>Comprovante de Projeção de Custos</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->comprovante_projecao_custos)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Aumento de Faturamento </button>
                    </form>              
                  </li>
                  @endisset
                  <li>
                    <strong>Investimento</strong>
                     R$ {{number_format($pedido->investimento , 2)}}              
                  </li>
                  <strong>Comprovante Investimento</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->Comprovante_investimento)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Carta de motivos </button>
                    </form>              
                  </li>
                  @isset($pedido->projecao_fluxo_caixa)
                  <li>
                    <strong>Projeção de Fluxos de Caixas</strong>
                     R$ {{number_format($pedido->projecao_fluxo_caixa, 2) }}            
                  </li>
                  @endisset
                  @isset($pedido->comprovante_fluxo_caixa)
                  <li>
                    <strong>Comprovante de Projeção de Fluxos de Caixas</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->comprovante_fluxo_caixa)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Aumento de Faturamento </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->consumo_gas_mes)
                  <li>
                    <strong>Previsão de Consumo do Gás Natural Por Mês</strong>
                    {{$pedido->consumo_gas_mes}}              
                  </li>
                  @endisset
                  @isset($pedido->comprovante_consumo)
                  <li>
                    <strong>Comprovante Previsão de Consumo do Gás Natural Por Mês</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->comprovante_consumo)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Compra de Matéria Prima </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->demanda_gas_tres_anos)
                  <li>
                    <strong>Previsão da Projeção da Demanda do Gás Natural nos Próximos 3 Anos</strong>
                    {{$pedido->demanda_gas_tres_anos}}            
                  </li>
                  @endisset
                  @isset($pedido->comprovante_demanda)
                  <li>
                    <strong>Comprovante de Previsão da Projeção da Demanda do Gás Natural nos Próximos 3 Anos</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->comprovante_demanda)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Investimento em Conservação Ambientalo </button>
                    </form>              
                  </li>
                  @endisset
                  @isset($pedido->percentual_gas)
                  <li>
                    <strong>Indicação do Percentual do Gás Natural nos Próximos 3 Anos</strong>
                    {{$pedido->percentual_gas}}                
                  </li>
                  @endisset
                  
                  @isset($pedido->comprovante_percentual_gas)
                  <li>
                    <strong>Comprovante da Indicação do Percentual do Gás Natural nos Próximos 3 Anos</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->comprovante_percentual_gas)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Demais Documentos</button>
                    </form> 
                  </li>
                  @endisset

                  <li>
                    <strong>Número de Empregos Diretos e Indiretos Existentes ou a Serem Gerados</strong>
                    {{$pedido->quantidade_empregos}}                                
                  </li>
                  <li>
                    <strong>Comprovante Número de Empregos Diretos e Indiretos Existentes ou a Serem Gerados</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->comprovante_quantidade_empregos)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Estadual </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Nome do Téncico:</strong> {{$pedido->nome_tecnico}}                        
                  </li>
                  <li>
                    <strong>CPF do Técnico:</strong> {{$pedido->cpf_tecnico}}              
                  </li>
                  <li>
                    <strong>Telefone do Técnico:</strong> {{$pedido->telefone_tecnico}}              
                  </li>
                  <li>
                    <strong>Endereço do Técnico:</strong> {{$pedido->endereco_tecnico}}              
                  </li>
                  <li>
                    <strong>Município do Técnico:</strong> {{$pedido->municipio_tecnico}}              
                  </li>
                  <li>
                    <strong>UF do Técnico:</strong> {{$pedido->uf_tecnico}}              
                  </li>
                  <li>
                    <strong>RG ou CNH</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->documento_tecnico)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Estadual </button>
                    </form>              
                  </li>
                  <li>
                    <strong>Demais Documentos</strong>
                    <form action="{{ route('proedi.concessao.file', $pedido->documentos)}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info" style="width:500px">Visualizar Certidão Estadual </button>
                    </form>              
                  </li>                                
            </ul>
            <form action="{{ route('delete.rngas.admin', $pedido->id)}}" method="POST">                
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o pedido </button>
            </form>   
        </div>
    </div>
        @endsection