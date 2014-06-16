<!DOCTYPE html>

<html>
	<head>
		<title>PHP FILE MANAGER</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
    	
    		<!-- Bootstrap -->
    	
    		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">		
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/Style.css" rel="stylesheet" media="screen">
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="bootstrap/js/JsScript.js"></script>
		
	</head>
	<body>
		<div class="container content">
			<header>
	      			<div class="span12">
					<h1>PHP FILE MANAGER</h1>
				</div>
			</header>

			<div style="margin-left:500px;margin-top:200px;">
				 <a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">PFM  &raquo;</a>
			</div>
		    	<div id="myModal" class="modal hide fade" style="border-radius:20px;" data-backdrop="static">
				<div class="modal-header modalHead">
					<button type="button" class="close" data-dismiss="modal"  style="color:white;">×</button>
					<h3 id="myModalLabel" style="color:white;">PHP File Manager</h3>
				</div>
				<div class="modal-body">
					<p>Select Option</p>
					    <form class="form-horizontal" method="get" onsubmit="return Validate()">
						<div class="control-group">
						    <label class="control-label" >Upload New File</label>
						    <div class="controls">
						    	<input type="radio" name="choice" value="new">
						    </div>
						 </div>
						 <div class="control-group">
						    <label class="control-label">Modify Existing File</label>
						    <div class="controls">
						    	<input type="radio" name="choice" value="old">
						    </div>
						 </div>
					    
						<div class="modal-footer">
						<div class='alert alert-error' id="choiceError" style='width:200px;display:none;float:left'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							Please select option...
						</div>
						<div style="float:right;">
							<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
							<input type="submit" id="Go" class="btn btn-primary" value="Go &raquo;">
						</div>
					</form>
				</div>
		    	</div>

			<?php
				echo $value = $_GET["choice"];
				if($value == "new")
				{
					header("Location:/PFM/new.php"); /* Redirect browser */
					exit();
				}
				if($value == "old")
				{
					header("Location:/PFM/old.php"); /* Redirect browser */
					exit();
				}
			?>
		</div>
	</body>
</html>
