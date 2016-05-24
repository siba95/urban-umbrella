<?php
if(isset($_POST["bioUser"])){
	$userId = htmlspecialchars($_POST["bioUser"], ENT_QUOTES, "UTF-8");
	$sql = "SELECT * FROM user_info FULL JOIN user_bio ON user_info.user_id = user_bio.user_id
	 		WHERE user_info.user_id = '$userId' ORDER BY from_day ASC";
	//DB呼び出し
	require_once 'db_connect.php';
	$dbClass = new Postgres();
	$result = $dbClass->selectBio($sql);
	$bioRows = pg_fetch_all($result);

// 	echo "<pre>";
// 	var_dump($bioRows);
// 	echo "</pre>";
	//ユーザ情報
	$name = $bioRows[0]["name"];
	$kana = $bioRows[0]["kana"];
	$gender = $bioRows[0]["gender"];
	$address = $bioRows[0]["address"];
	$station = $bioRows[0]["station"];
	$academic = $bioRows[0]["academic"];
	$license = $bioRows[0]["license"];
	//年齢
	$birthday = str_replace("-","",$bioRows[0]["birth"]);
	$nowyear = date("Y").date("m").date("d");
	$old = floor(($nowyear - $birthday)/10000);
	//職歴
	$exp = str_replace("-","", $bioRows[0]["exp"]);
	$expday =floor(($nowyear - $exp)/10000);
	if($expday < 1){
		$expday = "1年未満";
	}else{
		$expday = $expday."年";
	}
}