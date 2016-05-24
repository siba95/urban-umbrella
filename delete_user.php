<?php
	if(!empty($_POST["delUser"])){
		$userId = htmlspecialchars($_POST["delUser"], ENT_QUOTES, "UTF-8");
		$sql = "WITH deleted AS (DELETE FROM user_info WHERE user_id = '$userId' RETURNING user_id)
				DELETE FROM user_bio WHERE user_id IN (SELECT user_id FROM deleted)";

		require_once 'db_connect.php';
		$dbClass = new Postgres();
		$result = $dbClass->deleteUser($sql);
	}