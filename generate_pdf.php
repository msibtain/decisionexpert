<?php	 	
$pdf_html = '
<table>
<tr>
	<td>This is in TD</td>
</tr>
</table>
';

	# Print PDF now;
	
	require_once('html2pdf/html2pdf.class.php');
	$margins = array(2,2,2,2);
	
	try
	{
		$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', $margins);
	//		$html2pdf->setModeDebug();
		//$html2pdf->pdf->IncludeJS($script);
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($pdf_html);
		$html2pdf->Output('adm_report.pdf', 'D');
	}
	catch(HTML2PDF_exception $e) { echo $e; }
	
	
	?>