<?php
	$dbc = mysqli_connect('localhost', 'root', '');	//connect database
	mysqli_select_db($dbc, 'news');	//select database
	
	//search bar is priority
	//got search word as well as category will priority the search word
	if(isset($_POST['btnSearch']) && !empty($_POST['txtSearch'])){
		$searchNews = preg_replace("#[^0-9a-z]#i", "", $_POST['txtSearch']);
		
		$query = mysqli_query($dbc, "SELECT * FROM news WHERE news_title LIKE '%$searchNews%' ORDER BY news_datetime DESC");
		}else if(isset($_POST['btnSearch']) && empty($_POST['txtSearch'])){
		$searchNewsCategory = $_POST['selectNewsCategory'];
		
		if($searchNewsCategory != "--Select news category--"){
			$query = mysqli_query($dbc, "SELECT * FROM news WHERE news_category='$searchNewsCategory' ORDER BY news_datetime DESC");
			}else{
			$query = mysqli_query($dbc, "SELECT * FROM news ORDER BY news_datetime DESC");
		}
	}
	else{
		$query = mysqli_query($dbc, "SELECT * FROM news ORDER BY news_datetime DESC");
	}
	
	//$runQuery = mysqli_query($dbc, $query);
	$count = mysqli_num_rows($query);
?>
<html lang="en">
	<head>
		<!--using external files-->
		<?php require('import.html'); ?>
		
		<title>U Chen Daily | News List</title>
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
		
		.card-img-top{
		display: block;
		}
		
		#hoverImage{
		position: relative;
		}
		
		#hoverImage:hover .overlay {
		  opacity: 0.3;
		}
		
		.overlay {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		height: 100%;
		width: 100%;
		opacity: 0;
		transition: .5s ease;
		background-color: #292b2c;
		}
		
		.readMore{
			color: white;
			font-size: 20px;
			position: absolute;
			top: 40%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			text-align: center;
		}
	</style>
	<body>
		<!--using external files-->
		<?php require('header.php'); ?>
		<div class="container" style="margin: 20px;">
			<div class="row">
				<div class="col-sm"><h3 style="color: #1f52a3;">News List</h3></div>
			</div>
		</div>
		<div class="container-fluid bg-light" style="padding: 30px 10px;">
			<!--search news START-->
			<form action="/205CDE/Assignment/newsList.php" method="post">
				<div class="row d-flex justify-content-center shadow p-5 rounded" style="margin: 10px 30px 30px; background: #1f52a3;">
					<div class="input-group input-group-lg" style="margin: 0 50px;">
						<input type="text" name="txtSearch" class="form-control" placeholder="Search for..." aria-label="Recipient's username" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button class="btn btn-outline-light" type="submit" name="btnSearch"><i class="fas fa-search"></i>&nbsp;Search</button>
						</div>
					</div>
					<div class="container-fluid" style="margin: 20px 50px 0;">
						<div class="row d-flex justify-content-between">
							<div class="col p-0">
								<div class="form-group">
									<label for="selectNewsCategory"></label>
									<select class="form-control" name="selectNewsCategory" id="selectNewsCategory">
										<?php
											$newsCategoryArr = array(
											'--Select news category--',
											'Nation',	'World',
											'Sport',	'Tech'
											);
											foreach($newsCategoryArr as $newsType){
												echo "<option value=\"$newsType\">$newsType</option>";
											}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!--search news END-->
			<div class="row d-flex justify-content-start shadow p-3 mb-5 bg-white rounded" style="margin: 50px 30px 0;">
				<?php
					if($count == 0){
						echo '<p class="text-secondary">No result found.</p>';
						}else{
						while($row = mysqli_fetch_array($query)){
						?>
						<div class="col-lg-4 col-md-12">
							<div class="card shadow bg-white rounded" style="margin: 20px 20px;" id="hoverImage">
								<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id'] ?>" target="_blank">
									<img class="card-img-top" src="<?php 
										if(empty($row['news_image'])){
											echo 'https://via.placeholder.com/350x250';
											}else{
											echo $row['news_image'];
										}
									?>" alt="Card image cap">
									<div class="overlay">
										<div class="readMore">READ MORE</div>
									</div>
								</a>
								<div class="card-body">
									<a href="/205CDE/Assignment/news.php?id=<?php echo $row['news_id']; ?>" target="_blank">
										<h5 class="card-title text-uppercase text-light d-md-none d-lg-block">
											<?php 
												if(strlen($row['news_title']) > 35){
													echo substr($row['news_title'], 0, 35).'...';
													}else{
													echo $row['news_title'];
												}
											?>
										</h5>
										<h5 class="card-title text-uppercase text-light d-none d-md-block d-lg-none">
											<?php echo $row['news_title']; ?>
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
						</div>
						<?php
						}
					}
					mysqli_close($dbc);
				?>
			</div>
		</div>
		<!--using external files-->
		<?php require('footer.html'); ?>
	</body>
</html>									