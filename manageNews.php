<html lang="en">
	<head>
		<!--using external files-->
		<?php require('import.html'); ?>
		
		<title>U Chen Daily | Admin</title>
		<!--show news info for editing START-->
		<script type="text/javascript">
			$(document).ready(function(){
				$('.btnEdit').on('click', function(){
					$('#updNewsModal').modal('show');
					
					$tr = $(this).closest('tr');
					
					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();
					
					console.log(data);
					
					$('#update_id').val(data[0]);
					$('#news_datetime').val(data[1]);
					$('#news_title').val(data[2]);
					$('#news_details').val(data[3]);
					$('#news_category').val(data[4]);
					$('#news_image').val(data[5]);
				});
			});
		</script>
		<!--show news info for editing END-->
		
		<!--show confirmation message for deleting START-->
		<script type="text/javascript">
			$(document).ready(function(){
				$('.btnDel').on('click', function(){
					$('#delNewsModal').modal('show');
					
					$tr = $(this).closest('tr');
					
					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();
					
					console.log(data);
					
					$('#delete_id').val(data[0]);
				});
			});
		</script>
		<!--show confirmation message for deleting END-->
		
		<!--show file name after uploading image START-->
		<script type="text/javascript">
            $(document).ready(function() {
                bsCustomFileInput.init();
			});
		</script>
		<!--show file name after uploading image END-->
		<body>
			<!--using external files-->
			<?php require('header.php'); ?>
			<div class="container" style="margin: 20px;">
				<div class="row">
					<div class="col-sm"><h3 style="color: #1f52a3;">Manage News</h3></div>
				</div>
			</div>
			<!--add news modal START-->
			<!-- Modal -->
			<div class="modal fade bd-example-modal-lg" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Add News</h5>
							<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>-->
						</div>
						<form action="/205CDE/Assignment/insertData.php" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<input type="hidden" name="insert_id" id="insert_id">
							<div class="form-group">
								<label for="inputNewsTitle">News Title:</label>
								<input type="text" class="form-control" name="txtNewsTitle" id="inputNewsTitle" aria-describedby="emailHelp" placeholder="Enter news title">
							</div>
							<div class="form-group">
								<label for="selectNewsCategory">News Category:</label>
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
							<div class="form-group mb-3">
								<label for="inputNewsImage" class="col-form-label">News Image:</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" name="uploadNewsImg" id="customFile">
									<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
							</div>
							<div class="form-group">
								<label for="inputNewsDetails" class="col-form-label">News Details:</label>
								<textarea class="form-control" name="txtNewsDetails" id="inputNewsDetails" rows="10"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary" name="addNewsData" style="background: #1f52a3;">Add</button>
						</div>
						</form>
					</div>
				</div>
			</div>
			<!--add news modal END-->
			
			<!--edit news modal START-->
			<!-- Modal -->
			<div class="modal fade bd-example-modal-lg" id="updNewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit News</h5>
							<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>-->
						</div>
						<form action="/205CDE/Assignment/updateData.php" method="post" enctype="multipart/form-data">
							<div class="modal-body">
								<input type="hidden" name="update_id" id="update_id">
								<div class="form-group">
									<label for="txtNewsDatetime">News Created Datetime:</label>
									<input type="text" class="form-control" name="txtNewsDatetime" id="news_datetime" aria-describedby="emailHelp" placeholder="Enter news datetime" disabled>
								</div>
								<div class="form-group">
									<label for="inputNewsTitle">News Title:</label>
									<input type="text" class="form-control" name="txtNewsTitle" id="news_title" aria-describedby="emailHelp" placeholder="Enter news title">
								</div>
								<div class="form-group">
									<label for="selectNewsCategory">News Category:</label>
									<select class="form-control" name="selectNewsCategory" id="news_category">
										<?php
											$newsCategoryArr = array(
											'Nation',	'World',
											'Sport',	'Tech'
											);
											foreach($newsCategoryArr as $newsType){
												echo "<option value=\"$newsType\">$newsType</option>";
											}
										?>
									</select>
								</div>
								<div class="form-group mb-3">
									<label for="inputNewsImage" class="col-form-label">News Image:</label>
									<div class="custom-file">
										<input type="file" class="custom-file-input" name="uploadNewsImg" id="news_image">
										<label class="custom-file-label" for="news_image"></label>
									</div>
								</div>
								<div class="form-group">
									<label for="inputNewsDetails" class="col-form-label">News Details:</label>
									<textarea class="form-control" name="txtNewsDetails" id="news_details" rows="10"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary" name="updNewsData" style="background: #1f52a3;">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--edit news modal END-->
			
			<!--delete news modal START-->
			<!-- Modal -->
			<div class="modal fade" id="delNewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<form action="/205CDE/Assignment/deleteData.php" method="post">
							<div class="modal-body">
								<input type="hidden" name="delete_id" id="delete_id">
								<div class="d-flex justify-content-center" style="margin: 25px 0;">
									<i class="fas fa-times-circle text-danger" style="font-size: 100px;"></i>
								</div>
								<div class="d-flex justify-content-center">
									<h4>Are you sure?</h4>
								</div>
								<div class="d-flex justify-content-center">
									<p class="col-1"></p>
									<p class="col-10" style="text-align: center;">Do you really want to delete this record?<br>This process cannot be undone.</p>
									<p class="col-1"></p>
								</div>
								<div class="row justify-content-around" style="margin: 15px 0;">
									<div class="col-6 d-flex justify-content-end">
										<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
									</div>
									<div class="col-6 d-flex justify-content-start">
										<button type="submit" class="btn btn-danger btn-lg" name="delNewsData">Delete</button>
									</div>
									<input type="hidden" name="delSubmitted" value="true"/>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--delete news modal END-->
			
			<div class="container-fluid bg-light" style="padding: 30px 10px;">
				<div class="row bg-light" style="margin: 0 35px;">
					<div class="col-6">
						<h4 style="color: #1f52a3;">News Info</h4>
					</div>
					<div class="col-6 d-flex justify-content-end">
						<button type="button" class="btn-lg btn-primary" style="background: #1f52a3;" data-toggle="modal" data-target="#addNewsModal"><i class="fas fa-plus" style="font-size: 20px;"></i>&nbsp;Add News</button>
					</div>
				</div>
				<!--news table START-->
				<div class="card-deck shadow-lg bg-white rounded" style="margin: 10px 30px 30px;">
					<?php
						$dbc = mysqli_connect('localhost', 'root', '');	//connect database
						mysqli_select_db($dbc, 'news');	//select database
						
						$query = 'SELECT * FROM news ORDER BY news_datetime DESC';
						$runQuery = mysqli_query($dbc, $query);
					?>
					<table class="table table-hover bg-light p-3 mb-0" id="manageNewsTable">
						<thead class="thead-light">
							<tr>
								<th scope="col">News ID</th>
								<th scope="col">News Created Datetime</th>
								<th scope="col">News Title</th>
								<th scope="col">News Details</th>
								<th scope="col">News Category</th>
								<th scope="col">News Image</th>
								<th scope="col">Edit/Delete</th>
							</tr>
						</thead>
						<?php
							if($runQuery){
								foreach($runQuery as $row){
								?>
								<tbody>
									<tr>
										<td><?php echo $row['news_id']; ?></td>
										<td><small><?php echo $row['news_datetime'];?></small></td>
										<td><?php echo $row['news_title']; ?></td>
										<td><?php echo $row['news_details']; ?></td>
										<td><?php echo $row['news_category']; ?></td>
										<td>
											<a href="<?php 
												if(empty($row['news_image'])){
													echo 'https://via.placeholder.com/111x75';
													}else{
													echo '/205CDE/Assignment/'.$row['news_image'];
												} ?>" target="_blank">
												<img src="<?php 
													if(empty($row['news_image'])){
														echo 'https://via.placeholder.com/111x75';
														}else{
														echo $row['news_image'];
													}?>" alt="Thumbnail News Image" class="img-thumbnail">
												<?php echo $row['news_image']; ?>
											</a>
										</td>
										<td>
											<button type="button" class="btn btn-info btnEdit"><i class="fas fa-edit" style="font-size: 14px;"></i></button>
											<button type="button" class="btn btn-danger btnDel"><i class="fas fa-trash" style="font-size: 14px;"></i></button>
										</td>
									</tr>
								</tbody>
								<?php
								}
								}else{
								echo "ERROR! No record found!";
							}
							mysqli_close($dbc);
						?>
					</table>
				</div>
				<!--news table END-->
			</div>
			<!--using external files-->
			<?php require('footer.html'); ?>
		</body>
	</html>																									