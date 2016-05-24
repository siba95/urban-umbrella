<?php
//更新ユーザー情報
if(!empty($_POST["userId"])){
	$userId = htmlspecialchars($_POST["userId"], ENT_QUOTES, "UTF-8");
	$sql = "SELECT * FROM user_info WHERE user_id = '$userId'";

	//DB接続呼び出し
	require_once 'db_connect.php';
	$dbClass = new Postgres();
	$userResult = $dbClass->selectUser($sql);
	$row = pg_fetch_array($userResult);
	//var_dump($row);
	//変数に配列割り当て
	$name = $row["name"];
	$kana = $row["kana"];
	$gender = $row["gender"];
	$birth = $row["birth"];
	$exp = $row["exp"];
	$station = $row["station"];
	$address = $row["address"];
	$academic = $row["academic"];
	$license = $row["license"];
	$userId = $row["user_id"];

	//エラー項目初期化
	$errorname = "";
	$errorkana = "";
	$errorbirth = "";
	$errorexp = "";
	$errorstation = "";
	$erroraddress = "";
	$erroracademic = "";
	$errorlicense = "";
}else{
	//新規登録
	$name = "";
	$kana = "";
	$gender = "";
	$birth = "";
	$exp = "";
	$station = "";
	$address = "";
	$academic = "";
	$license ="";
	$userId = "";
	//エラー項目初期化
	$errorname = "";
	$errorkana = "";
	$errorbirth = "";
	$errorexp = "";
	$errorstation = "";
	$erroraddress = "";
	$erroracademic = "";
	$errorlicense = "";

}

if(!empty($_POST["error"])){
	//エラーで帰ってきた
	$name = $_POST["name"];
	$kana = $_POST["kana"];
	$gender = $_POST["gender"];
	$birth = $_POST["birth"];
	$exp = $_POST["exp"];
	$station = $_POST["station"];
	$address = $_POST["address"];
	$academic = $_POST["academic"];
	$license = $_POST["license"];
	if(!empty($_POST["errorname"])){$errorname = true;}else{$errorname="";}
	if(!empty($_POST["errorkana"])){$errorkana = true;}else{$errorkana="";}
	if(!empty($_POST["errorbirth"])){$errorbirth = true;}else{$errorbirth = "";}
	if(!empty($_POST["errorexp"])){$errorexp = true;}else{$errorexp = "";}
	if(!empty($_POST["errorstation"])){$errorstation = true;}else{$errorstation="";}
	if(!empty($_POST["erroraddress"])){$erroraddress = true;}else{$erroraddress="";}
	if(!empty($_POST["erroracademic"])){$erroracademic = true;}else{$erroracademic = "";}
	if(!empty($_POST["errorlicense"])){$errorlicense = true;}else{$errorlicense="";}
}
//エラーチェック用php
	require_once 'id_errorChk.php';
?>