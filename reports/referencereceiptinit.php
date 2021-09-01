<?php
	require_once("../dompdf/dompdf_config.inc.php");

	session_start();

	$transaction_id = $_SESSION["transaction_id"];

	ob_start();
	include "receiptpdf.php";
	$html = ob_get_clean();
			
	$dompdf = new DOMPDF();
	$dompdf->set_paper( array(0,0, 8.5 * 72, 11* 72), "portrait" ); 
	$dompdf->load_html($html);
	$dompdf->render();
	$pdf = $dompdf->output();
	$pdfloc = $transaction_id.".pdf";
	file_put_contents($pdfloc,$pdf);
	$dompdf->stream("receipt.pdf",array('Attachment'=>0));
?>