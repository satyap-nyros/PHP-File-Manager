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
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="bootstrap/js/JsScript.js"></script> -->
	</head>
	<body>
		<div class="container content">
			<header>
	      			<div class="span12">
					<h1>PHP FILE MANAGER</h1>
				</div>
			</header>
			
			<div class="PageContent">
			
			<?php ob_start(); include 'topbar.php' ?>
				<form method="post" action=''>
					
					<table class="table table-striped">
						<?php
						$dir="uploadFiles/";

						$files = glob($dir."*");
						
						foreach ($files as $file) 
						{
							if(mime_content_type($file) == 'text/plain')
							{
								$FileName = end(explode("/", $file));  
								echo "<tr><td>
									<input type='radio' name='choose' value='$file'>
									$FileName</td></tr>";
							}
						}						
						?>
					</table>
					<input type="submit" class="btn btn-primary" value="Edit" name="submit">
					<input type="submit" class="btn btn-primary" value="Delete" name="submit">
				</form>
			</div>
			<?php
				if(isset($_POST['submit']))
				{ 
					$Act = $_POST["submit"];	
					$fileName = $_POST['choose'];
					echo $file;
					if($Act == 'Edit')
					{
						if(!$fileName == "")
						header("location: Edit.php?choose=$fileName");
					}
					else
					{
						$fileName = $_POST['choose'];
					 	unlink($fileName);
						header("location: old.php");
					}
				}
			?>
	</body>
</html>

