<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>data check</title>
	<meta  charset="utf-8" />
</head>
<body>
	<?php
		session_start();
		
		if($_SESSION['login_session']==false)
		header("Location: index.php");
	
		echo "成功登入";
	?>
	<a href="logout.php">登出<a/>
	<br>
	<?php
		$host="host=ec2-107-22-245-82.compute-1.amazonaws.com";
		$user="user=lntmwnajpnrsuu";
		$password="password=028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac";
		$dataname="dbname=d7eeaut5vsohsq";
		$port="port=5432";
		$URL="postgres://lntmwnajpnrsuu:028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac@ec2-107-22-245-82.compute-1.amazonaws.com:5432/d7eeaut5vsohsq";
		//phpinfo();
		$link=pg_connect("$host $port $dataname $user $password");
		
		$data="SELECT * FROM personal_data";
		$result=pg_query($link,$data);
	?>
	
	<table>
		<?php
			while($row_result=pg_fetch_assoc($result))
			{
				echo "<tr>";
				echo "<td>".$row_result["id"]."</td>";
				echo "<td>".$row_result["name"]."</td>";
				echo "<td>".$row_result["team"]."</td>";
				echo "</tr>";
			}
		?>
	
	</table>
	
	<form action="admin_new_data.php" method="POST"> 
		<input type="number" name="class_number"  placeholder="class_number" required="">
		<input type="text" name="name"  placeholder="name" required="">
		<input type="text" name="pw"  placeholder="Password" required="">
		<input type="text" name="team"  placeholder="team" required="">
		<input type="submit">
	</form>
	<?php
		if(isset($_POST['pw']))
		{
		
			$class_number=$_POST["class_number"];
			
			$sql="SELECT * FROM personal_data WHERE id='".$class_number."'";
			//$sql="SELECT * FROM personal_data WHERE password='" . $pw ."' AND name='" . $name ."'";
			$result=pg_query($link,$sql);
			$record=pg_num_rows($result);
			
			if($record>0)
			echo "已有相同學號";
			else
			{
				$name=$_POST["name"];
				$pw=password_hash($_POST["pw"],PASSWORD_DEFAULT);
				$team=$_POST["team"];
				
				$sql="INSERT INTO personal_data (id,name,password,team) VALUES ('$class_number','$name','$pw','$team')";
				
				if(pg_query($link,$sql))
				echo "成功";
				else
				echo "失敗";
				
			}
		
		}
	
	?>
	<a href="admin_control.php">回選單</a>
</body>
</html>
	


