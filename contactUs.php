<html lang="en">
	<head>
		<!--using external files-->
		<?php require('import.html') ?>
		
		<title>U Chen Daily | Contact Us</title>
	</head>
	<style>
		.google-maps {
        position: relative;
        padding-bottom: 50%;
        height: 0;
        overflow: hidden;
		}
		.google-maps iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
		}
		h5 {
		color: #1f52a3;
		margin-top: 35px;
		}
	</style>
	<body>
		<!--using external files-->
		<?php require('header.php'); ?>
		<div class="container" style="margin: 20px;">
			<div class="row">
				<div class="col-sm"><h3 style="color: #1f52a3;">Contact Us</h3></div>
			</div>
		</div>
		<div class="container-fluid bg-light" style="padding: 30px 10px;">
			<div class="row bg-light" style="margin: 0px 35px;">
				<div class="col-12 mt-3 mb-3 google-maps shadow-lg bg-white rounded">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.4919887247825!2d100.2796820147649!3d5.341603796125226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304ac048a161f277%3A0x881c46d428b3162c!2sINTI%20International%20College%20Penang!5e0!3m2!1sen!2smy!4v1606047317819!5m2!1sen!2smy" width="600" height="450" frameborder="0" style="border: 2px solid #1f52a3;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				</div>
			</div>
			<div class="row bg-light" style="margin: 35px 35px 0;">
				<?php 
					$contactInfoArr = array(
					'info@uchendaily.com' => 'far fa-envelope', 
					'+604-577 9999' => 'fas fa-phone-alt', 
					'1-Z, Lebuh Bukit Jambul,<br>Bukit Jambul,<br>11900 Bayan Lepas,Pulau Pinang.' => 'fas fa-map-marker-alt'
					); 
					
					foreach($contactInfoArr as $contactInfo => $contactIcon){
					?>
					<div class="col-4">
						<div class="row bg-light d-flex justify-content-center align-items-center">
							<i class="<?php echo $contactIcon; ?>" style="font-size: 50px; color: #1f52a3;"></i>
						</div>
						<div class="row bg-light d-flex justify-content-center align-items-center">
							<h5 style="text-align: center;"><?php echo $contactInfo; ?></h5>
						</div>
					</div>
					<?php
					}
				?>
			</div>
		</div>
		<!--using external files-->
		<?php require('footer.html'); ?>
	</body>
</html>