<?php
	$pole = array("x","u","d","h","w","l","s","y");
	$rada = isset($_GET['rada'])
		? $_GET['rada']
		: "";

	if(!empty($rada)){
		$ex = "";
		$odbot = $_GET['odbot'];
		foreach($i = str_split($odbot) as $char) {
			if (!is_numeric($char)) {
				echo "Only numeric input allowed!<br />";
				break;
			}
			$ex .= $pole[$char - 1];
		}
		if($ex == $rada) header("Location: ./akce.php");
		echo "Numbers order was different, try again.";
	}

	shuffle($pole);
	$firstRow = '';
	foreach($pole as $jmeno){
		$firstRow .= "<td><img src=\"./ab/$jmeno.png\" /></td>";
	}
	$poleString = implode("", $pole);

	// embed html
	require(__DIR__ . '/abhtml.php');
?>
