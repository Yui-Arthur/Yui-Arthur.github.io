<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>登入</title>
	<meta  charset="utf-8" />
</head>
<body>

	<h1>登入介面</h1>
	<form action="session.php" method="post">
	帳號 <input type="text" name="username" placeholder="朱祐誼" required="required">
	<br>密碼 <input type="password" name="pw" required="required">
	<br><br><input type="submit">
	</form>
	<?php
		session_start();
		if(isset($_POST['username']))
		{
			$link= @mysqli_connect('localhost','teatphp','a0986780011','camping');
			if(!$link)
			{
				echo "erro";
				exit();
			}
			$name=$_POST['username'];
			$ps=$_POST['pw'];
			
			mysqli_query($link,"SET NMAES utf8");
			
			$sql = "SELECT * FROM 個人資料 WHERE password='" . $ps . "' AND name='" . $name . "'";
			
			$result=mysqli_query($link,$sql);
			
			$total_record = mysqli_num_rows($result);
			
			if($total_record>0)
			{
				$_SESSION['login_session']=true;
				header("Location: index.php");
			}
			else
			{
				echo "帳號或密碼錯誤";
				$_SESSION['login_session']=false;
			}
			
			mysqli_close($link);
		
		}
	
	?>
			
	
	
</body>
</html>
	


