<?php
$jak = array( "mocně ", "pracně ", "hrubě ", "dekadentně ", "bizarně " );
$jaky = array( "vykalený ", "vyhulený ", "zmařený ", "rozprasený ", "smradlavý " );
$kdo = array( "makak", "šimpanz", "orangutan", "gibon", "pavián" );


echo $jak[rand(0,4)] . $jaky[rand(0,4)] . $kdo[rand(0,4)];
?>
