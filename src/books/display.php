<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="html/css; charset=cp1250" />
<style>

.vsjo {
	width: 900px;
	margin: auto;
}

</style>

</head>
<body>

<div class="vsjo">
<table border="0"><tr><td colspan="2">
<h2>VVopičí zálohy 16.11.2009 - 10.12.2011</h2> (změna kódování z důvodu zpětné kompatibility se souborovými daty)<br />
<a href="#old">tohle nic není chci pořádně starý vvopice, nebo vám ukážu!</a>
<?php

function Nablij($filename){

if (File_Exists($filename)){
	$lines = file($filename);
	foreach ($lines as $line_num => $line) {
			
		$line = str_replace("ßa=", "<br /><br /></td></tr><tr><td><b>", $line);
		$line = str_replace("ßb=", "</b></td><td align=\"right\">", $line);
		$line = str_replace("ßc=", "", $line);
		$line = str_replace("ßd=", "</td></tr><tr><td colspan=\"2\">", $line);
		
	echo $line;
	}

}
}




Nablij("./data2.dat");
echo "</td></tr>";
Nablij("./data.dat");
echo "</td></tr>";
echo "<tr><td rowspan=\"2\"><a name=old>
<h2>Pekelně starý VVopice</h2> (bacha, pořadí je opačný než u balíku mladších vvopic a nechce se mi s tim srát)
<hr></td></tr>";

include "book091116.htm";
include "book090308.htm";
include "book070403.htm";
include "book070122.htm";

include "book070103.htm";
include "book061104.htm";
include "book060927.htm";
include "book060912.htm";

include "book060816.htm";
include "book060809.htm";
include "book060325.htm";

include "book060123.htm";
?>

<tr><td>
<h2>Konec a pohádky je zvonec</h2> (pěkná pruda tohle dělat, už asi ale nikdy nebudu. btw, pokud se zesere DB verze, zálohy nebudou:-) )
</td></tr>
</table>
<br /><br /><br />

</div>
</body>
</html>