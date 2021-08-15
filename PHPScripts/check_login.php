<?php
include('db_connect.php');
session_start();
if(isset($_POST['btnSubmit'])){
	$username = $_POST["username"];
	$password = $_POST["password"];

		$check_user = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '".$username."'");
		if(mysqli_num_rows($check_user)>0){
			$check_active = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '".$username."' AND `active`='yes'");
			if(mysqli_num_rows($check_active)>0){
				$check_password = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '".$username."' AND `password`='".$password."'");
				if(mysqli_num_rows($check_password)>0){
					$check_password_res = mysqli_fetch_array($check_password);
					$_SESSION["user_id"] = $check_password_res["user_id"];
					$_SESSION["user_type"] = $check_password_res["user_type"];
					header('Location:../Pages/dashboard.php');
				}else{
					$_SESSION["error"] = "Invalid Password";
					header('Location:../Pages/index.php');
				}
			}else{
				$_SESSION["error"] = "Account deactivated. Please contact your manager";
				header('Location:../Pages/index.php');
			}
		}else{
			$_SESSION["error"] = "Invalid Username";
			header('Location:../Pages/index.php');
		}
		mysqli_close($con);
}
?>