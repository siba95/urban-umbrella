<?php
//SQL
if($_SESSION["Search"] != NULL){
	$sql = "SELECT user_id,name,gender,birth,exp,station,address
	 		FROM user_info WHERE name LIKE '%$name%' AND address like '%$address%' ORDER BY user_id ASC";

	//DB接続呼び出し
	require_once 'db_connect.php';
	$dbClass = new Postgres();
	$userResult = $dbClass->selectUser($sql);

	//該当項目の有無確認
	if(!empty(pg_fetch_all($userResult))){

		//件数
		echo "検索結果：　".count(pg_fetch_all($userResult))."件";

		//ユーザー情報の配列をテーブル化
		echo "<table class='bordered2' align ='center' >";
		echo "<tr><th>氏名</th><th>性別</th><th>年齢</th><th>経験年数</th><th>最寄り駅</th>
				<th>現住所</th><th>社員情報編集</th><th>職務履歴</th><th>社員情報削除</th></tr>";
		while($userDataRows = pg_fetch_assoc($userResult)){
			echo "<tr>";
			echo "<td>".$userDataRows["name"]."</td>";
			echo "<td>".$userDataRows["gender"]."</td>";
			echo "<td>"."年齢"."</td>";
			echo "<td>"."経験年数"."</td>";
			echo "<td>".$userDataRows["station"]."</td>";
			echo "<td>".$userDataRows["address"]."</td>";
			//ユーザー情報編集
			echo "<td><form action='IDform.php' method='POST'>
					<input type='hidden' name='userId' value='".$userDataRows["user_id"]."'>
					<input type='submit' value='編集'>
					</form></td>";
			//ユーザー情報詳細閲覧
			echo "<td><form action='user_detail.php' method='POST'>
					<input type='hidden' name='bioUser' value='".$userDataRows["user_id"]."'>
					<input type='submit' value='編集'>
					</form></td>";
			//ユーザー情報削除
			echo "<td><form action='' method='POST' onsubmit='return submitChk()'>
					<input type='hidden' name='delUser' value='".$userDataRows["user_id"]."'>
					<input type='submit' value='削除' name='delete'>
					</form></td>";
			echo "</tr>";
		}
		echo "</table>";
	}else{
		echo "<script>alert('検索条件に該当項目なし');</script>";
	}
}

?>