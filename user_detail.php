<?php
require_once 'bioUserChk.php';
require_once 'bio_delete.php';;
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=Shift_JIS" />
	<title>職歴編集画面</title>
	<!-- JS -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="jQuery/jquery.js" type="text/javascript"></script>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<link rel="stylesheet" type="text/css" href="css/confirm_table.css">
	<!-- 削除check -->
	<script>
	function submitDel () {
	/* 確認ダイアログ表示 */
		var flag = confirm ("職務履歴を削除しますか？\n");
	/* flg が TRUEなら送信、FALSEなら送信しない */
		return flag;
	    }
	</script>
</head>
<body>
<h3>社員情報</h3>
<a href="search.php" style="position: relative; left: 800px; bottom: 5px;">検索画面に戻る</a>
<table class="conbordered">
	<tr>
		<th>氏名</th>
		<th>フリガナ</th>
		<th>性別</th>
		<th>年齢</th>
		<th>経験年数</th>
		<th>最寄り駅</th>
		<th>現住所</th>
	</tr>
	<tr>
		<td><?php echo $name; ?></td>
		<td><?php echo $kana; ?></td>
		<td><?php echo $gender; ?></td>
		<td><?php echo $old; ?></td>
		<td><?php echo $expday; ?></td>
		<td><?php echo $station; ?></td>
		<td><?php echo $address; ?></td>
	</tr>
	<tr>
		<td bgcolor="#dce9f9"><b>学歴</b></td>
		<td colspan="3"><?php echo $academic; ?></td>
		<td bgcolor="#dce9f9"><b>資格</b></td>
		<td colspan="2"><?php echo $license; ?></td>
	</tr>
</table>
<h3>職務履歴</h3>
<form method="POST" action="Bioform.php">
	<input type="hidden" name="userId" value="<?php echo $userId;?>">
	<input type="submit" name="inputBio" value="追加">
</form>
<?php
require_once 'user_bio.php';
?>