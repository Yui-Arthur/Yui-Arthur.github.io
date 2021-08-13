<html lang="zh-Hant-TW">
	
<head>
	<title>team</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta  charset="utf-8" />
	<link rel="icon" href="favicon.jpg" type="image/x-icon">
  
    
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <link href="static/css/all.css" rel="stylesheet">
</head>

<body>
    
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
	
	
	
	
	<div class="mb-4">
		<div class="card shadow"  style="border-radius: 25px;" ><!--框框角弧度-->
			<div class="d-flex card-body justify-content-between">
				<div class="tile-header">
				
					<?php
					echo $_SESSION['user'];
					?>
					<form action="team_information.php" method="post">
	
						
	
						<input type="number" name="add_coin" placeholder="0" required="required">
						
						<select name="select_team" required="required">
							<option value="X">選擇小隊</option>
							<option value="A">害羞幽靈小隊</option>
							<option value="B">栗寶寶小隊</option>
							<option value="C">魷魷小隊</option>
							<option value="D">慢慢龜小隊</option>
						</select>
						
						
					
						
					
						<input type="submit">
					</form>
				</div>
			</div>
			<div class="text-white p-1">
				
			</div>
		</div>
	</div>

	
	<?php
		//檢查是否輸入
		if(isset($_POST['add_coin']))
		{
			$select_team=$_POST['select_team'];
			if($select_team!="X")
			{
				
				$add_coin=$_POST['add_coin'];		
				$link=pg_connect("$host $port $dataname $user $password");
				
				//設定時區
				$sql="SET time zone 'ROC'";
				pg_query($link,$sql);
				
				//獲取現在時間
				$sql="SELECT LOCALTIMESTAMP(0)";
				$result=pg_query($link,$sql);	
				$row_result=pg_fetch_assoc($result);
				$today=$row_result['localtimestamp'];
			
				
				$id=$_SESSION['user'];
				//儲存更改紀錄
				$sql="INSERT INTO coin_record (user_id,coin_change,give_team,change_time) VALUES ('$id','$add_coin','$select_team','$today')";
				
				if(pg_query($link,$sql))
				{
					//增加小隊硬幣
					$sql="UPDATE team_coin SET coin_number=coin_number+".$add_coin."WHERE team='".$select_team."'";
					if(!pg_query($link,$sql))
					echo "硬幣增減失敗";
					else
					header("Location: team_information.php");
				
				}
				else
				echo "紀錄儲存失敗";
				
				
				pg_close($link);
				
				
			}
			else
			echo "請選擇小隊";
		
			
		}
		
	?>
	
	
	<form action="team_information.php" method="post">
	
	
		
		<select name="change_team" required="required">
			<option value="X">改變小隊</option>
			<option value="A">A小隊</option>
			<option value="B">B小隊</option>
			<option value="C">C小隊</option>
			<option value="D">D小隊</option>
		</select>
		
	
		<input type="submit">
	</form>
	
	
	
	<?php
		//檢查有沒有送出及是否不為預設值
		if(isset($_POST['change_team'])&&$_POST['change_team']!="X")
		{
			
				$_SESSION['team']=$_POST['change_team'];
				header("Location: team_information.php");
			
		}
	?>
	
		
	
    <div class="mb-4">
        <div class="card shadow" style="border-radius: 25px;">
            <figure class="text-center">
                
                    
				
					
					<?php
					//顯示小隊
					echo "<h1>".$_SESSION['team']."小隊</h1>";
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
					
					
					
					
					<?php
					//顯示金幣
					$link=pg_connect("$host $port $dataname $user $password");
					$sql="SELECT coin_number FROM team_coin WHERE team='".$_SESSION['team']."'";
					
					
					$result=pg_query($link,$sql);
					if($result)
					{
						$row_result=pg_fetch_assoc($result);
						echo "<p class='h2' > <img class='mb-4' src='image/coin.jpg' alt='' width='100' height='100'> " .$row_result['coin_number']."枚金幣</p>";
					}
					else
						echo "連接錯誤";
					
					pg_close($link);
					?>
					
					
					
					
					
			
            
					
                
            </div>
        </div>  
    </div>  


    <div class="mb-4">
        <div class="card shadow" style="border-radius: 25px;">
            <div class="d-flex card-body justify-content-between">
                <div class="tile-header">
                    <caption>發放硬幣紀錄</caption>
                </div>
            </div>
            <div class="card-footer pb-2">
                <table class="table">
                    <thead>
                        <?php
	
							$link=pg_connect("$host $port $dataname $user $password");
							
							//設定時區
							$sql="SET time zone 'ROC'";
							pg_query($link,$sql);
							
							//取得紀錄由時間新到舊
							$sql="SELECT * FROM coin_record ORDER BY change_time DESC";
							$total_result=pg_query($link,$sql);
							
							
							while($row_result=pg_fetch_assoc($total_result))
							{
								//全都靠右
								echo "<tr>";
								//顯示id
								echo "<td align='right'>".$row_result["user_id"]."發送</td>";
								//顯示硬幣改變數量
								echo "<td align='right'>".$row_result["coin_change"]."枚硬幣給</td>";
								echo "<td>".$row_result["give_team"]."小隊</td>";
								
								//取得現在時間和紀錄時間的差值
								$sql="SELECT age (now(),'".$row_result["change_time"]."')";
								$result=pg_query($link,$sql);
								$time_result=pg_fetch_assoc($result);
								
								
								echo "<td align='right'>";
								
								//取得差值的天數
								$sql="SELECT date_part ('DAY',interval '".$time_result['age']."')";
								$result=pg_query($link,$sql);
								$day_result=pg_fetch_assoc($result);
								
								//如果為0就不顯示
								if($day_result['date_part']!=0)
								echo $day_result['date_part']."天";
								
								//取得差值的小時
								$sql="SELECT date_part ('HOUR',interval '".$time_result['age']."')";
								$result=pg_query($link,$sql);
								$hour_result=pg_fetch_assoc($result);
								
								//如果為0就不顯示
								if($hour_result['date_part']!=0)
								echo $hour_result['date_part']."小時";
								
								//取得差值的分鐘
								$sql="SELECT date_part ('MINUTE',interval '".$time_result['age']."')";
								$result=pg_query($link,$sql);
								$minute_result=pg_fetch_assoc($result);
								
								echo $minute_result['date_part']."分鐘前";
								echo "</td>";
								echo "</tr>";
								
							}
							
							pg_close($link);
						?>
                    </thead>
                    <tbody class="justify-content-between">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>          


	<button class="w-10 btn btn-lg btn-primary" type="submit" style="background-color:#f7f7f8;color: black;">	<a href="logout.php">登出</a></button>

	</div>
	
</body></html>

