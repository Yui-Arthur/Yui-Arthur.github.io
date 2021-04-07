<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>team</title>
	<meta  charset="utf-8" />
</head>
<body>
	<?php
		session_start();
		unset($_SESSION['team']);
		header("Location: index.php");
	?>
	
	
</body>
</html>
	


