<!doctype html>
<html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.79.0">
  <title>CSIE Camping</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

  

  <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  
  <!-- Custom styles for this template -->
  <link href="signin.css" rel="stylesheet">
</head>
<body class="text-center">
  
<main class="form-signin" >
<div style="border-color:#86868b;border-style:solid;border-width:2px 2px;padding-left: 20px;padding-right:20px;padding-top: 30px;background-color: white;border-radius:10px;">
<form action="index.php" method="POST"  >
  <img class="mb-4" src="image/brchanghead.jpg" alt="" width="150" height="170"> 
  <h1 class="h3 mb-3 fw-normal">Login</h1>
  
  <input type="text" name="username" id="input" class="form-control" placeholder="Account" required="">
	
  <input type="password" name="pw" id="inputPassword" class="form-control" placeholder="Password" required="">
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="w-100 btn btn-lg btn-primary" type="submit" style="background-color:#EEFFBB;color: black;">登入</button>
  <p class="mt-5 mb-3 text-muted">© 2021-NUK-CSIE-CAMPING</p>
</form>
</div>

<?php
	session_start();
	if(isset($_POST['pw']))
	{
		$host="host=ec2-107-22-245-82.compute-1.amazonaws.com";
		$user="user=lntmwnajpnrsuu";
		$password="password=028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac";
		$dataname="dbname=d7eeaut5vsohsq";
		$port="port=5432";
		$URL="postgres://lntmwnajpnrsuu:028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac@ec2-107-22-245-82.compute-1.amazonaws.com:5432/d7eeaut5vsohsq";

		$link=pg_connect("$host $port $dataname $user $password");
		
		if(!$link)
		{
			echo "erro";
			exit();
		}
		
		$name=$_POST['username'];
		$pw=$_POST['pw'];
		echo "$name   $pw";
		$sql="SELECT * FROM 個人資料 WHERE password='" . $pw ."' AND name='" . $name ."'";
		$result=mysqli_query($link,$sql);
		
		$record=mysqli_num_rows($result);
		
		
		if($record>0)
		{
			$_SESSION['login_session']=true;
			
		}
		else
		{
			$_SESSION['login_session']=false;
			header("Location: session.php");
		}
		
	}
		
	
	?>

</main>


  


</body></html>