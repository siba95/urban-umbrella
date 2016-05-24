<?php
if(!empty($bioRows[0]["from_day"])){
	echo "<table class='bordered2' align ='center' >";
	echo "<tr>
			<th>作業期間</th>
			<th>業務内容</th>
			<th>機器・OS</th>
			<th>言語・ツール</th>
			<th>備考</th>
			<th>職務履歴編集</th>
			<th>職務履歴削除</th>
			</tr>";
	while($userBioRows = pg_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".$userBioRows["from_day"]."<br>～<br>".$userBioRows["to_day"]."</td>";
		echo "<td>".$userBioRows["outline"]."</td>";
		echo "<td>".$userBioRows["os"]."</td>";
		echo "<td>".$userBioRows["langu"]."</td>";
		echo "<td>".$userBioRows["other"]."</td>";
		echo "<td>
				<form action='Bioform.php' method='POST'>
				<input type='hidden' name='userId' value='".$userId."'>
				<input type='hidden' name='bioId' value='".$userBioRows["bio_id"]."'>
				<input type='submit' value='編集' name='updateBio'>
				</form>
				</td>";
		echo "<td>
				<form action='' method='POST' onsubmit='return submitDel()'>
				<input type='hidden' name='userId' value='".$userId."'>
				<input type ='hidden' name='bioId' value='".$userBioRows["bio_id"]."'>
				<input type='submit' value='削除' name='delete'>
				</form>
				</td>";
		echo "</tr>";
	}
	echo "</table>";
}else{
	echo "職歴なし";
}
?>