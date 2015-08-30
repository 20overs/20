<?php
include "config.php";
$user = $_POST['user'];$pass = $_POST['pass'];

header('Content-Type: application/json');
if($user != "" && $pass != ""){
	$sql = mysqli_query($con,"select * from mobile_user where username = '".$user."' and password = '".md5($pass)."'");
	if($sql){
		$count = mysqli_num_rows($sql);
			if($count > 0){
				$out = array('error'=>0,'message'=>'Login success','hash'=>md5(time()));
			}else{
				$out = array('error'=>1,'message'=>'Invalid datas');
			}
		}else{
			$out = array('error'=>1,'message'=>'Server error');
		}
}else{
	$out = array('error'=>1,'message'=>'Fill all fields');
}

echo json_encode($out);
?>