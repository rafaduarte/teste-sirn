<?php

require '../vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

$body1 = "<table><thead>
                    <tr>
                            <th>Nome </th>
                            <th>Desconto </th>
                            <th>Área de Atuação </th>
                            <th>Produto da Empresa </th>
                            <th>Tipo de Empresa </th>
                            <th>Município da Empresa </th>
                            <th>Data de Início </th>
                            <th>Data Final </th>
                    </tr>
                </thead>";
                ?>

<?php
$bodydois = "<tbody> ";
                    foreach ($empresas as $empresa){
                         $empresa->data_inicio = date('d/m/Y', strtotime($empresa->data_inicio));
                         $empresa->data_final = date('d/m/Y', strtotime($empresa->data_final));
                    $body2 = "
                        <tr>
                            <td>
                                 $empresa->name
                            </td>
                            <td>
                                 $empresa->desconto
                            </td>
                            <td>
                                 $empresa->area_atuacao
                            </td>
                            <td>
                                 $empresa->produto
                            </td> 
                            <td>
                                 $empresa->tipo_empresa
                            </td> 
                            <td>
                                 $empresa->municipio
                            </td>  
                            <td>
                                 $empresa->data_inicio
                            </td>
                            <td>
                                 $empresa->data_final
                            </td>                               
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
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("geral", array("Attachment" => false));

exit(0);