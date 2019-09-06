<?php

// Require composer autoload
require_once("mpdf57/mpdf.php");

$mpdf = new mPDF();

$mpdf->debug = true;

$mpdf->WriteHTML("Hallo World");

$mpdf->Output();

?>