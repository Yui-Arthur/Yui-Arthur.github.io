<!doctype html>
<html  lang="zh-Hant-TW">
<head>
	<title>change_pw</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="icon" href="favicon.jpg" type="image/x-icon">
  
    
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <link href="static/css/all.css" rel="stylesheet">
	<meta  charset="utf-8" />
</head>
<body>
	<div class="page-content p-4" style="z-index: 100;">
	<?php
		session_start();
		
		if(!isset($_SESSION['user']))
		header("Location: logout.php");
	
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
	<br>
	<div class="mb-4">
        <div class="card shadow" style="border-radius: 25px ;background-color:rgba(255,255 ,255 , 0.75);">
            <figure class="text-center">
                
                    <div class="tile-header" style="padding: 20px;">
					
					<p class="h4">更改名字<br> (名字=\=帳號)<br> (可以是中文)<br>密碼(不可以是學號)</p>
					<form action="change_pw.php" method="POST"> 
						<input type="text" name="name"  placeholder="name" required="">
						<br><input type="password" name="pw"  placeholder="Password" required="">
						<br><input type="submit">
					</form>
					
					</div>
					
                
            </div>
        </div>  
    </div>  


	
	
	
	<?php
		if(isset($_POST['pw']))
		{
			$link=pg_connect("$host $port $dataname $user $password");
			$id=$_SESSION['user'];
			$name=$_POST['name'];
			$pw=$_POST['pw'];
			
			
			if(preg_match("/[ '.,:;*?~`!@#$%^& =)(<>{}]|\]|\[|\/|\\\|\"|\|/",$name))
			{
				echo "不要輸入特殊符號^_^";
			}
			else
			{
				if(preg_match("/[ '.,:;*?~`!@#$%^& =)(<>{}]|\]|\[|\/|\\\|\"|\|/",$pw))
				{
					echo "不要輸入特殊符號^_^";
				}
				else
				{
					$sql="SELECT * FROM personal_data WHERE user_id='".$id."'";
					$result=pg_query($link,$sql);
						
					$pw=password_hash($_POST["pw"],PASSWORD_DEFAULT);
						
						
					$sql="UPDATE personal_data SET name='" .$name."' , password='".$pw."' WHERE user_id='".$id."'";
						
						if(pg_query($link,$sql))
						header("Location: logout.php");	
						else
						echo "失敗";
					
				}
				
					
				
				
				pg_close($link);
			}
		}
		
	
	?>
	</div>
	
</body>
</html>
	


