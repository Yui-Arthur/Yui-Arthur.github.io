<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>新增資料</title>
	<meta  charset="utf-8" />
</head>
<body>
	<?php
		session_start();
		
		if($_SESSION['login_session']==false)
		header("Location: index.php");
	
		echo "成功登入";
	?>
	
	
</body>
</html>
	


