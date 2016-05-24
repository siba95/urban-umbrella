<?php
if(!empty($_POST["updateBio"])){
	//更新
	$bioId = $_POST["bioId"];
	$sql = "SELECT * FROM user_bio WHERE bio_id = '$bioId'";
	//DB
	require_once 'db_connect.php';
	$dbClass = new Postgres();
	$bioResult = $dbClass->selectBio($sql);
	$bioRow = pg_fetch_array($bioResult);
	//変数に割り当て
	$fromDay = $bioRow["from_day"];
	$toDay = $bioRow["to_day"];
	$outline = $bioRow["outline"];
	$os = $bioRow["os"];
	$langu = $bioRow["langu"];
	$other = $bioRow["other"];
	$userId = $bioRow["user_id"];

	//エラー項目初期化
	$errorfrom = "";
	$errorto = "";
	$erroroutline = "";
	$erroros = "";
	$errorlangu = "";
	$errorother = "";


}else{
	//新規
	$fromDay = "";
	$toDay = "";
	$outline = "";
	$os = "";
	$langu = "";
	$other = "";
	$bioId = null;
	if(isset($_POST["user_id"])){
		$userId = $_POST["user_id"];
	}
	//エラー項目初期化
	$errorfrom = "";
	$errorto = "";
	$erroroutline = "";
	$erroros = "";
	$errorlangu = "";
	$errorother = "";

	if(!empty($_POST["error"])){
		//エラーで帰ってきた
		$fromDay = $_POST["from_day"];
		$toDay = $_POST["to_day"];
		$outline = $_POST["outline"];
		$os = $_POST["os"];
		$langu = $_POST["langu"];
		$bioId = null;
		$userId = $_POST["user_id"];
		if(!empty($_POST["errorfrom_day"])){$errorfrom = true;}else{$errorfrom="";}
		if(!empty($_POST["errorto"])){$errorto = true;}else{$errorto="";}
		if(!empty($_POST["erroroutline"])){$erroroutline = true;}else{$erroroutline = "";}
		if(!empty($_POST["erroros"])){$erroros = true;}else{$erroros="";}
		if(!empty($_POST["errorlangu"])){$errorlangu= true;}else{$errorlangu="";}
		if(!empty($_POST["errorother"])){$errorother= true;}else{$errorother="";}
	}
}


//エラーチェック
require_once 'bio_errorChk.php';
?>