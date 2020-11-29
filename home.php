<html lang="en">
	<head>
		<!--using external files-->
		<?php require('import.html'); ?>
		
		<title>U Chen Daily | Home</title>
	</head>
	<style>
		@media only screen and (min-width: 893px) {
		.card-img-top{
		width: 100%;
		height: 15vw; 
		object-fit: cover;
		}
		}
		
		.card-body{
		background: #1f52a3;
		}
		
		.card-footer{
		background: #1f52a3;
		}
		
		.h5{
		color: #1f52a3;
		}
		
		.card-text{
		font-size: 12px;
		}
	</style>
	<body class="bg-light">
		<!--using external files-->
		<?php require('header.php'); ?>
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
				<a href="https://www.tngdigital.com.my/citiwin" target="_blank">
					<img src="https://cdn-web.tngdigital.com.my/images/CitiWinWhatYouWant/CitiWin_Web_Banner.jpg" class="d-block w-100" alt="...">
				</a>
				</div>
				<div class="carousel-item">
					<a href="https://www.tngdigital.com.my/boss-rfid" target="_blank">
					<img src="https://cdn-web.tngdigital.com.my/images/RFID-BOSS-2020/RFID_BOSS_Web_Banner.jpg" class="d-block w-100" alt="...">
				</a>
				</div>
				<div class="carousel-item">
				<a href="https://www.tngdigital.com.my/reload-pin-redemption-via-points" target="_blank">
					<img src="https://cdn-web.tngdigital.com.my/images/reload-pin-redemption-via-points/30102020/BanksConvertPoints_Web_Banner2.jpg" class="d-block w-100" alt="...">
				</a>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<!--4 latest news START-->
		<div class="container-fluid bg-light" style="padding: 40px 0 0;">
			<div class="row" style="margin: 0 50px;">
				<div class="col-6">
					<h5 style="color: #1f52a3;">Latest News</h5>
				</div>
				
				<div class="col-6 d-flex justify-content-end">
					<a href="/205CDE/Assignment/newsList.php" class="btn btn-link font-weight-bold" style="color: #1f52a3;">MORE NEWS <i class="fas fa-angle-double-right" style="font-size: 18px;"></i></a>
				</div>
			</div>
			<hr>
			<div class="card-deck" style="margin: 10px 50px;">
				<?php
					$dbc = mysqli_connect('localhost', 'root', '');	//connect database
					mysqli_select_db($dbc, 'news');	//select database
					
					$query = 'SELECT * FROM news ORDER BY news_datetime DESC LIMIT 4';
					$runQuery = mysqli_query($dbc, $query);
				?>
				<!--news card START-->
				<?php
					if($runQuery){
						foreach($runQuery as $row){
						?>
						<div class="card mb-4 shadow bg-white rounded">
							<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id'] ?>">
								<img class="card-img-top" 
								src="<?php 
									if(empty($row['news_image'])){
										echo 'https://via.placeholder.com/350x250';
										}else{
										echo $row['news_image'];
									}
								?>" alt="Card image cap">
							</a>
							<div class="card-body">
								<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id']; ?>">
									<h5 class="card-title text-uppercase text-light d-md-none d-lg-block">
										<?php 
											if(strlen($row['news_title']) > 50){
												echo substr($row['news_title'], 0, 50).'...';
												}else{
												echo $row['news_title'];
											}
										?>
									</h5>
									<h5 class="card-title text-uppercase text-light d-none d-md-block d-lg-none">
										<?php 
											if(strlen($row['news_title']) > 106){
												echo substr($row['news_title'], 0, 106).'...';
												}else{
												echo $row['news_title'];
											}
										?>
									</h5>
								</a>
							</div>
							<div class="card-footer border-0">
								<div class="row">
									<div class="col-6 card-text text-light text-uppercase"><i class="fas fa-hashtag"></i>
										<?php echo $row['news_category']; ?>
									</div>
									<div class="col-6 card-text text-light text-right text-uppercase"><i class="far fa-clock"></i>
										<?php echo date('d-M-Y', strtotime($row['news_datetime']));?>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100 d-none d-sm-block d-lg-none"><!-- wrap every 2 on sm--></div>
						<?php
						}
						}else{
						echo "ERROR! No record found!";
					}
					mysqli_close($dbc);
				?>
				<!--news card END-->
			</div>
		</div>
		<!--4 latest news END-->
		<!--4 nation news START-->
		<div class="container-fluid bg-light" style="padding: 20px 0 0;">
			<div class="row" style="margin: 0 50px;">
				<div class="col-sm">
					<h5 style="color: #1f52a3;">Nation News</h5>
				</div>
				<div class="col-sm"></div>
				<div class="col-sm"></div>
			</div>
			<hr>
			<div class="card-deck" style="margin: 10px 50px;">
				<?php
					$dbc = mysqli_connect('localhost', 'root', '');	//connect database
					mysqli_select_db($dbc, 'news');	//select database
					
					$query = 'SELECT * FROM news WHERE news_category="Nation" ORDER BY news_datetime DESC LIMIT 4';
					$runQuery = mysqli_query($dbc, $query);
				?>
				<!--news card START-->
				<?php
					if($runQuery){
						foreach($runQuery as $row){
						?>
						<div class="card mb-4 shadow bg-white rounded">
							<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id'] ?>">
								<img class="card-img-top" 
								src="<?php 
									if(empty($row['news_image'])){
										echo 'https://via.placeholder.com/350x250';
										}else{
										echo $row['news_image'];
									}
								?>" alt="Card image cap">
							</a>
							<div class="card-body">
								<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id']; ?>">
									<h5 class="card-title text-uppercase text-light d-md-none d-lg-block">
										<?php 
											if(strlen($row['news_title']) > 50){
												echo substr($row['news_title'], 0, 50).'...';
												}else{
												echo $row['news_title'];
											}
										?>
									</h5>
									<h5 class="card-title text-uppercase text-light d-none d-md-block d-lg-none">
										<?php 
											if(strlen($row['news_title']) > 106){
												echo substr($row['news_title'], 0, 106).'...';
												}else{
												echo $row['news_title'];
											}
										?>
									</h5>
								</a>
							</div>
							<div class="card-footer border-0">
								<div class="row">
									<div class="col-6 card-text text-light text-uppercase"><i class="fas fa-hashtag"></i>
										<?php echo $row['news_category']; ?>
									</div>
									<div class="col-6 card-text text-light text-right text-uppercase"><i class="far fa-clock"></i>
										<?php echo date('d-M-Y', strtotime($row['news_datetime']));?>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100 d-none d-sm-block d-lg-none"><!-- wrap every 2 on sm--></div>
						<?php	
						}
						}else{
						echo "ERROR! No record found!";
					}
					mysqli_close($dbc);
				?>
				<!--news card END-->
			</div>
		</div>
		<!--4 nation news END-->
		<!--4 world news START-->
		<div class="container-fluid bg-light" style="padding: 20px 0 0;">
			<div class="row" style="margin: 0 50px;">
				<div class="col-sm">
					<h5 style="color: #1f52a3;">World News</h5>
				</div>
				<div class="col-sm">
				</div>
				<div class="col-sm">
				</div>
			</div>
			<hr>
			<div class="card-deck" style="margin: 10px 50px;">
				<?php
					$dbc = mysqli_connect('localhost', 'root', '');	//connect database
					mysqli_select_db($dbc, 'news');	//select database
					
					$query = 'SELECT * FROM news WHERE news_category="World" ORDER BY news_datetime DESC LIMIT 4';
					$runQuery = mysqli_query($dbc, $query);
				?>
				<!--news card START-->
				<?php
					if($runQuery){
						foreach($runQuery as $row){
						?>
						<div class="card mb-4 shadow bg-white rounded">
							<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id'] ?>">
								<img class="card-img-top" 
								src="<?php 
									if(empty($row['news_image'])){
										echo 'https://via.placeholder.com/350x250';
										}else{
										echo $row['news_image'];
									}
								?>" alt="Card image cap">
							</a>
							<div class="card-body">
								<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id']; ?>">
									<h5 class="card-title text-uppercase text-light d-md-none d-lg-block">
										<?php 
											if(strlen($row['news_title']) > 50){
												echo substr($row['news_title'], 0, 50).'...';
												}else{
												echo $row['news_title'];
											}
										?>
									</h5>
									<h5 class="card-title text-uppercase text-light d-none d-md-block d-lg-none">
										<?php 
											if(strlen($row['news_title']) > 106){
												echo substr($row['news_title'], 0, 106).'...';
												}else{
												echo $row['news_title'];
											}
										?>
									</h5>
								</a>
							</div>
							<div class="card-footer border-0">
								<div class="row">
									<div class="col-6 card-text text-light text-uppercase"><i class="fas fa-hashtag"></i>
										<?php echo $row['news_category']; ?>
									</div>
									<div class="col-6 card-text text-light text-right text-uppercase"><i class="far fa-clock"></i>
										<?php echo date('d-M-Y', strtotime($row['news_datetime']));?>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100 d-none d-sm-block d-lg-none"><!-- wrap every 2 on sm--></div>
						<?php
						}
						}else{
						echo "ERROR! No record found!";
					}
					mysqli_close($dbc);
				?>
				<!--news card END-->
			</div>
		</div>
		<!--4 world news END-->
		<!--4 sport news START-->
		<div class="container-fluid bg-light" style="padding: 20px 0 0; margin-bottom: 40px;">
			<div class="row" style="margin: 0 50px;">
				<div class="col-sm">
					<h5 style="color: #1f52a3;">Sport News</h5>
				</div>
				<div class="col-sm">
				</div>
				<div class="col-sm">
				</div>
			</div>
			<hr>
			<div class="card-deck" style="margin: 10px 50px;">
				<?php
					$dbc = mysqli_connect('localhost', 'root', '');	//connect database
					mysqli_select_db($dbc, 'news');	//select database
					
					$query = 'SELECT * FROM news WHERE news_category="Sport" ORDER BY news_datetime DESC LIMIT 4';
					$runQuery = mysqli_query($dbc, $query);
				?>
				<!--news card START-->
				<?php
					if($runQuery){
						foreach($runQuery as $row){
						?>
						<div class="card mb-4 shadow bg-white rounded">
							<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id'] ?>">
								<img class="card-img-top" 
								src="<?php 
									if(empty($row['news_image'])){
										echo 'https://via.placeholder.com/350x250';
										}else{
										echo $row['news_image'];
									}
								?>" alt="Card image cap">
							</a>
							<div class="card-body">
								<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id']; ?>">
									<h5 class="card-title text-uppercase text-light d-md-none d-lg-block">
										<?php 
											if(strlen($row['news_title']) > 50){
												echo substr($row['news_title'], 0, 50).'...';
												}else{
												echo $row['news_title'];
											}
										?>
									</h5>
									<h5 class="card-title text-uppercase text-light d-none d-md-block d-lg-none">
										<?php 
											if(strlen($row['news_title']) > 106){
												echo substr($row['news_title'], 0, 106).'...';
												}else{
												echo $row['news_title'];
											}
										?>
									</h5>
								</a>
							</div>
							<div class="card-footer border-0">
								<div class="row">
									<div class="col-6 card-text text-light text-uppercase"><i class="fas fa-hashtag"></i>
										<?php echo $row['news_category']; ?>
									</div>
									<div class="col-6 card-text text-light text-right text-uppercase"><i class="far fa-clock"></i>
										<?php echo date('d-M-Y', strtotime($row['news_datetime']));?>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100 d-none d-sm-block d-lg-none"><!-- wrap every 2 on sm--></div>
						<?php
						}
						}else{
						echo "ERROR! No record found!";
					}
					mysqli_close($dbc);
				?>
				<!--news card END-->
			</div>
		</div>
		<!--4 sport news END-->
		<!--using external files-->
		<?php require('footer.html'); ?>
	</body>
</html>				