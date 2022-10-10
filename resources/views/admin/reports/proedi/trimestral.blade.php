<?php

require '../vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

$body1 = "
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
<h3 align='center' class='text-danger'>Relatório Trimestral do PROEDI</h3>

<table   border='1'  width='100%'><thead>
                    <tr>
                                    <th>Nome da Empresa</th>
                                    <th>CNPJ</th>
                                    <th>Benefícios </th>
                                    <th>Tem Placa? </th>
                                    <th>Empregos Em Janeiro: </th>
                                    <th>Empregos Em Fevereiro: </th>
                                    <th>Empregos Em Março: </th>
                                    <th>Quantidade De Empregos Diretos Gerados A Partir Da Adesão Ao PROEDI: </th>
                                    <th>% Matéria Prima Adquirida no RN (Atual): </th>
                                    <th>ICMS Total Devido Em Janeiro: </th>
                                    <th>ICMS Total Devido Em Fevereiro: </th>
                                    <th>ICMS Total Devido Em Março: </th>

                                   
                    </tr>
                </thead>";
                ?>

<?php
$bodydois = "<tbody> ";
                    foreach ($trimestres as $trimestre){
                         
                    $body2 = "
                        <tr>
                            <td>
                                $trimestre->name
                            </td>
                           <td>
                                $trimestre->desconto
                            </td>
                           <td>
                                $trimestre->outros_beneficios
                            </td>
                           <td>
                                $trimestre->placa_proedi
                            </td> 
                           <td>
                                $trimestre->empregos_gerados_trimestre_janeiro
                            </td> 
                           <td>
                                $trimestre->empregos_gerados_trimestre_fevereiro
                            </td>  
                           <td>
                                $trimestre->empregos_gerados_trimestre_marco
                            </td>
                           <td>
                                $trimestre->empregos_gerados_proedi
                            </td>
                           <td>
                                $trimestre->materia_prima_adquirida_rn
                            </td> 
                           <td>
                                $trimestre->icms_total_devido_janeiro
                            </td> 
                           <td>
                                $trimestre->icms_total_devido_fevereiro
                            </td> 
                           <td>
                                $trimestre->icms_total_devido_marco
                            </td> <br>
                                                   
                        </tr>
                </tbody>";            
                $bodydois = $bodydois .  $body2;
            }
                ?>
<?php
$body3 = "
         
        </table>
        
        ";
$html = $body1 . $bodydois . $body3;

$body11 = "
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
<h3 align='center' class='text-danger'>Relatório Trimestral do PROEDI</h3>

<table   border='1' margin='-50'  width='40%'><thead>
                    <tr>
                                    
                                    
                                    <th>ICMS Total pago Em Janeiro, Até: </th>
                                    <th>ICMS Total pago Em Fevereiro: </th>
                                    <th>ICMS Total pago Em Março: </th>
                                    <th>Investimento Projetado (Próximo Ano) (R$): </th>
                                    <th>Investimento Realizado Até Janeiro: </th>
                                    <th>Investimento Realizado Até Fevereiro: </th>
                                    <th>Investimento Realizado Até Março: </th>
                                    <th>Investimento Total Realizado A Partir Da Adesão Ao PROEDI: </th>
                                    <th>Número De Empregos Diretos Atuais(Por Função):</th>
                                    <th>Número De Menores Aprendizes:</th>
                                    <th>Número De Estagiários:</th>
                                    <th>Número De Trainees:</th>
                                    <th>Digite O Destino da Mercadoria:</th>
                    </tr>
                </thead>";
                ?>

<?php
$bodyddois = "<tbody> ";
                    foreach ($trimestres as $trimestre){
                         
                    $body22 = "
                        <tr>
                            <td>
                                $trimestre->investimento_projetado
                            </td> 
                            <td>
                                $trimestre->investimento_projetado
                            </td> 
                            <td>
                                $trimestre->investimento_projetado
                            </td>  
                           <td>
                                $trimestre->investimento_projetado
                            </td> 
                           <td>
                                $trimestre->investimento_realizado_janeiro
                            </td> 
                           <td>
                                $trimestre->investimento_realizado_fevereiro
                            </td> 
                           <td>
                                $trimestre->investimento_realizado_marco
                            </td> 
                           <td>
                                $trimestre->investimento_total_realizado
                            </td> 
                           <td>
                                $trimestre->n_empregos_diretos_atuais
                            </td> 
                           <td>
                                $trimestre->possui_menores_aprendizes
                            </td> 
                           <td>
                                $trimestre->possui_estagiarios
                            </td> 
                           <td>
                                $trimestre->possui_trainee
                            </td> 
                           <td>
                                $trimestre->destino_mercadoria
                            </td>                               
                        </tr>
                </tbody>";            
                $bodyddois = $bodyddois .  $body22;
            }
                ?>
<?php
$body33 = "
         
        </table>
        
        ";
$htmll = $body11 . $bodyddois . $body33;
$total = $html . $htmll;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($total);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("geral", array("Attachment" => false));

exit(0);
