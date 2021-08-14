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
		<br>
		
		<svg id="demo-svg" width="300" height="200">
		<path stroke="white" stroke-width="1" fill="none" d="M64.213,34.124l-6.294-.035L57.838,48.766a166.965,166.965,0,0,0,.613,16.866l-0.177.051a108.513,108.513,0,0,0-7.222-13.207L39.389,33.988l-7.412-.041L31.759,73.761,38.053,73.8l0.082-14.885c0.038-6.974-.051-12.127-0.376-17.177l0.236-.051a123.507,123.507,0,0,0,7.4,13.52L57.112,73.9l6.883,0.038Zm41.056,0.225-6.823-.037-0.132,24.1c-0.044,7.911-3.592,11.326-9.239,11.3-5.177-.028-8.864-3.432-8.82-11.394l0.132-24.1-6.824-.038-0.13,23.732C73.368,69.774,79.577,74.6,88.812,74.647,98.4,74.7,105.075,69.74,105.14,57.926Zm24.493,17.1L144.62,34.566l-8.294-.046-11.667,14.2c-1.066,1.4-2.192,2.85-3.259,4.406h-0.177l0.1-18.684-6.765-.037-0.218,39.813,6.764,0.037,0.081-14.624,3.787-4.143L137.343,74.34l7.941,0.044ZM190.9,68.7a22.4,22.4,0,0,1-8.125,1.361c-9.295-.051-15.03-5.547-14.976-15.331,0.057-10.357,6.556-15.526,15.262-15.478a20.589,20.589,0,0,1,7.875,1.5l1.5-4.936c-1.232-.579-4.4-1.586-9.579-1.614-12.471-.068-22.159,7.269-22.233,20.8-0.07,12.7,8.3,20.083,20.831,20.152a28.809,28.809,0,0,0,10.6-1.607Zm30.824-32.515a23.219,23.219,0,0,0-9.461-1.874c-8.941-.049-14.673,4.656-14.708,10.953-0.029,5.413,4.48,9.028,11.173,11.459,5.342,2.007,7.625,4.1,7.606,7.484C216.317,67.8,213.3,70.23,207.95,70.2a21.637,21.637,0,0,1-9.752-2.4l-1.557,5.04c2.17,1.313,6.634,2.431,10.87,2.454,10.117,0.056,15.733-4.91,15.77-11.572,0.03-5.465-3.422-8.971-10.642-11.821-5.694-2.217-8.214-3.9-8.2-7.279,0.014-2.55,2.265-5.3,7.618-5.267a18.331,18.331,0,0,1,7.99,1.813Zm8.785,38.666,6.824,0.037,0.218-39.813-6.823-.037Zm40.733-4.825-17.706-.1,0.072-13.219L269.375,56.8l0.028-5-15.765-.087,0.063-11.5L270.407,40.3l0.028-5.048-23.53-.129-0.218,39.814,24.529,0.135ZM53.057,159.018a22.393,22.393,0,0,1-8.125,1.361c-9.294-.051-15.029-5.547-14.975-15.332,0.057-10.356,6.556-15.525,15.262-15.477a20.58,20.58,0,0,1,7.875,1.5l1.5-4.936c-1.232-.579-4.4-1.585-9.58-1.614-12.471-.068-22.158,7.269-22.233,20.8-0.07,12.7,8.3,20.083,20.832,20.152a28.814,28.814,0,0,0,10.6-1.607Zm27.007-33.733-8.353-.046L57.727,164.977l7,0.039,3.947-11.689L82.439,153.4l3.995,11.732,7.177,0.039ZM69.758,148.7L73.4,138.26c0.778-2.442,1.5-5.353,2.16-7.795h0.118c0.634,2.449,1.383,5.264,2.192,7.87l3.472,10.429Zm70.657-23.137-8.53-.047-6.625,17.451c-1.792,4.935-3.229,9.455-4.37,13.716h-0.176c-1.094-4.377-2.423-8.809-4.043-13.71L110.414,125.4l-8.47-.047L98.666,165.2l6.353,0.035,1.09-16.441c0.384-5.566.771-11.862,0.916-16.8H107.2a150.19,150.19,0,0,0,4.446,15.221l6.079,17.729,5.118,0.028,6.805-18.022c1.91-5.038,3.7-10.129,5.081-14.805h0.177c-0.086,4.944.233,11.087,0.5,16.5l0.908,16.763,6.588,0.037Zm10.66,39.926,6.764,0.037,0.086-15.613a21.538,21.538,0,0,0,3.822.281c8.118,0.044,16.842-3.239,16.895-12.919a10.507,10.507,0,0,0-4.011-8.609c-2.695-2.149-6.865-3.213-12.4-3.243a71.349,71.349,0,0,0-10.945.72Zm6.957-34.989a26.8,26.8,0,0,1,4.59-.339c5.471,0.03,9.222,2.5,9.195,7.337-0.028,5.1-3.808,7.942-10.043,7.908a15.821,15.821,0,0,1-3.822-.334Zm27.452,35.177,6.824,0.038,0.218-39.814-6.823-.037Zm48.63-39.547-6.294-.035-0.081,14.676a167.136,167.136,0,0,0,.613,16.867l-0.176.051a108.613,108.613,0,0,0-7.222-13.208L209.29,125.994l-7.412-.04-0.218,39.813,6.294,0.035,0.082-14.885c0.038-6.974-.052-12.127-0.377-17.177l0.236-.051a123.447,123.447,0,0,0,7.4,13.521l11.722,18.7,6.882,0.038Zm41.661,18.6-14.353-.078-0.026,4.84,7.764,0.042L269.1,160.777a15.992,15.992,0,0,1-6,.8c-8.824-.048-14.971-5.39-14.916-15.435,0.056-10.1,6.731-15.212,15.966-15.161a23.426,23.426,0,0,1,8.933,1.558l1.557-4.936a28.132,28.132,0,0,0-10.462-1.723c-13.47-.074-23.1,7.576-23.172,20.483-0.035,6.349,2.361,20.05,21.832,20.157a41.961,41.961,0,0,0,12.835-1.959Z"</path>
		</svg>
	
		</figure>
		
	
	
		
	<script>
	anime({
	  targets: '#demo-svg path',
	  strokeDashoffset: [anime.setDashoffset, 0],
	  easing: 'easeInOutSine',
	  duration: 20000,
	  direction: 'alternate',
	  loop: true
	});
	</script>
		
	
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

