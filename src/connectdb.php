<?php
	mysql_pconnect("db-host", "db-user", "db-password") or die("unable to access the database");
	mysql_select_db("db-name") or die("unable to select the database");
?>
