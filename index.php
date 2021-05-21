<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Hugo 0.79.0">
		
		<link rel="icon" href="favicon.jpg" type="image/x-icon">
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
			</form>

			<br>

			<?php
				session_start();
				
				//檢查有沒有登入過
				if(isset($_SESSION['team']))
					header("Location: team_information.php");
				
						
					
				//檢查是否按下送出
				if(isset($_POST['pw']))
				{
					//連接資料庫
					$host="host=ec2-107-22-245-82.compute-1.amazonaws.com";
					$user="user=lntmwnajpnrsuu";
					$password="password=028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac";
					$dataname="dbname=d7eeaut5vsohsq";
					$port="port=5432";
					$URL="postgres://lntmwnajpnrsuu:028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac@ec2-107-22-245-82.compute-1.amazonaws.com:5432/d7eeaut5vsohsq";
					$link=pg_connect("$host $port $dataname $user $password");
					
					
					//確認是否成功
					if(!$link)
					{
						echo "erro";
						exit();
					}
					
					
				
					//獲得輸入的帳號密碼
					$name=$_POST['username'];	
					$pw=$_POST['pw'];
					
					
					//特殊符號檢查
					if(preg_match("/[ '.,:;*?~`!@#$%^& =)(<>{}]|\]|\[|\/|\\\|\"|\|/",$name))
					{
						echo "不要輸入特殊符號^_^";
						
					}
					else
					{
				
						//查詢帳號
						$sql="SELECT * FROM personal_data WHERE user_id='" . $name ."'";
						$result=pg_query($link,$sql);
						$record=pg_num_rows($result);
						
						//確定有無帳號	
						if($record>0)
						{
							$row_result=pg_fetch_assoc($result);
							//密碼加密檢查
							if(password_verify($pw,$row_result['password']))
							{
								
								$user_id=$row_result['user_id'];
								$user_team=$row_result['team'];
								$user_authority=$row_result['authority'];
								$user_name=$row_result['name'];
								//設定時區
								$sql="SET time zone 'ROC'";
								pg_query($link,$sql);
								
								//獲取現在時間
								$sql="SELECT LOCALTIMESTAMP(0)";
								$result=pg_query($link,$sql);	
								$row_result=pg_fetch_assoc($result);
								$today=$row_result['localtimestamp'];
								
								//id和登入時間放進 login_record 資料庫
								$sql="INSERT INTO login_record (user_id,time) VALUES ('$user_id','$today')";
								
								if(pg_query($link,$sql))
								{
									pg_close($link);
									$_SESSION['user']=$user_id;
									
									if($pw==$name)
									//如果是預設密碼就進入 change_pw
									header("Location: change_pw.php");
									else
									{
										//登入資料紀錄為team
										$_SESSION['team']=$user_team;	
										$_SESSION['authority']=$user_authority;
										$_SESSION['name']=$user_name;
										header("Location: team_information.php");
									}
								}
								else
								echo "錯誤";
							}
							else
							{
							echo "帳號或密碼輸入錯誤";
							pg_close($link);
							}
						}
						else
						{
							echo "帳號或密碼輸入錯誤";
							pg_close($link);
						}
					
					}
					
				}
					
				
			?>
	
			<p class="mt-5 mb-3 text-muted">© 2021-NUK-CSIE-CAMPING</p>
		</div>

	</main>


  


	</body>
</html>