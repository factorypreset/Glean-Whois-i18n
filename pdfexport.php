<?php
require_once("pdfcall/dompdf_config.inc.php");
$html =
  '<html><head>
   <style type="text/css">
#printertitlemain
{
	width:100%;
	height:auto;
	font-size:24px;
	font-weight:bold;
	margin-top:5px;
	margin-bottom:5px;
	font-family:Arial, Helvetica, sans-serif;
}
#printertitlesite
{
		width:100%;
	height:auto;
	font-size:16px;
	font-weight:bold;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}
#printertitlefindings
{
			width:100%;
	height:auto;
	font-size:16px;
	font-weight:bold;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}
#printertitlewhoisdata
{
			width:100%;
	height:auto;
	font-size:16px;
	font-weight:bold;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}

#printercontentsite
{
			width:100%;
	height:auto;
	font-size:14px;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}
#printercontentfindings
{
			width:100%;
	height:auto;
	font-size:14px;
	margin-top:5px;
	margin-bottom:5px;
	font-weight:bold;
		font-family:Arial, Helvetica, sans-serif;
}
#printercontentwhoisdata
{
			width:100%;
	height:auto;
	font-size:14px;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}
 
</style>
</head><body>';
$html =$html.stripslashes($_POST["forpdfexp"]);
$html =$html.'</body></html>';
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("gleanwhois_report.pdf");
?>