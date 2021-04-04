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
		pg_close($link);
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
	
	<a href="admin_new_data.php">新增資料</a>
	<br>
	<a href="admin_delet_data.php">刪除資料</a>
	<br>
	<a href="admin_change_data.php">更改資料</a>
	
	
</body>
</html>
	


