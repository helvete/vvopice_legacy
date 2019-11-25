<?php
$edit = $deactivate = $activate = $text = $sent = $na = $te = $tri = null;

include "connectdb.php";

function Akce(){
  $result = mysql_query("SELECT * FROM forum_action ORDER BY time DESC;")or die("unable to comply - jeakce");
  return $result;
}
function mres($q) {
  if(is_array($q))
    foreach($q as $k => $v)
      $q[$k] = mres($v); //recursive
  elseif(is_string($q))
    $q = mysql_real_escape_string($q);
return $q;
}
function DeScript($bsah){
  $huhu = strlen($bsah);                                               // huhu je delka retezce zpravy
  for($indian = 0; $indian < ($huhu * 2); $indian++){                  // cyklus do delky (retezce zpravy * 2)
    if($indian % 2 && $indian != 0) $descriptor .= $bsah[$indian / 2]; // kdyz je index nenulovy sudy, vlozime znak z prispevku
    else $descriptor .= " ";                                           // jinak vlozime mezeru
  }
  $bsah = "attempt to insert script detected! IP logged & banned..\n" . $descriptor; // + povidani na zacatek;-)
return $bsah;
}

function Toggle($actname, $deakt){
  if($deakt == true){
    mysql_query("UPDATE forum_action SET ip = 'false' WHERE name = '$actname' ")or die("<script>alert('update');</script>");
    $cas = Date("Y-m-d H:i:s");
    mysql_query("INSERT INTO forum_bu(time, co) VALUES('" . $cas . "', '" . $actname . "')")or die("bu");
  }
  elseif($deakt == false)
  mysql_query("UPDATE forum_action SET ip = 'true' WHERE name = '$actname' ")or die("<script>alert('update');</script>");
}



$_GET = mres($_GET);
$_POST = mres($_POST);
$rpt = Akce();
$inputVars = array_merge($_GET, $_POST);
foreach($inputVars as $key => $val){
	if(!empty($key)) $$key = $val;
}

if($edit){
  while ($row = mysql_fetch_array($rpt, MYSQL_NUM)){
    if($row[0] == $edit){
      $na = $row[1];
      $te = $row[2];
	  $datum = implode("-", explode(":", $row[0]));
	  $datum = implode("-", explode(" ", $datum));
	  $datum = explode("-", $datum);
      break;
    }
  }
  $tri = $edit;
}


if($deactivate){
  Toggle($deactivate, true);
  header('Location: '. $_SERVER['PHP_SELF']);
}
if($activate){
  Toggle($activate, false);
  header('Location: '. $_SERVER['PHP_SELF']);
}

if ($text && !$sent){

  if(stristr($text, '<script') || stristr($text, htmlentities('<script'))) { $text = DeScript($text);}
  $cas = $rok ."-". $mesic ."-". $den ." ". $hodina .":00:00"; // doplnit!
  mysql_query("INSERT INTO forum_action(time, name, text, ip) VALUES('" . $cas . "', '" . $jmeno . "', '" . htmlentities(str_replace( array("\\r\\n", "\\n", "\\r"), " <br /> ", $text), ENT_QUOTES, "UTF-8") . "', 'true')")or die();
  header('Location: '. $_SERVER['PHP_SELF']);

}elseif ($sent){

  if(stristr($text, '<script') || stristr($text, htmlentities('<script'))) { $text = DeScript($text);}
  $cas = $rok ."-". $mesic ."-". $den ." ". $hodina .":00:00"; // doplnit!
  mysql_query("UPDATE forum_action SET name = '$jmeno', text='" . htmlentities(str_replace( array("\\r\\n", "\\n", "\\r"), " <br /> ", $text), ENT_QUOTES, "UTF-8") . "', time = '$cas'  WHERE time='$sent' ")or die();
  header('Location: '. $_SERVER['PHP_SELF']);



}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
  <head>
  <link rel="stylesheet" href="vvopdev.css" type="text/css"  media="screen" />
  <meta http-equiv="content-type" content="html/css; charset=utf-8" />
  <meta name="robots" content="noindex, nofollow" />
  </head><body>

<?php
for ($i = 0; $i < 4; $i++) {
	$datum[$i] = empty($datum[$i]) ? "" : $datum[$i];
}
echo "<div style=\"width: 600px; margin: 15px; text-align: left\"><h1>Správa akcí</h1><br /><form name=\"akceform\" id=\"form\" method=\"post\" action=\"akce.php\">
<label>název akce: <input type=\"text\" class=\"inputtext\" name=\"jmeno\" value=\"". $na ."\" /></label><br /><br />
<textarea name=\"text\" id=\"te\">". str_replace("<br />", "\n", $te) ."</textarea><br /><br />
začátek akce: rok <input type=text class=\"hled\" name=\"rok\" value=\"".
  $datum[0] ."\" >
měsíc <input type=text class=\"dny\" name=\"mesic\" value=\"".
  $datum[1] ."\" >
den <input type=text class=\"dny\" name=\"den\" value=\"".
  $datum[2] ."\" >
hodina <input type=text class=\"dny\" name=\"hodina\" value=\"".
  $datum[3] ."\" >
<br />(datum a čas pište prosím pomocí čísel, čas bez minut)
<input type=hidden value=\"". $tri ."\" name=\"sent\">
<input type=submit value=\"poslat\" class=\"submit\">
</form></div>";



//

echo "<table border=1 style=\"width: 98%\"><tr><td><b>jmeno akce:</b></td><td><b>datum konani:</b></td><td><b>text:</b></td><td><b>zmeny:</b></td><td><b>zobrazit?</b></td><td><b>upravit</b></td></tr>";
$incre = 0;
mysql_data_seek($rpt, 0);
while ($row = mysql_fetch_array($rpt, MYSQL_NUM)){
  if($incre < 3) $strr = "class=\"gruen\"";
  echo "<tr><td ". $strr ." >". $row[1] ."</td><td>". $row[0] ."</td><td>". html_entity_decode($row[2], ENT_QUOTES, 'UTF-8') ."</td><td><a href=\"" . $_SERVER['SCRIPT_URI'] . "?deactivate=". $row[1] ."\" title=\"zrusit zobrazeni akce\">deaktivace</a><br /><a href=\"" . $_SERVER['SCRIPT_URI'] . "?activate=". $row[1] ."\" title=\"nastavit zobrazeni akce\">aktivace</a></td><td>". $row[3] ."</td><td><a href=\"" . $_SERVER['SCRIPT_URI'] . "?edit=". $row[0] ."\" title=\"zmenit vlastnosti akce\">uprava</a></td></tr>";
  $incre++;
}
echo "</table>";


?>
</body></html>
