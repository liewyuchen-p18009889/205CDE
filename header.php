<?php
	session_start();
	
	$errorsArr = array();
	
	if(isset($_POST['submittedLogin'])){
		$username = $_POST['usernameLogin'];
		$password = $_POST['passwordLogin'];
		
		//ensure form fields are filled properly
		if(empty($username)){
			array_push($errorsArr, "Username is required! Please try again!");
		}
		if(empty($password)){
			array_push($errorsArr, "Password is required! Please try again!");
		}
		if((!empty($username)) && (!empty($password)) && ($username != 'admin') && ($password != 'admin')){
			array_push($errorsArr, "Incorrect username or password! Please try again!");
		}
		
		//no errors
		if(count($errorsArr) == 0){
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in!";
			header('Location: /205CDE/Assignment/manageNews.php');
		}
	}
	
	//logout
	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['username']);
		header('Location: /205CDE/Assignment/home.php');
	}
?>
<div class="container-fluid" style="background: #1f52a3;" id="header">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-8">
			<a href="/205CDE/Assignment/home.php"><h1 style="text-align: center; color: #e6e8eb; margin: 20px 0;">U Chen Daily</h1></a>
		</div>
		<div class="col-2 d-flex justify-content-center align-items-center">
			<?php if(isset($_SESSION['username'])){ ?>
				<div class="dropdown">
					<a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user"></i>
					</a>
					<div class="dropdown-menu shadow bg-white rounded" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="/205CDE/Assignment/manageNews.php" target="_blank"><i class="fas fa-user-cog" style="color: #1f52a3"></i>&nbsp;Manage News</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="/205CDE/Assignment/home.php?logout='1'"><i class="fas fa-sign-out-alt" style="color: #1f52a3"></i>&nbsp;Logout</a>
					</div>
				</div>
				<?php }else{ 
				?>
				<button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#loginFormModal">LOGIN</button>
			<?php } ?>
			<!--<a href="/205CDE/Assignment/manageNews.php" target="_blank" class="btn btn-outline-light">LOGIN</a>-->
		</div>
	</div>
</div>
<!--login form modal START-->
<!-- Modal -->
<div class="modal fade" id="loginFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Login</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/205CDE/Assignment/home.php" method="post" id="loginModalForm">
				<div class="modal-body">
					<?php
						if(count($errorsArr) > 0){?>
						<div class="form-group">
							<?php
								foreach($errorsArr as $errorMsg){
									//echo "<p class=\"text-danger\">$errorMsg</p>";
									echo "<script>alert(\"$errorMsg\")</script>";
								}
							?>
						</div>
						<?php }
					?>
					<div class="form-group">
						<label for="exampleInputEmail1">Username</label>
						<input type="text" class="form-control" name="usernameLogin" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" value="<?php if(isset($username)){echo $username;} ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" name="passwordLogin" id="exampleInputPassword1" placeholder="Enter password">
					</div>
					<br>
					<div class="form-group">
						<button type="submit" class="btn btn-lg btn-block text-light" style="background: #1f52a3;">LOGIN</button>
						<input type="hidden" name="submittedLogin">
					</div>
				</div>
				<!--<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Login</button>
				</div>-->
			</form>
		</div>
	</div>
</div>
<!--login form modal END-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="/205CDE/Assignment/home.php"><i class="fas fa-home" style="font-size: 30px; color: #1f52a3;"></i></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item" style="margin: 0 15px;">
				<a class="nav-link" href="/205CDE/Assignment/newsList.php" target="_blank">All News</a>
			</li>
			<li class="nav-item" style="margin: 0 15px;">
				<a class="nav-link" href="/205CDE/Assignment/aboutUs.php" target="_blank">About Us</a>
			</li>
			<li class="nav-item" style="margin: 0 15px;">
				<a class="nav-link" href="/205CDE/Assignment/contactUs.php" target="_blank">Contact Us</a>
			</li>
			<li class="nav-item" style="margin: 0 15px;">
				<a class="nav-link" href="/205CDE/Assignment/faqs.php" target="_blank">FAQs</a>
			</li>
			<!-- <li class="nav-item"> -->
			<!-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
			<!-- </li> -->
		</ul>
		<!-- <form class="form-inline my-2 my-lg-0"> -->
		<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
		<!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
		<!-- </form> -->
	</div>
</nav>