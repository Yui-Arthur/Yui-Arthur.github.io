<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>team</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta  charset="utf-8" />
	<link rel="icon" href="favicon.jpg" type="image/x-icon">
</head>
<body>
	<?php
		session_start();
		
		if($_SESSION['team']=='')
		header("Location: logout.php");
	
	
		echo "成功登入<br>".$_SESSION['user'];
		echo "<h1>".$_SESSION['team']."小隊</h1>";
		
	?>
	
	<form action="new data.php" method="post">
	
		
		<select name="change_team" required="required">
			<option value="X">改變小隊</option>
			<option value="A">A小隊</option>
			<option value="B">B小隊</option>
			<option value="C">C小隊</option>
			<option value="D">D小隊</option>
		</select>
		
		<input type="submit">
	</form>
	
	<?php
		if(isset($_POST['change_team']))
		{
			if($_POST['change_team']!="X")
			{
				$_SESSION['team']=$_POST['change_team'];
				header("Location: new data.php");
			}
		}
	?>
	
	<?php
		$host="host=ec2-107-22-245-82.compute-1.amazonaws.com";
		$user="user=lntmwnajpnrsuu";
		$password="password=028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac";
		$dataname="dbname=d7eeaut5vsohsq";
		$port="port=5432";
		$URL="postgres://lntmwnajpnrsuu:028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac@ec2-107-22-245-82.compute-1.amazonaws.com:5432/d7eeaut5vsohsq";
		//phpinfo();
		$link=pg_connect("$host $port $dataname $user $password");
		
		if(!$link)
		{
			echo "erro";
			exit();
		}
		
		
		$sql="SELECT coin_number FROM team_coin WHERE team='".$_SESSION['team']."'";
		
		$result=pg_query($link,$sql);
		if($result)
		{
			$row_result=pg_fetch_assoc($result);
			echo "<h2>".$row_result['coin_number']."枚金幣</h2>";
		}
		else
			echo "連接錯誤";
		
		pg_close($link);
	?>
	
	<form action="new data.php" method="post">
	
		<input type="number" name="add_coin" placeholder="0" required="required">
		
		<select name="select_team" required="required">
			<option value="X">選擇小隊</option>
			<option value="A">A小隊</option>
			<option value="B">B小隊</option>
			<option value="C">C小隊</option>
			<option value="D">D小隊</option>
		</select>
		
		<input type="submit">
	</form>
	
	
	
	<?php
		if(isset($_POST['add_coin']))
		{
			$select_team=$_POST['select_team'];
			if($select_team!="X")
			{
				
				$add_coin=$_POST['add_coin'];
				
				$link=pg_connect("$host $port $dataname $user $password");
				
				$sql="SET time zone 'ROC'";
				pg_query($link,$sql);
				
				$sql="SELECT LOCALTIMESTAMP(0)";
				$result=pg_query($link,$sql);	
				$row_result=pg_fetch_assoc($result);
				$today=$row_result['localtimestamp'];
			
			
				$id=$_SESSION['user'];
				$sql="INSERT INTO coin_record (user_id,coin_change,give_team,change_time) VALUES ('$id','$add_coin','$select_team','$today')";
				
				if(pg_query($link,$sql))
				{
					$sql="UPDATE team_coin SET coin_number=coin_number+".$add_coin."WHERE team='".$select_team."'";
					if(!pg_query($link,$sql))
					echo "硬幣增減失敗";
					else
					header("Location: new data.php");
				
				}
				else
				echo "紀錄儲存失敗";
				
				
				pg_close($link);
				
				
			}
			else
			echo "請選擇小隊";
		
			
		}
		
	?>
	
	<br>
	<br>
	<table  cellspacing=10>
	<caption>發放硬幣紀錄</caption>
	
	<?php
		$link=pg_connect("$host $port $dataname $user $password");
		

		$sql="SET time zone 'ROC'";
		pg_query($link,$sql);
		
		$sql="SELECT LOCALTIMESTAMP(0)";
		$result=pg_query($link,$sql);	
		$row_result=pg_fetch_assoc($result);
		$today=$row_result['localtimestamp'];
		
		
		$sql="SELECT * FROM coin_record ORDER BY change_time DESC";
		$total_result=pg_query($link,$sql);
		
		
		while($row_result=pg_fetch_assoc($total_result))
		{
			echo "<tr>";
			echo "<td align='right'>".$row_result["user_id"]."發送</td>";
			
			echo "<td align='right'>".$row_result["coin_change"]."枚硬幣給</td>";
			echo "<td>".$row_result["give_team"]."小隊</td>";
			
			$sql="SELECT age (now(),'".$row_result["change_time"]."')";
			$result=pg_query($link,$sql);
			$time_result=pg_fetch_assoc($result);
			
			
			echo "<td align='right'>";
			
			$sql="SELECT date_part ('DAY',interval '".$time_result['age']."')";
			$result=pg_query($link,$sql);
			$day_result=pg_fetch_assoc($result);
			
			if($day_result['date_part']!=0)
			echo $day_result['date_part']."天";
			
			$sql="SELECT date_part ('HOUR',interval '".$time_result['age']."')";
			$result=pg_query($link,$sql);
			$hour_result=pg_fetch_assoc($result);
			
			
			if($hour_result['date_part']!=0)
			echo $hour_result['date_part']."小時";
			
			$sql="SELECT date_part ('MINUTE',interval '".$time_result['age']."')";
			$result=pg_query($link,$sql);
			$minute_result=pg_fetch_assoc($result);
			
			echo $minute_result['date_part']."分鐘前";
			echo "</td>";
			echo "</tr>";
			
		}
		
		pg_close($link);
	?>
	
	</table>
	
	<br>
	<br>
	<br>
	
	
	
	
	<br>
	<a href="logout.php">登出<a/>
	
	
</body>
</html>
	


