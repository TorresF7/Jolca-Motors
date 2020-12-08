
<?php

require_once('../vendor/autoload.php');
//plantilla html
require_once('plantillas/reporte/index.php');

//codigo css de la plantilla
$css = file_get_contents('plantillas/reporte/style.css');
$mpdf = new \Mpdf\Mpdf([
  "format" => "A5"
]);

$plantilla = getPlantilla();

$mpdf->writeHtml($css,\Mpdf\HTMLParserMode::HEADER_CSS);


$mpdf->writeHtml($plantilla,\Mpdf\HTMLParserMode::HTML_BODY);


$mpdf->Output();
