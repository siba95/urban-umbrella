<?php
require_once 'bio_check.php';
$userId =  $_POST["userId"];
?>
<html>
<head>
	<!-- js -->
	<script src="jQuery/jquery.js" type="text/javascript"></script>
	<script src="jQuery/jquery-1.8.2.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="jQuery/jquery.validationEngine.js"></script>
	<script src="jQuery/jquery.validationEngine-ja.js"></script>
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">
	<!-- meta -->
	<meta http-equiv="content-Type" content="text/html; charset=Shift_JIS">
	<title>職歴編集画面</title>
	<!-- ErrorMessage jQuery 初期設定 -->
	<script type="text/javascript">
	jQuery(document).ready(function (){
		jQuery("#bio_sub").validationEngine('attach', {
			promptPosition:"centerRight"
		});
	});
	</script>
	<!-- 削除check -->
	<script>
	function submitChk () {
		/* 確認ダイアログ表示 */
		var flag = confirm ("職務履歴を登録しますか？\n");
		/* flg が TRUEなら送信、FALSEなら送信しない */
		return flag;
	}
	</script>
</head>
<body>
	<?php
	if(!empty($_POST["bioId"])){
		echo "<h3>登録情報変更</h3>";
	}else{
		echo "<h3>新規情報登録</h3>";
	}
	?>
	<a href="search.php" style="position: relative; left: 550px; bottom: 5px;">検索画面に戻る</a>
	<form id="bio_sub" method="post" action="" onsubmit="return submitChk()">
	<table class="re_table">
		<tr>
			<th>作業期間</th>
			<td>
				<input type="date" name="from_day" class="validate[required]" value="<?php echo $fromDay;?>">
				<div><?php if($errorfrom){echo "作業開始年月日は1941年以降しか登録できません。";}?></div>
				　～　<input type="date" name="to_day" class="validate[required]" value="<?php echo $toDay;?>" >
				<div><?php if($errorto){echo "作業終了予定が10年以上先は登録できません。";}?></div>
			</td>
		</tr>
		<tr>
			<th>作業内容</th>
			<td>
				<textarea rows="4" cols="30" name="outline"  class="validate[required]" >
					<?php echo str_replace("<br />","&#13;",$outline);?>
				</textarea>
				<div><?php if($erroroutline){echo "100文字以上は登録できません。";}?></div>
			</td>
		</tr>
		<tr>
			<th>機器・OS</th>
			<td>
				<input type="text" name="os" value="<?php echo $os;?>"  class="validate[required]" >
				<div><?php if($erroros){echo "30文字以上は登録できません。";}?></div>
			</td>
		</tr>
		<tr>
			<th>言語・ツール</th>
			<td>
				<input type="text" name="langu" value="<?php echo $langu;?>"  class="validate[required]" >
				<div><?php if($errorlangu){echo "30文字以上は登録できません。";}?></div>
			</td>
		</tr>
		<tr>
			<th>備考</th>
			<td>
				<textarea rows="4" cols="30" name="other">
					<?php echo str_replace("<br />","&#13;",$other);?>
				</textarea>
				<div><?php if($errorother){echo "100文字以上は登録できません。";}?></div></td>
		</tr>
	</table>
		<br>
		<div align="center">
			<div style="display:inline-flex">
				<input type="hidden" name="bioId" value="<?php echo $bioId;?>">
				<input type="hidden" name="userId" value="<?php echo $userId;?>">
					<div>
						<input type="submit" value="変更" class="css_btn_class"  name="bioSubmit">
						<input type="reset" class="css_btn_class" value="リセット">
					</div>
			</div>
		</div>
	</form>
</body>
</html>