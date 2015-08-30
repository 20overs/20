<?php
include "config.php";

$newsString = $_POST['news'];
$newsCategory = $_POST['newsCategory'];

header('Content-Type: application/json');
if($newsString != "" and $newsCategory != ""){
$sql = mysqli_query($con,"INSERT INTO `20overs_News`(`NewsCategory`, `News`, `NewsPostedBy`, `NewsPriority`, `NewsPostedFrom`, `NewsURL`, `NewsPostedOn`)"
."VALUES ('$newsCategory','$newsString','',0,'','',NOW())");
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