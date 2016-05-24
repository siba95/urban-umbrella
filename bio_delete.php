<?php
if(!empty($_POST["delete"])){
	$userId = htmlspecialchars($_POST["userId"], ENT_QUOTES, "UTF-8");
	$bioId =htmlspecialchars($_POST["bioId"], ENT_QUOTES, "UTF-8");
	$sql = "DELETE FROM user_bio WHERE bio_id = '$bioId'";

	require_once 'db_connect.php';
	$dbClass = new Postgres();
	$userResult = $dbClass->deleteBio($sql);

}
?>