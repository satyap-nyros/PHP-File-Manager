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
		<script src="bootstrap/js/JsScript.js"></script>  -->
		<script>
		function ValidEmail()
		{
			var mail = document.getElementById("Email").value;

			var MailPatt = /^([0-9A-z._-])+@([0-9A-z])+\.([0-9A-z]+)$/;
	
			if(MailPatt.test(mail))
			{
				$("#MailSuccess").css("display","block");
				return true;
			}
			else
			{
				$("#MailError").css("display","block");
				return false;
			}
		}
		</script>
	</head>
	<body>
		<div class="container content">
			<header>
	      			<div class="span12">
					<h1>PHP FILE MANAGER</h1>
				</div>
			</header>
			
			<div class="PageContent">
			<?php include 'topbar.php' ?>
				<div style="float:left;">
    					<p><b><i>File Preview...</i></b></p>
					<?php 
					
					$fileName = $_REQUEST["file"];
					$showfile = "uploadFiles/".$fileName; ?>
					<?php 
					
					        echo "<div style='float:left;width:350px;height:330px;border:1px solid black;background:white;padding:5px;overflow-y:auto;'>";

						$file = fopen($showfile, "r") or exit("Unable to open file!");
						//Output a line of the file until the end is reached
						while(!feof($file))
						  {
						  echo fgets($file). "<br>";
						  }
						fclose($file);
						echo "</div>";
					?>
					
				</div>
				<div style="margin-left:50px;float:left;">
    					<p><b><i>Send Mail</i></b></p>
					    <form method="post" action="" onsubmit="return ValidEmail()">
						<input type="text" id="Email" name="Email" placeholder="Email:Eg(mail@gmail.com)"><br>
						<input type="submit" class="btn btn-primary" value="Send" name="submit">
						<?php echo "<input type='hidden' name='file' value='{$fileName}'>";?>
					     </form>
				</div>
				<?php
				$value = $_REQUEST["submit"];
				if($value == "Send")
				{
					$fileName = $_REQUEST['file'];		

					$to = $_REQUEST['Email'];	
					$subject = "PHP File Manager";
					$message = "download the attached file";
					# Open a file
					$downloadfile = "uploadFiles/".$fileName;
					$file = fopen($downloadfile, "r" );
					if( $file == false )
					{
					echo "Error in opening file";
					exit();
					}

					# Read the file into a variable
					$size = filesize($downloadfile);
					$content = fread( $file, $size);

					# encode the data for safe transit
					# and insert \r\n after every 76 chars.
					$encoded_content = chunk_split( base64_encode($content));

					# Get a random 32 bit number using time() as seed.
					$num = md5( time() );
					$SendEmail ="something@domain.com"; // Mail id
					$header = 'From: ' . $SendEmail . "\r\n" .
					'Reply-To: ' . $SendEmail . "\r\n"; 

					# Define the main headers.
					//$header = "From:Gowri\r\n";
					$header .= "MIME-Version: 1.0\r\n";
					$header .= "Content-Type: multipart/mixed; ";
					$header .= "boundary=$num\r\n";
					$header .= "--$num\r\n";

					# Define the message section
					$header .= "Content-Type: text/plain\r\n";
					$header .= "Content-Transfer-Encoding:8bit\r\n\n";
					$header .= "$message\r\n";
					$header .= "--$num\r\n";

					# Define the attachment section
					$header .= "Content-Type:  multipart/mixed; ";
					$header .= "name=\"$fileName\"\r\n";
					$header .= "Content-Transfer-Encoding:base64\r\n";
					$header .= "Content-Disposition:attachment; ";
					$header .= "filename=\"$fileName\"\r\n\n";
					$header .= "$encoded_content\r\n";
					$header .= "--$num--";

					# Send email now
					$retval = mail ( $to, $subject, "", $header );
					if( $retval == true )
					{
//					echo "<div class='alert alert-success' style='width:200px;margin-left:550px;margin-top:150px;'>Mail sent successfully</div>";
					}
				}

				echo "<div class='alert alert-success' id='MailSuccess' style='width:200px;margin-left:550px;margin-top:150px;display:none;'>Mail sent successfully</div>";
				?>

					 <div class='alert  alert-error' id='MailError' style='width:200px;margin-left:550px;margin-top:150px;display:none;'>Plese enter valid email id...</div>
			</div>
	</body>
</html>

