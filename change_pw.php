<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>change_pw</title>
	<meta  charset="utf-8" />
</head>
<body>
	<?php
		session_start();
		
		if(!isset($_SESSION['user']))
		header("Location: logout.php");
	
		echo "成功登入";
	?>
	
	
	<?php
		$host="host=ec2-107-22-245-82.compute-1.amazonaws.com";
		$user="user=lntmwnajpnrsuu";
		$password="password=028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac";
		$dataname="dbname=d7eeaut5vsohsq";
		$port="port=5432";
		$URL="postgres://lntmwnajpnrsuu:028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac@ec2-107-22-245-82.compute-1.amazonaws.com:5432/d7eeaut5vsohsq";
		//phpinfo();
		
		
		
	?>
	

	<p>更改密碼</p>
	<form action="change_pw.php" method="POST"> 
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
	
</body>
</html>
	


