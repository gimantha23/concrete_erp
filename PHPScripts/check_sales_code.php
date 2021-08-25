<?php
session_start();
$sales_code = $_POST['sales_code'];
require("db_connect.php");

$sel_code = mysqli_query($con, "SELECT * from sales_code WHERE sales_code_prefix='$sales_code'");
if(mysqli_num_rows($sel_code)>0){
    echo "duplicate";
}else{
    echo "ok";
}
?>