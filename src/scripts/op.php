<?php
include "../connectdb.php";
$sent = $dva = $sest = $jedna = null;
$inputVars = array_merge($_GET, $_POST);
foreach($inputVars as $key => $val){
	if(!empty($key)) $$key = $val;
}

if(($sent && ($jak != "" || $jaky != ""))|| $sent && $co != "" && $rod != ""){
      if($jaky != "") ins($jaky, "2");
      if($jak != "") ins($jak, "6");
      if($co != "" && $rod != ""){
        $pivo = "1" . $rod;
        ins($co, $pivo);
      }
      header('Location: '. $_SERVER['PHP_SELF']);
    }
?>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title></title>
  </head>
  <body>
  <h1 style="margin: 10px;">vvopici generator anonymu - plneni</h1>
  <h3 style="margin: 10px;">vlozit nova slova do databaze generatoru:</h3>
  <div style="margin: 10px;">
    <h4>mozno vyplnovat: i vsechna slova zaraz, i po jednom<br />u podstatneho jmena nutno uvest rod, jinak se neprida do DB<br />nelekejte se chybejicich poslednich pismen pridavnych jmen v zobrazeni, piste je normalne! - je to kvuli sklonovani<br />piste uplne libovolny slova, ale SLOVA, zadny "hsdfhasdf" atp. dik</h4>
    <form action="op.php" method="post">
    prislovce: <input type="text" name="jak" /><br />
    pridavne jmeno: <input type="text" name="jaky" /><br />
    podstatne jmeno: <input type="text" name="co" /><br />
    <u>rod podstatneho jmena:</u><br />
     <input type="radio" name="rod" value="1" /> muzsky
     <input type="radio" name="rod" value="2" /> zensky
     <input type="radio" name="rod" value="3" /> stredni<br />
    <input type="hidden" name="sent" value="true">
    <input type="submit" value="pridat">
    </form>
  </div>
  <a href="./opice.php" title="otestovat generator slov">Vygenerovat nahodnou kombinaci</a><br />
  <?php
    function GetMaxItemId($ceho){
      $resulty = mysql_query("SELECT Max(itemid) FROM opo WHERE slovnidruh = '$ceho' ;")or die("chyba v sql dotazu na maxitemid");
      if (mysql_fetch_row($resulty)) $maxitemid = mysql_result($resulty, 0);
      for($i = 1; $i < $maxitemid + 1; $i++){
        $test = mysql_query("SELECT slovo FROM opo WHERE slovnidruh = '$ceho' AND itemid = '$i' ;")or die("chyba v sql dotazu na maxitemid");
        if(mysql_fetch_row($test) && strlen(mysql_result($test, 0)) > 0) {
          continue;
        }
        else{
          $maxitemid = $i - 1;
          break;
        }
      }
      return $maxitemid;
      }


    function ins($neco, $wtf){
      if(strlen($wtf)>1){
        $slovdruh = substr($wtf, 0, 1);
        $rdd = substr($wtf, -1);
      }elseif($wtf == 6){
        $slovdruh = $wtf;
        $rdd ="";
      }elseif($wtf == 2){
        $neco = substr($neco, 0, -2);
        $slovdruh = $wtf;
        $rdd ="";
      }
      $zelena = GetMaxItemId($slovdruh) + 1;            //
      mysql_query("INSERT INTO opo(slovo, slovnidruh, rodpodst, itemid) VALUES('$neco', '$slovdruh', '$rdd', '$zelena')")or die('neco spatne v sql query (insert)!');
    }
    /*
    if($updated){
      //$resultUpd = mysql_query("SELECT COUNT(*) FROM opo")or die("chyba v sql dotazu na maxitemid");
      $resultUpd = mysql_result(mysql_query("SELECT COUNT(*) FROM opo"), 0);

      echo $resultUpd;
      for($index = 0; $index< $resultUpd; $index++){
        $temp = "inp".($index+1);
        //echo $temp . " " . $$temp. '<br />';
        mysql_query("UPDATE opo SET slovo = " . $$temp . " WHERE slovo = '$index' ;")or die('neco spatne v sql query (update)!');
        //$index++;
      }
    }
    */

    $stream = mysql_query("SELECT * FROM opo ORDER BY itemid ASC;")or die("chyba v sql dotazu na vypis vseho");
    echo "<h3 style=\"margin: 10px;\">jiz vlozena slova do databaze generatoru:</h3><table border=\"0\" style=\"margin: 10px;\">";
    while ($row = mysql_fetch_array($stream, MYSQL_NUM)) {
      if($row[1] == 1) $jedna++;
      if($row[1] == 2) $dva++;
      if($row[1] == 6) $sest++;
    }
    echo "<h4>v databazi prave ulozeno: <span style=\"color: green\">". $jedna ."</span> podstatnych jmen, <span style=\"color: green\">" . $dva . "</span> pridavnych jmen a <span style=\"color: green\">". $sest ."</span> prislovcu</h4><form action=\"op.php\" method=\"post\" >";
    $stream = mysql_query("SELECT * FROM opo ORDER BY itemid ASC;")or die("chyba v sql dotazu na vypis vseho");
    while ($row = mysql_fetch_array($stream, MYSQL_NUM)) {
      echo "<tr><td><input type=\"text\" name=\"inp" . $row[3] . "\" value=\"" . $row[0] . "\" /></td><td> " . $row[1] . "</td></tr>";
    }
    echo "</form>";
    //  . strlen($jaky) <input type=\"hidden\" name=\"updated\" value=\"true\"><input type=\"submit\" value=\"upravit stavajici\">
  ?>
  </body>
</html>
