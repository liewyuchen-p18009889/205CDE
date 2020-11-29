<?php
	$dbc = mysqli_connect('localhost', 'root', '');	//connect database
	mysqli_select_db($dbc, 'news');	//select database
	
	$errorsUpdNewsArr = array();
	
	if(isset($_POST['updNewsData'])){
		$newsID = $_POST['update_id'];
		$newsTitle = $_POST['txtNewsTitle'];
		$newsDetails = $_POST['txtNewsDetails'];
		$newsCategory = $_POST['selectNewsCategory'];
		
		$targetImage = "/205CDE/Assignment/".basename($_FILES['uploadNewsImg']['name']);
		$newsImage = $_FILES['uploadNewsImg']['name'];
		$newsImageExt = pathinfo($newsImage, PATHINFO_EXTENSION);
		
		//ensure form fields are filled properly
		if(empty($newsTitle)){
			array_push($errorsUpdNewsArr, "News title is required! Please try again!");
		}
		if(empty($newsDetails)){
			array_push($errorsUpdNewsArr, "News details is required! Please try again!");
		}
		if($_FILES["uploadNewsImg"]["error"] == 4){
			//no upload image
			//uploading news image is not mandatory
		}else{
			//check uploaded image file type
			if($newsImageExt !== 'jpg' && $newsImageExt !== 'jpeg' && $newsImageExt !== 'png' && $newsImageExt !== 'jfif'){
				array_push($errorsUpdNewsArr, "Invalid news image file type! Please try again!");
			}
		}
		
		//no errors
		if(count($errorsUpdNewsArr) == 0){
			//ensure no remove the image when updating other data
			if($newsImage != ""){
				$query = "UPDATE news SET news_title='$newsTitle', news_details='$newsDetails', news_category='$newsCategory', news_image='$newsImage' WHERE news_id='$newsID'";
			}else{
				$query = "UPDATE news SET news_title='$newsTitle', news_details='$newsDetails', news_category='$newsCategory' WHERE news_id='$newsID'";
			}
			
			//Move uploaded image into a folder
			move_uploaded_file($_FILES['name']['tmp_name'], $targetImage);
			
			$runQuery = mysqli_query($dbc, $query);
			
			if($runQuery){
				echo '<script> alert("Data updated!"); </script>';
				header('Location: /205CDE/Assignment/manageNews.php');
				}else{
				echo '<script> alert("Data not update yet!"); </script>';
			}
			}else{
			//display error message in alert
			foreach($errorsUpdNewsArr as $errorsUpdNewsMsg){
				echo '<script type="text/javascript">alert("'.$errorsUpdNewsMsg.'");</script>'; 
			}
			
			//redirect to manageNews.php
			echo '<script type="text/javascript">window.location.href = "/205CDE/Assignment/manageNews.php";</script>'; 
		}
	}
	mysqli_close($dbc);
?>