<?php
require_once 'user_check.php';

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=Shift_JIS" />
	<title>IDフォーム</title>
	<!-- JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="jQuery/jquery.js" type="text/javascript.js"></script>
	<script type="text/javascript" src="js/howYear.js"></script>
	<script src="jQuery/jquery.validationEngine-ja.js"></script>
	<script src="jQuery/jquery.validationEngine.js"></script>
	<!-- ErrorMessage jQuery 初期設定 -->
	<script type="text/javascript">
	jQuery(document).ready(function (){
		jQuery("#submitChk").validationEngine('attach', {
			promptPosition:"centerRight"
		});
	});
	</script>
	<!-- 入力情報check -->
	<script>
	function submitChk () {
		var flag = confirm ("送信してもよろしいですか？\n");
		return flag;
	}
	</script>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">
</head>
<body>
<?php
if(!empty($_POST["updateUser"])){
	echo "<h3>登録情報変更</h3>";
}else{
	echo "<h3>新規情報登録</h3>";
}
?>
<a href="search.php" style="position: relative; left: 550px; bottom: 5px;">検索画面に戻る</a>
<form id="submitChk" method="post" action="" onsubmit="return submitChk()">
<table class="re_table">
	<tr>
		<th>氏名</th>
		<td>
			<input type="text" name="name" size="30" value="<?php echo $name;?> " class="validate[required]" >
			<div><?php if($errorname){echo "氏名は30文字までです。";}?></div>
		</td>
	</tr>
	<tr>
		<th>フリガナ</th>
		<td>
			<input type="text" name="kana" size="30" value="<?php echo $kana; ?> " class="validate[required]"  pattern="^[ァ-ン]+$" title="カタカナのみ入力できます">
			<div><?php if($errorkana){echo "フリガナは30文字までです。";}?></div>
		</td>
	</tr>
	<tr>
		<th>性別</th>
		<td>
			<?php //性別判定
			if($gender =="男"){
				echo "<select name='gender'>
				<option value='男' selected>男</option>
				<option value='女'>女</option>
				</select>";
			}else{
				echo "<select name='gender'>
				<option value='男'>男</option>
				<option value='女' selected>女</option>
				</select>";
			}
			?>
		</td>
	</tr>
	<tr>
		<th>生年月日</th>
		<td>
			<input type="date" id="date-start"  name="birth" value="<?php echo $birth; ?>" class="validate[required]" style="float:left;">
			<div><?php if($errorbirth){echo "14歳以下または80歳以上は登録できません。";}?></div><div id="old" style="float:left;"></div>
		</td>
	</tr>
	<tr>
		<th>就業年数</th>
		<td>
			<input type="date" id="exp-start"  name="exp" value="<?php echo $exp; ?>" class="validate[required]" style="float:left;">
			<div id="exp" style="float:left;"></div>
			<div><?php if($errorexp){echo "職歴が50年以上は登録できません。";}?></div>
		</td>
	</tr>
	<tr>
		<th>最寄り駅</th>
		<td>
			<input type="text" name="station" size="30" value="<?php echo $station; ?> " class="validate[required]" >
			<div><?php if($errorstation){echo "最寄り駅は30文字までです。";}?></div>
		</td>
	</tr>
	<tr>
		<th>現住所</th>
		<td>
			<input type="text" name="address" size="30" value="<?php echo $address; ?>" class="validate[required]" >
			<div><?php if($erroraddress){echo "現住所は60文字までです。";}?></div>
		</td>
	</tr>
	<tr>
		<th>学歴</th>
		<td>
			<input type="text" name="academic" size="30" value="<?php echo $academic; ?>" class="validate[required]" >
			<div><?php if($erroracademic){echo "学歴は30文字までです。";}?></div>
		</td>
	</tr>
	<tr>
		<th>資格</th>
		<td>
			<textarea name="license" rows="4" cols="30" ><?php echo $license; ?> </textarea>
			<div><?php if($errorlicense){echo "資格は100文字までです。";}?></div>
			</td>
	</tr>
</table>
<br>
	<div align="center">
		<input type="hidden" name="userId" value="<?php echo $userId; ?>">
		<input type="submit" value="変更" class="css_btn_class"  name="idSubmit">
		<input type="reset" class="css_btn_class">
	</div>
</form>
</body>
</html>