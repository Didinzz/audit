<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

$id = isset($_GET['id']) ? $_GET['id'] : null;

ob_start();
include 'laporan.php';
$html = ob_get_clean();

$dompdf->loadHtml($html);

$date = date('d-m-Y');

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream('laporan_Audit_Kendaraan_' . $date . '.pdf', array('Attachment' => true));
exit(0);
