<?php

require '../vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

app_path('storage/app/public/images/logo.png');

$options = new Options();
//$options->setChroot();
$options->setIsRemoteEnabled(true);
$options->isRemoteEnabled(true);
$options->isHtml5ParserEnabled(true);
$options->setTempDir(true);
//$options->enable_remote(true);


// instantiate and use the dompdf class
$dompdf = new Dompdf($options);

//$dompdf->loadHtml($html);

$html = view('admin.proedi.requerimento.table.table');

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation landscape or portrait
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("geral", array("Attachment" => false));

exit(0);