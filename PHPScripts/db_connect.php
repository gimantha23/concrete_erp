<?php

	$db_host = "localhost";
	$db_user = "root";
	$db_password = "";
	$db_database = "erp_dev_database";

	//Infinityfree
	// $db_host = "sql100.epizy.com";
	// $db_user = "epiz_29447590";
	// $db_password = "jrUtfcttkF";
	// $db_database = "epiz_29447590_erp_dev_database";

	// aeon
	// $db_host = "sql100.hstn.me";
	// $db_user = "mseet_29599997";
	// $db_password = "jecE4t50WaXV";
	// $db_database = "mseet_29599997_prema_db";
	
	$con = mysqli_connect($db_host,$db_user,$db_password, $db_database);

?>