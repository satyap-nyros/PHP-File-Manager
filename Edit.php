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
		<script src="bootstrap/js/JsScript.js"></script>    -->
	</head>
	<body onload="GetData()">
		<div class="container content">
			<header>
	      			<div class="span12">
					<h1>PHP FILE MANAGER</h1>
				</div>
			</header>
			<div class="PageContent">
				<?php ob_start(); include 'topbar.php' ?>
				<div style="float:left;">
    					<p><b><i>File Preview...</i></b></p>
					
					<?php 
					        $content;
						$fileName = $_GET["choose"];
						$file = fopen($fileName, "r") or exit("Unable to open file!");
						//Output a line of the file until the end is reached
						while(!feof($file))
						{
						   $content = $content.fgets($file);
						}
						fclose($file);	
					?>
<textarea rows="10" id="FileContent" wrap="physical" style="resize: none; width:500px; float:left; width:350px; height:330px;background:white;border:1px solid black;" readonly><?php echo $content;?></textarea>

				</div>
				<div style="float:left;margin-left:50px;">
    					<p><b><i>Add Content...</i></b></p>
					<form method="post" action=''>	
					<textarea rows="10" id="AddData" wrap="physical" style="resize: none; width:500px;" name="AddData" onkeyup='Copy(event)'></textarea><br>							
					<input type="submit" class="btn btn-primary" value="cancel" name="submit">
					<input type="submit" class="btn btn-primary" value="Save Changes" name="submit">
				</div>
				</form>
			</div>
			<?php
				if(isset($_POST['submit']))
				{ 
					$Act = $_POST["submit"];	
					if($Act == 'cancel')
					{
						header("location: old.php");
					}
					else
					{
						$myFile = $fileName;
						$newData = $_POST['AddData'];
						$fh = fopen($myFile, 'a') or die("can't open file");
						
						$stringData = $newData."\n";
						
						fwrite($fh, $stringData);
						fclose($fh);
						header("location: Edit.php?choose=$fileName");					
					}
				}
			?>
			
	</body>
</html>

