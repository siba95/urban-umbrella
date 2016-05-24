//1桁の数字を0埋めで2桁にする
var toDoubleDigits = function(num) {
  num += "";
  if (num.length === 1) {
    num = "0" + num;
  }
 return num;
};

//年齢計算
$(function($) {
	$('#date-start').change(function(event)
	{
		setDate();
	});
	function setDate(){
		var fromDate = new Date($('#date-start').val() ); //生年月日を取得
		var year = fromDate.getFullYear().toString();
		var mm = (fromDate.getMonth() + 1).toString();
		var dd = fromDate.getDate().toString();
		var yyyymmdd = year + '-' + (mm[1]?mm:"0"+mm[0]) + '-' + (dd[1]?dd:"0"+dd[0]);
		var birthday = year + (mm[1]?mm:"0"+mm[0]) +  (dd[1]?dd:"0"+dd[0]);
			console.log(birthday);
		var  today = new Date();
		var  today = parseInt("" + today.getFullYear() + toDoubleDigits(today.getMonth() + 1) + today.getDate());// 文字列型に明示変換後にparseInt
			console.log(today);
		var old = parseInt((today - birthday) / 10000);
			console.log(old);
				$(function() {
					$("#old").text("　　　"+old+"歳");
				});
    }
});

//職歴計算
$(function($){
	$('#exp-start').change(function(event)
	{
		setDate();
	});
	function setDate(){
		var fromDate = new Date($('#exp-start').val() ); //職歴を取得
		var year = fromDate.getFullYear().toString();
		var mm = (fromDate.getMonth() + 1).toString();
		var dd = fromDate.getDate().toString();
		var expday = year + (mm[1]?mm:"0"+mm[0]) +  (dd[1]?dd:"0"+dd[0]);
			console.log(expday);
		var  today = new Date();
		var  today = parseInt("" + today.getFullYear() + toDoubleDigits(today.getMonth() + 1) + today.getDate());// 文字列型に明示変換後にparseInt
			console.log(today);
		var exp = parseInt((today - expday) / 10000);
		if(exp == 0){
			exp = "1年未満";
			$(function() {
				$("#exp").text("　　　"+exp);
			});
		}else{
			$(function() {
				$("#exp").text("　　　"+exp+"年");
			});
		}
	}
});
