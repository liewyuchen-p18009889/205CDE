<?php	
	$dbc = mysqli_connect('localhost', 'root', '');	//connect database
	mysqli_select_db($dbc, 'news');	//select database
	
	$errorsAddNewsArr = array();
	
	if(isset($_POST['addNewsData'])){
		$newsTitle = trim(str_replace("'", "\'", $_POST['txtNewsTitle']));
		$newsDetails = trim(str_replace("'", "\'", $_POST['txtNewsDetails']));
		$newsCategory = $_POST['selectNewsCategory'];
		
		$targetImage = "/205CDE/Assignment/".basename($_FILES['uploadNewsImg']['name']);
		$newsImage = $_FILES['uploadNewsImg']['name'];
		$newsImageExt = pathinfo($newsImage, PATHINFO_EXTENSION);
		
		//ensure form fields are filled properly
		if(empty($newsTitle)){
			array_push($errorsAddNewsArr, "News title is required! Please try again!");
		}
		if(empty($newsDetails)){
			array_push($errorsAddNewsArr, "News details is required! Please try again!");
		}
		if($newsCategory == "--Select news category--"){
			array_push($errorsAddNewsArr, "News category is required! Please try again!");
		}
		if($_FILES["uploadNewsImg"]["error"] == 4){
			//no upload image
			//uploading news image is not mandatory
		}else{
			//check uploaded image file type
			if($newsImageExt !== 'jpg' && $newsImageExt !== 'jpeg' && $newsImageExt !== 'png' && $newsImageExt !== 'jfif'){
				array_push($errorsAddNewsArr, "Invalid news image file type! Please try again!");
			}
		}
		
		//no errors
		if(count($errorsAddNewsArr) == 0){
			$query = "INSERT INTO news (news_title, news_details, news_category, news_datetime, news_image) 
			VALUES ('$newsTitle', '$newsDetails', '$newsCategory', NOW(), '$newsImage')";
			
			//Move uploaded image into a folder
			move_uploaded_file($_FILES['name']['tmp_name'], $targetImage);
			
			$runQuery = mysqli_query($dbc, $query);
			
			if($runQuery){
				echo '<script> alert("Data saved!"); </script>';
				header('Location: /205CDE/Assignment/manageNews.php');
			}else{
				echo '<script> alert("Data not save yet!"); </script>';
				header('Location: /205CDE/Assignment/manageNews.php');
			}
		}else{
			//display error message in alert
			foreach($errorsAddNewsArr as $errorsAddNewsMsg){
				echo '<script type="text/javascript">alert("'.$errorsAddNewsMsg.'");</script>'; 
			}

			//redirect to manageNews.php
			echo '<script type="text/javascript">window.location.href = "/205CDE/Assignment/manageNews.php";</script>'; 
		}
	}
	mysqli_close($dbc);
?>