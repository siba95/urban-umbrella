<?php
if(!empty($_POST["idSubmit"])){
	//特殊文字HTMLエンティティ変換
	$name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
	$kana = htmlspecialchars($_POST["kana"], ENT_QUOTES, "UTF-8");
	$gender = htmlspecialchars($_POST["gender"], ENT_QUOTES, "UTF-8");
	$birth = htmlspecialchars($_POST["birth"], ENT_QUOTES, "UTF-8");
	$exp = htmlspecialchars($_POST["exp"], ENT_QUOTES, "UTF-8");
	$station = htmlspecialchars($_POST["station"], ENT_QUOTES, "UTF-8");
	$address = htmlspecialchars($_POST["address"], ENT_QUOTES, "UTF-8");
	$academic = htmlspecialchars($_POST["academic"], ENT_QUOTES, "UTF-8");
	$license = htmlspecialchars($_POST["license"], ENT_QUOTES, "UTF-8");

	//改行コード
	$license = str_replace(array("\r\n","\r","\n"), "\n", $license);

	//入力値チェック
	//氏名30文字以下
	if(mb_strlen($name) > 30){
		echo "<script> alert('氏名が長すぎます。'); </script>";
		$error = true;
		$errorname = true;
	}
	//フリガナ30文字以下
	if(mb_strlen($kana) > 30){
		echo "<script> alert('フリガナが長すぎます。'); </script>";
		$error = true;
		$errorkana = true;
	}
	//年齢14歳以上80歳以下
	$now = date("Ymd");
	$birthday = str_replace("-","",$birth);
	$old = floor(($now-$birthday)/10000);
	if(14>$old or 80<$old){
		echo "<script> alert('生年月日の値が異常です。');</script>";
		$error = true;
		$errorbirth = true;
	}
	//職歴50年以下
	$dateexp = str_replace("-","",$exp);
	$expday = floor(($now-$dateexp)/10000);
	if( 50 < $expday){
		echo "<script> alert('職歴開始年月日の値が異常です。');</script>";
		$error = true;
		$errorexp = true;
	}
	//最寄り駅30文字以下
	if(mb_strlen($station) > 30){
		echo "<script> alert('最寄り駅の値が長すぎます。');</script>";
		$error = true;
		$errorstation = true;
	}
	//現住所60文字以下
	if(mb_strlen($address) > 60){
		echo "<script> alert('現住所の値が長すぎます。');</script>";
		$error = true;
		$erroraddress = true;
	}
	//学歴30文字以下
	if(mb_strlen($academic) > 30){
		echo "<script> alert('学歴の値が長すぎます。'); </script>";
		$error = true;
		$erroracademic = true;
	}
	//資格100文字以下
	if(mb_strlen($license) > 100){
		echo "<script> alert('資格の値が長すぎます。');</script>";
		$error = true;
		$errorlicense = true;
	}

	//エラーがあれば入力情報とエラー項目をPOST
	if(!empty($error)){
		echo "<html><body><form name='con-update' method='POST' action='id-form.php'>";
		echo "<input type='hidden' name='error' value='true'>
				<input type='hidden' name='name' value='".$_POST["name"]."'>
				<input type='hidden' name='kana' value='".$_POST["kana"]."'>
				<input type='hidden' name='gender' value='".$_POST["gender"]."'>
				<input type='hidden' name='birth' value='".$_POST["birth"]."'>
				<input type='hidden' name='exp' value='".$_POST["exp"]."'>
				<input type='hidden' name='station' value='".$_POST["station"]."'>
				<input type='hidden' name='address' value='".$_POST["address"]."'>
				<input type='hidden' name='academic' value='".$_POST["academic"]."'>
				<input type='hidden' name='license' value='".$_POST["license"]."'>
				<input type='hidden' name='update-user' value='".$userId."'>";
		if($errorname){echo "<input type='hidden' name='errorname' value='true'>" ;}
		if($errorkana){echo "<input type='hidden' name='errorkana' value='true'>" ;}
		if($errorbirth){echo "<input type='hidden' name='errorbirth' value='true'>" ;}
		if($errorexp){echo "<input type='hidden' name='errorexp' value='true'>" ;}
		if($errorstation){echo "<input type='hidden' name='errorstation' value='true'>" ;}
		if($erroraddress){echo "<input type='hidden' name='erroraddress' value='true'>" ;}
		if($erroracademic){echo "<input type='hidden' name='erroracademic' value='true'>" ;}
		if($errorlicense){echo "<input type='hidden' name='errorlicense' value='true'>" ;}
		echo "</form><script>document.error.submit();</script></body></html>";
	}else{
		if(!empty($_POST["userId"])){
			//userIdを保持しているならUPDATE
			$id = $_POST["userId"];
			$sql = "UPDATE user_info SET name = '$name', kana = '$kana', gender = '$gender', birth = '$birth',exp = '$exp',
			station = '$station',address = '$address', academic = '$academic', license = '$license' WHERE user_id = '$userId'";
			//DB呼び出し
			require_once 'db_connect.php';
			$dbClass = new Postgres();
			$userResult = $dbClass->updateUser($sql);
		}else{
			//保持していないならINSERT
			$sql ="INSERT INTO user_info (user_id,name,kana,gender,birth,exp,station,address,academic,license)
			VALUES ((SELECT COALESCE (MAX(user_id),0) FROM user_info)+1,'$name', '$kana', '$gender', '$birth', '$exp', '$station', '$address', '$academic', '$license')";
			//DB呼び出し
			require_once 'db_connect.php';
			$dbClass = new Postgres();
			$userResult = $dbClass->insertUser($sql);
		}

	}
}