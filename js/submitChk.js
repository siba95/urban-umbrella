function submitChk () {
	/* 確認ダイアログ表示 */
		var flag = confirm ("送信してもよろしいですか？\n");
	/* send_flg が TRUEなら送信、FALSEなら送信しない */
		return flag;
 }

$(document).ready(function (){
	$("#register").validationEngine('attach', {
		promptPosition:"centerRight"
	});

$("#con-update").validationEngine('attach', {
		promptPosition:"centerRight"
	});
});
