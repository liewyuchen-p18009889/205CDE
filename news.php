<html lang="en">
	<head>
		<!--using external files-->
		<?php require('import.html'); ?>
		
		<title>U Chen Daily | News</title>
	</head>
	<body>
		<!--using external files-->
		<?php require('header.php'); ?>
		<div class="container" style="margin: 20px;">
			<div class="row">
				<div class="col-sm"><h3 style="color: #1f52a3;">News</h3></div>
			</div>
		</div>
		<?php
			$dbc = mysqli_connect('localhost', 'root', '');
			mysqli_select_db($dbc, 'news');
			
			if(isset($_GET['id']) && is_numeric($_GET['id'])){
				$query = "SELECT * FROM news WHERE news_id={$_GET['id']}";
				
				if($r = mysqli_query($dbc, $query)){
					$row = mysqli_fetch_array($r);
				?>
				<div class="container-fluid bg-light" style="padding: 50px 20px">
					<div class="row d-flex justify-content-between" style="margin: 0 50px;">
						<?php if(mysqli_num_rows($r) > 0){ ?>
						<div class="col-lg-8 col-md-12">
							<div class="row mb-3">
								<h2 class="display-4" style="color: #1f52a3;"><?php echo $row['news_title']; ?></h2>
							</div>
							<div class="row">
								<div class="col mb-3" style="font-size: 18px; color:#1f52a3;">
									<i class="far fa-clock"></i>&nbsp
									<?php echo date('d-M-Y', strtotime($row['news_datetime'])); ?>&nbsp;&nbsp;&nbsp;
									<i class="fas fa-tag"></i>&nbsp
									<?php echo strtoupper($row['news_category']); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-12"  style="margin-bottom: 10px;">
									<img class="card-img-top shadow-lg bg-white rounded" src="<?php 
										if(empty($row['news_image'])){
											echo 'https://via.placeholder.com/350x250';
											}else{
											echo $row['news_image'];
										}
									?>" alt="Card image cap" style="width:80%;">
								</div>
								
							</div>
							<div class="row" style="margin: 50px 0; font-size: 20px;">
								<p class="font-weight-normal" style="font-size: 25px;"><?php echo nl2br($row['news_details']); ?></p>
							</div>
						</div>
						<?php }else{ ?>
							<div class="col-lg-8 col-md-12">
							<div class="row mb-3">
								<h2 class="display-2" style="color: #1f52a3;"><i class="fas fa-exclamation-triangle"></i>&nbsp;ERROR 404</h2>
							</div>
							<div class="row">
								<div class="col-12"  style="margin-bottom: 50px;">
									<p class="display-4" style="color: #1f52a3;">The page you’re looking for can’t be found.</p>
								</div>
							</div>
						</div>
						<?php
							}
						}
					}
					mysqli_close($dbc);
				?>
				<?php
					$dbc = mysqli_connect('localhost', 'root', '');	//connect database
					mysqli_select_db($dbc, 'news');	//select database
					
					$query = 'SELECT * FROM news ORDER BY news_datetime DESC LIMIT 5';
					$runQuery = mysqli_query($dbc, $query);
				?>
				<div class="col-lg-4 col-md-12">
					<div class="list-group list-group-flush shadow-lg bg-white rounded" style="border: 2px solid #1f52a3; border-top: 0;">
						<h4 class="list-group-item text-light text-center" style="background: #1f52a3;">Top 5 Latest News</h4>
						<?php
							if($runQuery){
								foreach($runQuery as $row){?>
								<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id']; ?>" class="list-group-item list-group-item-action" target="_blank">
									<div class="row">
										<div class="col-3">
											<img src="<?php 
												if(empty($row['news_image'])){
													echo 'https://via.placeholder.com/200x200';
													}else{
													echo $row['news_image'];
												}?>" alt="Thumbnail News Image" class="img-thumbnail">
										</div>
										<div class="col-8" style="font-size: 15px;">
											<?php echo $row['news_title']; ?><br>
											<span style="color: #1f52a3;"><i class="fas fa-hashtag"></i>&nbsp;<?php echo strtoupper($row['news_category']); ?></span>
										</div>
									</div>
								</a>	
									<?php }
									}else{
									echo "ERROR! No record found!";
								}
								mysqli_close($dbc);
							?>
						</div>
					</div>
				</div>
			</div>
			<!--using external files-->
			<?php require('footer.html'); ?>
		</body>
	</html>	