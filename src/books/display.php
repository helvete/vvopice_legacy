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
<h2>VVopi�� z�lohy 16.11.2009 - 10.12.2011</h2> (zm�na k�dov�n� z d�vodu zp�tn� kompatibility se souborov�mi daty)<br />
<a href="#old">tohle nic nen� chci po��dn� star� vvopice, nebo v�m uk�u!</a>
<?php

function Nablij($filename){

if (File_Exists($filename)){
	$lines = file($filename);
	foreach ($lines as $line_num => $line) {
			
		$line = str_replace("�a=", "<br /><br /></td></tr><tr><td><b>", $line);
		$line = str_replace("�b=", "</b></td><td align=\"right\">", $line);
		$line = str_replace("�c=", "", $line);
		$line = str_replace("�d=", "</td></tr><tr><td colspan=\"2\">", $line);
		
	echo $line;
	}

}
}




Nablij("./data2.dat");
echo "</td></tr>";
Nablij("./data.dat");
echo "</td></tr>";
echo "<tr><td rowspan=\"2\"><a name=old>
<h2>Pekeln� star� VVopice</h2> (bacha, po�ad� je opa�n� ne� u bal�ku mlad��ch vvopic a nechce se mi s tim sr�t)
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
<h2>Konec a poh�dky je zvonec</h2> (p�kn� pruda tohle d�lat, u� asi ale nikdy nebudu. btw, pokud se zesere DB verze, z�lohy nebudou:-) )
</td></tr>
</table>
<br /><br /><br />

</div>
</body>
</html>