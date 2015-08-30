<?php
include "config.php";
$user = $_POST['user'];$pass = $_POST['pass'];

header('Content-Type: application/json');
if($user != "" and $pass != ""){
$sql = mysqli_query($con,"insert into users(user,pass) values('".$user."','".md5($pass)."')");
	if($sql){
		$out = array('error'=>0,'message'=>'Data inserted successfully');
	}else{
		$out = array('error'=>1,'message'=>'Server error');
	}
}else{
	$out = array('error'=>1,'message'=>'Fill all field');
}
echo json_encode($out);
?>