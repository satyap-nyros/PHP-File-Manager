<!DOCTYPE html>

<html>
	<head>
		<title>PHP FILE MANAGER</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
    	
    		<!-- Bootstrap 
    		
    		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">		
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/Style.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" media="screen">
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="bootstrap/js/jquery-ui.js"></script>-->
		
	</head>
	<body onload=showArray()>
		<div class="container content">
			<header>
	      			<div class="span12">
					<h1>PHP FILE MANAGER</h1>
				</div>
			</header>
			
			<div class="PageContent">
			<?php include 'topbar.php' ?>

			<form enctype="multipart/form-data" method="POST" class="form-horizontal" style="margin-top:30px;margin-left:100px;">
				<div class="control-group">
		    			<label class="control-label" for="selectfile"><b>Please Select File</b></label>
		    			<div class="controls">
	   					<input type="file" name="file" id="file">
						<input type="submit" class="btn btn-primary" value="Upload File" name="submit">
		    			</div>
		    		</div>					    	
			</form>
			
			<?php
				ob_start();
				include('SimpleImage.php');
				$resizeImg50="";
				$resizeImg100="";
				$MainImg=""; 
				if(isset($_POST['submit']) ) 
				{
					$uploadfile = basename($_FILES['file']['name']); 
				        $filetype = $_FILES['file']['type'];
					if($filetype == "image/gif" || $filetype == "image/jpeg" || $filetype == "image/png")
					{
						$ImgPath = pathinfo($uploadfile);
						$ImgName = $ImgPath['filename'];
						if (!file_exists("uploadImages"))
						{
							mkdir("uploadImages", 0777);
						}
						if (move_uploaded_file($_FILES['file']['tmp_name'], "uploadImages/".$uploadfile)) 
						{
						   	$path = "uploadImages/".$uploadfile;
							$MainImg = $path;
							resize_fifty($path,$ImgName);
							resize_Hundred($path,$ImgName);	
							Success("Image");
							ShowImages();
						}
					}
					else if($filetype == "text/plain" || $filetype == "application/octet-stream")
					{
						if (!file_exists("uploadFiles"))
						{
							mkdir("uploadFiles", 0777);
						}
						if(move_uploaded_file($_FILES['file']['tmp_name'], "uploadFiles/".$uploadfile)) 
						{
							Success("File");
							CropError();
						}
						else
						{
							echo "Error in file upoad..Please try again...!";
						}
					}
					else
					{
						echo "<div class='alert alert-error' style='margin-top:30px;width:350px;margin-left:300px;'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
					    	Wrong file selection. Please select Text files only..
						</div><br>";
					}
				}
			?>

			<?php
				function resize_fifty($path,$ImgName)
				{
					global $resizeImg50;
					$image = new SimpleImage(); 
					$image->load($path); 
					$image->resize(50,50); 
					if (!file_exists("resize"))
					{
						mkdir("resize", 0777);
					}
					$resizeImg = "resize/"."50X50".$ImgName;
					$resizeImg50=$resizeImg;
					$image->save($resizeImg);
				}
				function resize_Hundred($path,$ImgName)
				{
					global $resizeImg100;
					$image = new SimpleImage(); 
					$image->load($path); 
					$image->resize(100,100); 
					if (!file_exists("resize"))
					{
						mkdir("resize", 0777);
					}
					$resizeImg = "resize/"."100X100".$ImgName;
					$resizeImg100=$resizeImg;
					$image->save($resizeImg);
				}
				function Success($upload)
				{
					
					echo "<div class='alert alert-success'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
					    	<strong>Success!</strong> $upload uploaded successfully.
					</div><br>";
				}

				function CropError()
				{
					
					echo "<div class='alert alert-error' style='margin-top:-30px;width:200px;margin-left:300px;'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
					    	Cropping is not applicable.
					</div><br>";
				}
			?>
			<?php function ShowImages()
			{
				global $resizeImg100,$resizeImg50,$MainImg;
				echo "<div class='Orig'>
					<figure>
 					  <img src='$MainImg' alt='Original Pic' />
					  <figcaption>Original Image</figcaption>
					</figure> 
				</div>";
				echo "<div class = 'resizeImg'>";
				echo "<div class='large'>
					<figure>
 					  <img src='$resizeImg100' alt='large Pic' />
					  <figcaption>Image 100 X 100</figcaption>
					</figure> 
				</div>";				

				echo "<div class='small'>
					<figure>
 					  <img src='$resizeImg50' alt='small Pic' />
					  <figcaption>Image 50 X 50</figcaption>
					</figure> 
				</div>";
				echo "</div>";
			}
			?>


		   </div>
		</div>
	</body>
</html>

