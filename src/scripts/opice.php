<?php
include "../connectdb.php";

function GetMaxItemid($slovdruh){
  $r = mysql_query("SELECT Max(itemid) FROM opo WHERE slovnidruh = '$slovdruh'")or die("unable to comply : maxitemid");
	if (mysql_fetch_row($r))
	  $maxid = mysql_result($r, 0);
return $maxid;
}

function GetWord($slovdruh, $id){
  $resultx = mysql_query("SELECT slovo, rodpodst FROM opo WHERE slovnidruh = '$slovdruh' AND itemid = '$id' ;")or die("unable to comply: vybirani opicoidu");

    $rowbl = mysql_fetch_row($resultx);
    if ($slovdruh == 1)
      $ret = $rowbl[0] . $rowbl[1];
    else $ret = $rowbl[0];
return $ret;
}

$a = rand(1, GetMaxItemid(1));
$b = rand(1, GetMaxItemid(2));
$c = rand(1, GetMaxItemid(6));
$podstret = GetWord(1, $a);
$rodd = substr($podstret, -1);
$podst = substr($podstret, 0, -1);
$prid = GetWord(2, $b);
if($rodd == 2) $prid .= "á";
if($rodd == 3) $prid .= "é";
if($rodd == 1){
  if(substr($prid, -1) == "c" || substr($prid, -1) == "j") $prid .= "í";
  else $prid .= "ý";
}
//echo $c ." ". $b ." ". $a;    ?tst=1
//header("Location: ". $_SERVER['SCRIPT_URI']);
if($tst){
echo GetWord(6, $psl) ." ". GetWord(2, $pri) ." ". GetWord(1, $pod);
echo "<br /> " . $psl . ", " . $pri . ", " . $pod . "<br />";
//header("Location: ". $_SERVER['SCRIPT_URI']);   SCRIPT_URI
}else{
echo GetWord(6, $c) ." ". $prid ." ". $podst;
echo "<br /> " . $c . ", " . $b . ", " . $a . "<br />";
}

echo "<a href=\"{$_SERVER['PHP_SELF']}\" title=\"nahodny los\">Zkusit nahodnou trojici</a>";
?>
<html>
<head>
<meta http-equiv="content-type" content="html/css; charset=utf-8" />
<meta http-equiv="cache-control" content="public" />
<title>testing generatoru</title>
</head>
<body>
<form action="opice.php" method="get">
6: <input type="text" name="psl" />
2: <input type="text" name="pri" />
1: <input type="text" name="pod" />
<input type="hidden" name="tst" value="true">
<input type="submit" value="test">
</form>
</body>
</html>

