<?php
require_once 'delete_user.php';
session_start();
//if,POSTされていたらSESSIONに保持(name-address-searchの３つ)
//SESSIONがnullなら何も出さないよ

//入場確認
if(!empty($_POST["search-submit"])){
	$name = $_POST["name"];
	$address = $_POST["address"];
	$_SESSION["name"] = $name;
	$_SESSION["address"] = $address;
	$_SESSION["Search"] = true;
}else{
	$name = "";
	$address = "";
	$_SESSION["Search"] = NULL;
}
if($_SESSION){
	echo"二度目以降";
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=Shift_JIS" />
	<title>検索画面</title>
	<!-- JS -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="jQuery/jquery.js" type="text/javascript"></script>
	<script>
	function submitChk ()
	{/* 確認ダイアログ表示 */
		var flag = confirm ("削除してもよろしいですか？\n");
		return flag;
	}
	</script>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">
</head>
<body>
	<!-- ▼ページ全体ここから -->
	<!-- ▼検索欄ここから -->
	<h3>社員情報検索</h3>
	<div align="center">
	<a href="IDform.php" style="position: relative; left: 450px; bottom: 5px;">新規登録</a>
	<form method="POST" action="">
		<table class="bordered">
			<tr>
				<th>検索項目</th>
				<th>検索情報</th>
			</tr>
			<tr>
				<td>氏名</td>
				<td><input type="text" name="name" size="30" value="<?php echo $name;?>" ></td>
			</tr>
			<tr>
				<td>現住所</td>
				<td><input type="text" name="address" size="30"  value="<?php echo $address; ?>"></td>
			</tr>
		</table>
		<br>
		<div align="center">
			<div style="display:inline-flex">
				<div>
					<input type="submit" value="検索" class="css_btn_class"  name="search-submit">
					<input type="reset" class="css_btn_class" value="リセット">
				</div>
			</div>
		</div>
	</form>
	</div>
	<!-- ▲検索欄ここまで -->
	<!-- ▼検索結果表示ここから -->
	<?php require_once 'search_result.php';?>
	<!-- ▲検索結果表示ここまで -->

</body>
</html>