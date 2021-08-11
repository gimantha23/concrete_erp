<?php
session_start();
	include('db_connect.php');
	
	$return_arr = array();
	$search = mysqli_real_escape_string($con,$_GET['term']);

	$fetch = mysqli_query($con, "SELECT * FROM customers WHERE customer_name LIKE '%$search%' OR company_name LIKE '%$search%'"); 
	while ($row = mysqli_fetch_array($fetch, MYSQLI_BOTH)) {
		$row_array['value']	= $row['customer_name']." - ".$row['company_name'];
		$row_array['cus_id'] = $row['id'];
		$row_array['phone'] = $row['telephone'];
		$row_array['address'] = $row['site_address'];
        array_push($return_arr, $row_array);
    }
	echo json_encode($return_arr);
?>