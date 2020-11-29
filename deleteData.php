<?php
	$dbc = mysqli_connect('localhost', 'root', '');	//connect database
	mysqli_select_db($dbc, 'news');	//select database
	
	if(isset($_POST['delNewsData'])){
		$newsID = $_POST['delete_id'];
		
		$query = "DELETE FROM news WHERE news_id='$newsID'";
		
		$runQuery = mysqli_query($dbc, $query);
		
		if($runQuery){
			echo '<script> alert("Data deleted!"); </script>';
			header('Location: /205CDE/Assignment/manageNews.php');
			}else{
			echo '<script> alert("Data not delete yet!"); </script>';
		}
	}
	mysqli_close($dbc); //close database
?>