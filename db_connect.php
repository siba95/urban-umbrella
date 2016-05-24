<?php
class Postgres
{
	public function dbConnect()
	{
		//DB接続設定
		require('user_cnf.php');

		//DB接続
		$dbConn =pg_connect("host=".$dbHost." dbname=".$dbName." user=".$dbUser." password=".$dbPass);

		$busy= pg_connection_busy($dbConn);
		//ビジー状態
		if($busy)
		{
			die('データベースに接続できませんでした。');
		}
		//エンコーディング設定
		pg_set_client_encoding("UTF8");
		return $dbConn;
	}
	//SQL ユーザー検索
	public function selectUser($sql)
	{
		//DB接続
		$dbClass = new Postgres();
		$dbConnect = $dbClass->dbConnect();
		//結果
		$userResult = pg_query($dbConnect,$sql) or die('クエリーに失敗しました。');
		return $userResult;
	}
	//selectBio
	public function selectBio($sql)
	{
		//DB接続
		$dbClass = new Postgres();
		$dbConnect = $dbClass->dbConnect();
		//結果
		$bioResult = pg_query($dbConnect,$sql) or die('クエリーに失敗しました。');
		return $bioResult;
	}
	//SQL INSERT_USER
	public function insertUser($sql)
	{
		//DB接続
		$dbClass = new Postgres();
		$dbConnect = $dbClass->dbConnect();
		//結果
		$result = pg_query($sql);
		if(!$result){
			die('クエリーが失敗しました。'.pg_last_error());
		}else{
			//切断
			pg_close($dbConnect);
			echo "<script>
				alert('ユーザー情報の新規登録しました。');
				window.location.href = './search.php';
				</script>";
		}
	}
	//insertBio
	public function insertBio($sql)
	{
		//DB
		$dbClass = new Postgres();
		$dbConnect = $dbClass->dbConnect();
		$userId = $_POST["userId"];
		//result
		$result = pg_query($sql);
		if(!$result){
			die("クエリーが失敗しました。".pg_last_error());
		}else{
			echo "<script>alert('職歴の新規登録しました。');</script>";
			echo "<html>
					<form method='POST' action='user_detail.php' name='insertBio'>
					<input type='hidden' name='bioUser' value='".$userId."'>
					</form>
					</html>";
			echo "<script>document.insertBio.submit();</script>";
		}
	}
	//SQL DELETE_USER
	public function deleteUser($sql)
	{
		//DB
		$dbClass = new Postgres();
		$dbConnect = $dbClass->dbConnect();
		//result
		$result = pg_query($sql);
		if(!$result){
			die("クエリーが失敗しました。".pg_last_error());
		}else{
			echo "<script>
				alert('ユーザー情報を削除しました。');
				window.location.href = './search.php';
				</script>";
		}
	}

	//deleteBio
	public function deleteBio($sql){
		//DB
		$dbClass = new Postgres();
		$dbConnect = $dbClass->dbConnect();
		$userId = $_POST["userId"];
		//結果
		$result = pg_query($sql);
		if(!$result){
			die('クエリーが失敗しました。'.pg_last_error());
		}else{
			echo "<script>alert('登録情報を削除しました。');</script>";
			echo "<html>
				<form method='POST' action='user_detail.php' name='back'>
				<input type='hidden' name='bioUser'value='".$userId."'>
				</form>
				</html>";
			echo "<script>document.back.submit();</script>";
		}
	}

	//SQL UPDATE
	public function updateUser($sql)
	{
		//DB接続
		$dbClass = new Postgres();
		$dbConnect = $dbClass->dbConnect();
		//結果
		$result = pg_query($dbConnect,$sql);
		if(!$result){
			die('クエリーに失敗しました。');
		}else{
			//切断
			//pg_close($db_connect);
			echo "<script>
				alert('ユーザー情報を更新しましたしました。');
				window.location.href = './search.php';
				</script>";
		}
	}

	//updateBio
	public  function  updateBio($sql)
	{
		//DB
		$dbClass = new Postgres();
		$dbConnect = $dbClass->dbConnect();
		$userId = $_POST["userId"];
		//result
		$result = pg_query($dbConnect,$sql);
		if(!$result){
			die('クエリーに失敗しました。');
		}else{
			echo "<script>alert('登録情報を更新しました。');</script>";
			echo "<html>
				<form method='POST' action='user_detail.php' name='back'>
				<input type='hidden' name='bioUser'value='".$userId."'>
				</form>
				</html>";
			echo "<script>document.back.submit();</script>";
		}
	}

	//エラーメッセージ
	function error_msg()
	{
		exit('エラー：'.pg_last_error());
	}
}