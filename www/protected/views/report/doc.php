<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<? 
header("Content-type:application/vnd.ms-word;charset=utf-8");
//header("Content-type:application/vnd.ms-word");
//header("Content-type:text/html;charset=utf-8");
header("Content-Disposition:filename=audit_report.doc"); 
?>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 11">
<meta name=Originator content="Microsoft Word 11">
<link rel=File-List href="aa_files/filelist.xml">
<link rel=Edit-Time-Data href="aa_files/editdata.mso">
</head>

<body>

<? 
$isFirst = true;
foreach ($htmlTexts as $text) {
	if ($isFirst) {
		$isFirst = false;
	}
	else {
		//echo "<p style='page-break-before:always'><span>&nbsp;</span></p>";
		echo "<br clear=all style='page-break-before:always;mso-break-type:section-break'>";
	}
	
	echo $text;
}
?>

</body>
</html>