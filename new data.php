<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>team</title>
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
	
</body>
</html>
	


