<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>team</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta  charset="utf-8" />
</head>
<body>
	<?php
		session_start();
		
		if($_SESSION['team']=='')
		header("Location: index.php");
	
	
		echo "成功登入<br>".$_SESSION['user'];
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
				$change_record=$add_coin."枚硬幣 給".$select_team."小隊";
				$link=pg_connect("$host $port $dataname $user $password");
				
			
				$id=$_SESSION['user'];
				$sql="INSERT INTO coin_record (user_id,change_record) VALUES ('$id','$change_record')";
				
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
	
	
	<table>
	
	<?php
		$link=pg_connect("$host $port $dataname $user $password");
		$sql="SELECT * FROM coin_record";
		$result=pg_query($link,$sql);
		while($row_result=pg_fetch_assoc($result))
		{
			echo "<tr>";
			echo "<td>".$row_result["user_id"]."發送</td>";
			echo "<td>".$row_result["change_record"]."</td>";
			echo "</tr>";
		}
	?>
	
	</table>
	
	<br>
	<br>
	<br>
	
	
	<p>更改密碼</p>
	<form action="new data.php" method="POST"> 
		<input type="text" name="pw"  placeholder="Password" required="">
		<input type="submit">
	</form>
	
	
	<?php
		if(isset($_POST['pw']))
		{
			$link=pg_connect("$host $port $dataname $user $password");
			$id=$_SESSION['user'];
			$pw=$_POST['pw'];
			$sql="SELECT * FROM personal_data WHERE id='".$id."'";
			$result=pg_query($link,$sql);
			
			
				
			$pw=password_hash($_POST["pw"],PASSWORD_DEFAULT);
				
				
			$sql="UPDATE personal_data SET password='".$pw."' WHERE id=".$id;
				
				if(pg_query($link,$sql))
				header("Location: logout.php");
				else
				echo "失敗";
				
			
			pg_close($link);
		}
		
	
	?>
	
	<br>
	<a href="logout.php">登出<a/>
	
	
</body>
</html>
	


