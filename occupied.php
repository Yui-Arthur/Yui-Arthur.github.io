<!DOCTYPE html>
<html lang="zh-Hant-TW">
	
<head>
	<title>team</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta  charset="utf-8" />
	<link rel="icon" href="favicon.jpg" type="image/x-icon">
  
    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	
	<link rel="stylesheet" href="anime-master\documentation\assets\css\documentation.css">
	
	<link rel="stylesheet" href="static/css/style.css">
	
    
    <link href="static/css/all.css" rel="stylesheet">
</head>

<body>
    
	
	<!-- 加入樣式表 -->
	<link rel="stylesheet" href="static/css/team_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css"
		integrity="sha512-uCQmAoax6aJTxC03VlH0uCEtE0iLi83TW1Qh6VezEZ5Y17rTrIE+8irz4H4ehM7Fbfbm8rb30OkxVkuwhXxrRg=="
		crossorigin="anonymous" />
	<!-- JS函式庫 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"
		integrity="sha512-VHsNaV1C4XbgKSc2O0rZDmkUOhMKPg/rIi8abX9qTaVDzVJnrDGHFnLnCnuPmZ3cNi1nQJm+fzJtBbZU9yRCww=="
		crossorigin="anonymous"></script>
		
	<script src="anime-master/lib/anime.min.js"></script>
     
	 <div class="page-content p-4" style="z-index: 100;">
    
    <?php
		session_start();
		
		//檢查是否登入
		if($_SESSION['team']=='')
		header("Location: logout.php");
	
		
		//echo "成功登入<br>".$_SESSION['user'];
		
		//連接資料庫
		$host="host=ec2-107-22-245-82.compute-1.amazonaws.com";
		$user="user=lntmwnajpnrsuu";
		$password="password=028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac";
		$dataname="dbname=d7eeaut5vsohsq";
		$port="port=5432";
		$URL="postgres://lntmwnajpnrsuu:028ad9b79bccced52ba347deafc89d9945f5b1f72f397737ee41ddef29e55cac@ec2-107-22-245-82.compute-1.amazonaws.com:5432/d7eeaut5vsohsq";
		
		
	?>
	

		
	
		<figure class="text-center">
	
		<?php
					//顯示小隊
					
					
					if($_SESSION['team']=='A')
					echo "<h1>害羞幽靈隊</h1>";
				
					if($_SESSION['team']=='B')
					echo "<h1>栗寶寶隊</h1>";
				
					if($_SESSION['team']=='C')
					echo "<h1>魷魷隊</h1>";
					
					if($_SESSION['team']=='D')
					echo "<h1>慢慢龜隊</h1>";
				
					if($_SESSION['team']=='E')
					{
						echo "<h1>工作人員隊</h1>";
						echo "<img class='mb-4' src='image/team".$_SESSION['team']. ".png' alt='' width='300' height='150' > ";
					}
					
					if($_SESSION['team']!='E')
					echo "<img class='mb-4' src='image/team".$_SESSION['team']. ".jpg' alt='' width='150' height='170'> ";
					
					$link=pg_connect("$host $port $dataname $user $password");
					
					if(!$link)
					{
						echo "erro";
						exit();
					}
					
					pg_close($link);
					
		?>
	
		
	
		</figure>
		
	
				
		
		
	
    <div class="mb-4">
        <div class="card shadow" style="border-radius: 25px ;background-color:rgba(255,255 ,255 , 0.75);">
            
                
			

					
					
            
				
                
           
        </div>  
    </div>  
	

    

	<figure class="text-center">
	<button class="w-10 btn btn-lg btn-primary" type="submit" style="background-color:#f7f7f8;color: black;">	<a href="team_information.php">首頁</a></button>
	</figure>

	<br>

	



	</div>


	
	
</body></html>

