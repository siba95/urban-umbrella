<?php
//errorChk
if(!empty($_POST["bioSubmit"])){
	//特殊文字HTMLエンティティ変換
	$fromDay = htmlspecialchars($_POST["from_day"], ENT_QUOTES, "UTF-8");
	$toDay = htmlspecialchars($_POST["to_day"], ENT_QUOTES, "UTF-8");
	$outline = htmlspecialchars($_POST["outline"], ENT_QUOTES, "UTF-8");
	$os = htmlspecialchars($_POST["os"], ENT_QUOTES, "UTF-8");
	$langu = htmlspecialchars($_POST["langu"], ENT_QUOTES, "UTF-8");
	$other = htmlspecialchars($_POST["other"], ENT_QUOTES, "UTF-8");
	$userId = htmlspecialchars($_POST["userId"], ENT_QUOTES, "UTF-8");

	$other = nl2br($other);
	$outline = nl2br($outline);

	//入力値チェック
	$now = date("Ymd");
	$from = str_replace("-", "", $fromDay);
	if($from < 19411208 ){
		echo "<script> alert('作業開始年月日が古すぎます。');</script>";
		$error = true;
		$errorfrom = true;
	}
	$ago = $now + 100000;
	$to = str_replace("-","",$toDay);
	if($to > $ago){
		echo "<script> alert('作業終了予定が先過ぎます。');</script>";
		$error = true;
		$errorto = true;
	}
	if(mb_strlen($outline) > 100){
		echo "<script> alert('作業内容が長すぎます。');</script>";
		$error = true;
		$erroroutline = true;
	}
	if(mb_strlen($os) > 30){
		echo "<script> alert('機器・OSの値が長すぎます。');</script>";
		$error = true;
		$erroros = true;
	}
	if(mb_strlen($langu) > 30){
		echo "<script> alert('言語・ツールの値が長すぎます。');</script>";
		$error = true;
		$errorlangu = true;
	}
	if(mb_strlen($other) > 100){
		echo "<script> alert('備考が長すぎます。');</script>";
		$error = true;
		$errorother = true;
	}
	if(!empty($error)){
		echo "<html><body><form name='error' method='POST' action='Bioform.php'>";
		echo "<input type='hidden' name='error' value='true'>
				<input type='hidden' name='from_day' value='".$fromDay."'>
				<input type='hidden' name='to_day' value='".$toDay."'>
				<input type='hidden' name='outline' value='".$outline."'>
				<input type='hidden' name='os' value='".$os."'>
				<input type='hidden' name='langu' value='".$langu."'>
				<input type='hidden' name='other' value='".$other."'>
				<input type='hidden' name='user_id' value='".$userId."'>";
		if($errorfrom){echo "<input type='hidden' name='errorfrom_day' value='true'>" ;}
		if($errorto){echo "<input type='hidden' name='errorto' value='true'>" ;}
		if($erroroutline){echo "<input type='hidden' name='erroroutline' value='true'>" ;}
		if($erroros){echo "<input type='hidden' name='erroros' value='true'>" ;}
		if($errorlangu){echo "<input type='hidden' name='errorlangu' value='true'>" ;}
		if($errorother){echo "<input type='hidden' name='errorother' value='true'>" ;}
		echo "</form><script>document.error.submit();</script></body></html>";
	}else{
	//エラーがなければDB接続
		if(!empty($_POST["bioId"])){
			//bioIdを保持しているならupdate
			$bioId = $_POST["bioId"];
			$userId = $_POST["userId"];
			$sql = "UPDATE user_bio SET bio_id = '$bioId', from_day = '$fromDay', to_day = '$toDay', outline = '$outline',
					os = '$os', langu = '$langu',user_id = '$userId',other = '$other' WHERE bio_id = '$bioId'";
			//DB
			require_once 'db_connect.php';
			$dbClass = new Postgres();
			$result = $dbClass->updateBio($sql);
		}else{
			//insert
			$userId = $_POST["userId"];
			$sql = "INSERT INTO user_bio (bio_id,from_day,to_day,outline,os,langu,other,user_id)
			VALUES ((SELECT COALESCE (MAX(bio_id),0) FROM user_bio)+1,'$fromDay','$toDay', '$outline', '$os', '$langu', '$other', '$userId')";
			//DB
			require_once 'db_connect.php';
			$dbClass = new Postgres();
			$result = $dbClass->insertBio($sql);

		}
	}

}