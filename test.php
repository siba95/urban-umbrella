<?php
 
	// 初期値
	$y = date('Y');
	$m = date('n');
		
	// 日付の指定がある場合
	if(!empty($_GET['date']))
	{
		$arr_date = explode('-', htmlspecialchars($_GET['date'], ENT_QUOTES));
		
		if(count($arr_date) == 2 and is_numeric($arr_date[0]) and is_numeric($arr_date[1]))
		{
			$y = (int)$arr_date[0];
			$m = (int)$arr_date[1];
		}
	}
 
	// 祝日の取得の関数
	function japan_holiday($year = '')
	{
	    $apiKey = '★MY API KEY★';  // GoogleAPIキー http://goo.gl/DOiU7J
	    $holidays = array();
	
	    // カレンダーID 
	    $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
	
	    // 取得期間
	    $start  = date($year."-01-01\T00:00:00\Z");
	    $finish = date($year."-12-31\T00:00:00\Z");
	
	    $url = "https://www.googleapis.com/calendar/v3/calendars/{$calendar_id}/events?key={$apiKey}&timeMin={$start}&timeMax={$finish}&maxResults=50&orderBy=startTime&singleEvents=true";
	
	    if ($results = file_get_contents($url, true))
		{
	        // JSON形式で取得した情報を配列に格納
	        $results = json_decode($results);
	
	        // 年月日をキー、祝日名を配列に格納
	        foreach ($results->items as $item) {
	            $date = strtotime((string) $item->start->date);
	            $title = (string) $item->summary;
	            $holidays[date('Y-m-d', $date)] = $title;
	        }
	
	        // 祝日の配列を並び替え
	        ksort($holidays);
	    }
	
	    return $holidays; 
	}
	
	// 祝日取得
	$national_holiday = japan_holiday($y);
?>
 
 
<table>
	<tr>
		<td><a href="./?date=<?php echo date('Y-m', strtotime($y .'-' . $m . ' -1 month')); ?>">&lt; 前の月</a></td>
		<td><?php echo $y ?>年<?php echo $m ?>月</td>
		<td><a href="./?date=<?php echo date('Y-m', strtotime($y .'-' . $m . ' +1 month')); ?>">次の月 &gt;</a></td>
	</tr>
</table>
 
<table>
<tr>
	<th>日</th>
	<th>月</th>
	<th>火</th>
	<th>水</th>
	<th>木</th>
	<th>金</th>
	<th>土</th>
</tr>
<tr>
 
<?php
 
	// 1日の曜日を取得
	$wd1 = date("w", mktime(0, 0, 0, $m, 1, $y));
	
	// その数だけ空のセルを作成
	for ($i = 1; $i <= $wd1; $i++) {
		echo "<td> </td>";
	}
	 
	$d = 1;
	while (checkdate($m, $d, $y)) {
		
		// 日曜：赤色
		if(date("w", mktime(0, 0, 0, $m, $d, $y)) == 0)
		{
			echo "<td style='color:red;'>$d</td>";
		}
		// 土曜：青色
		elseif(date("w", mktime(0, 0, 0, $m, $d, $y)) == 6)
		{
			echo "<td style='color:blue;'>$d</td>";
		}
		// 祝日：黄色
		elseif(!empty($national_holiday[date("Y-m-d", mktime(0, 0, 0, $m, $d, $y))]))  
		{
			echo "<td style='background:yellow;'>$d</td>";
		}
		// 土日祝以外
		else
		{
			echo "<td>$d</td>";
					}
		
		// 週の始まりと終わりでタグを出力
					if (date("w", mktime(0, 0, 0, $m, $d, $y)) == 6)
		{
		    // 週を終了
		 	   echo "</tr>";
			
			// 次の週がある場合は新たな行を準備
		    if (checkdate($m, $d + 1, $y)) {
		        echo "<tr>";
		    }
		}
		
	    $d++;
	}
	
	// 最後の週の土曜日まで空のセルを作成
	$wdx = date("w", mktime(0, 0, 0, $m + 1, 0, $y));
	
	for ($i = 1; $i < 7 - $wdx; $i++)
	{
		echo "<td>　</td>";
	}
?>
</tr>
</table>