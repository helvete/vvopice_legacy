<?php
	$vysl = mysql_query("SELECT Max(time) FROM forum;")
		or die("unable to comply"); //zjisteni posledniho data
	if (mysql_fetch_row($vysl)) $lastdate = mysql_result($vysl, 0);

	// pokud nic nezadame, predpokladame vypis prispevku za posl. 14 dni
	if(empty($int)) $int = 14;
	//pokud si neco vybereme, i to vypiseme jako hlasku
	else {
		$int = $int + 0;
		echo "<span class=\"gruen\">zobrazeny příspěvky za " . $int
			. " dní: <a href=\"index.php\">(zrušit filtr)</a></span><br />
			<br />";
	}
  $rrr = Akce();
  if(mysql_num_rows($rrr)>0) PrintPosts($rrr, true);
  echo "<br />";
	if (empty($searching)){
		$result = mysql_query(
			"SELECT * FROM forum WHERE time > DATE_SUB('$lastdate' ,INTERVAL '$int' DAY) ORDER BY time DESC ;"
		)or die("unable to comply");

    PrintPosts($result, false);
	} else {
		if(stristr($searched, '<script')
			|| stristr($searched, htmlentities('<script')))
 	 	{
    	header("Location: ". $_SERVER['SCRIPT_URI']);
    	die();
    }
		$result = mysql_query(
			"SELECT * FROM forum WHERE (text LIKE '%$searched%') OR (name LIKE '%$searched%') ORDER BY time DESC ;"
		)or die("unable to comply");
		echo "<span class=\"gruen\">zobrazeny příspěvky obsahující řetězec \""
			. $searched . "\": <a href=\"index.php\">(zrušit filtr)</a></span>
			<br /><br />";
		PrintPosts($result, false);
	}

	function PrintPosts($stream, $akce){
		while ($row = mysql_fetch_array($stream, MYSQL_NUM)) {
			if($row[3] == "false") continue;
    	else{
		  	//odstraneni bugu "<br </a>/>"
		  	$row[2]= ereg_replace("<br />", " <br /> ", $row[2]);

		  	//vyroba odkazu z retezcu
				if (strlen(strstr($row[2], "http")) > 0){
		  		$row[2]= ereg_replace(
					"(http[^ ]+\.[^ ]+)",
					" <a target=\"_blank\" href=\"\\1\">\\1 </a> ", $row[2]);
				}else{
		  		$row[2]= ereg_replace(
					"(www\.[^ ]+\.[^ ]+)",
					" <a target=\"_blank\" href=\"http://\\1\">\\1 </a> ", $row[2]);
				}

				$colourify = array(
					".jpeg" => "pic",
					".jpg" => "pic",
					".png" => "pic",
					".gif" => "anim",
					"stream.cz" => "video",
					"vimeo" => "video",
					"youtube" => "video",
					"youtu.be" => "video",
					"you.tube" => "video");

				$postWords = explode(" ", $row[2]);
				foreach($postWords as &$word){
					if (preg_match('/>http/', $word)) {
						$chunks = explode('>http', $word);
						$final = $chunks[0] . ">http";
						$final .= strlen($chunks[1]) > 96
							? substr($chunks[1], 0, 96) . "..."
							: $chunks[1];
						$word = $final;
					}
					if(count(explode("href", $word)) > 1){
						foreach($colourify as $grep => $class){
							if(count(explode($grep, $word)) > 1){
								$word = "class=\"$class\" " . $word;
								break;
							}
						}
					}
				}
				$row[2] = implode(" ", $postWords);

	  		if($akce) {
      		$barvicka = "gruen";
      		$dat = "akce začne: ";
      		$str3 = "color: white;";
    		}
    		else {
      		$barvicka = "";
      		$dat = "";
			$str3 = "";
    		}
 	  		echo "<table class=\"posts ". $barvicka ."\"><tr class=\"st\" id=\""
					. strtotime($row[0]) . "\"><td class=\"name\" style=\""
					. $str3 ."\">" .$row[1]. "</td><td class=\"date\" style=\"". $str3
					."\">" . $dat . $row[0]
					. "</td></tr><tr><td colspan=\"2\" class=\"nd\"> "
					. html_entity_decode($row[2], ENT_QUOTES, 'UTF-8')
					. "</td></tr></table> <br />";
			}
    }//</td><td border=\"1\" class=\"ip\">" . $row[3] . "</td>
	}

  function Akce(){
    $result = mysql_query(
			"SELECT * FROM forum_action ORDER BY time DESC LIMIT 3;"
	  )or die("unable to comply - jeakce");

  return $result;
  }

?>
