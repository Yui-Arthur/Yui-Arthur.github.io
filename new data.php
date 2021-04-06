<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>team</title>
	<meta  charset="utf-8" />
</head>
<body>
	<?php
		session_start();
		
		if($_SESSION['team']=='X')
		header("Location: index.php");
	
	
		echo "成功登入<br>";
		echo "<h1>".$_SESSION['team']."小隊</h1>";
		
		
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
		<input type="submit">
	</form>
	
	<?php
		if(isset($_POST['add_coin']))
		{
			$add_coin=$_POST['add_coin'];
			
			$link=pg_connect("$host $port $dataname $user $password");
			
		
			$id=$_SESSION['user'];
			$sql="INSERT INTO coin_record (user_id,change_record) VALUES ('$id','$add_coin')";
			
			if(pg_query($link,$sql))
			{
				$sql="UPDATE team_coin SET coin_number=coin_number+".$add_coin."WHERE team='".$_SESSION['team']."'";
				if(!pg_query($link,$sql))
				echo "硬幣增減失敗";
			
			
			}
			else
			echo "紀錄儲存失敗";
			
		
			pg_close($link);
			
			header("Location: new data.php");
			
		}
		
	?>
	
	
	<table>
	
	<?php
		$link=pg_connect("$host $port $dataname $user $password");
		$sql="SELECT * FROM coin_record";
		$result=pg_query($link,$sql);
		while($row_result=pg_fetch_assoc($result))
		{
			echo "<tr>";
			echo "<td>".$row_result["user_id"]."</td>";
			echo "<td>".$row_result["change_record"]."枚硬幣</td>";
			echo "</tr>";
		}
	?>
	
	</table>
	<a href="logout.php">登出<a/>
	
	
</body>
</html>
	


