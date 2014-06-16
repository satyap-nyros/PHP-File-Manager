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
		<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" media="screen">
		
		<script src="bootstrap/js/JsScript.js"></script>
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="bootstrap/js/jquery-ui.js"></script>
		
	</head>
	<body>
			<?php

				$dir="uploadFiles/";
				$files = glob($dir."*");
							
				$testarray=array();
				foreach ($files as $file) 
				{
					$FileName = end(explode("/", $file));  	
					array_push($testarray,$FileName);
				}
				
			   $testvar = implode(":#:",$testarray);
			?>		
			<script type="text/javascript">
			
			  $(function() 
			  {
				   var testvar = "<? print $testvar; ?>";
				   var testarray = new Array();
				   var x;
				   testarray = testvar.split(":#:");
 
				$("#search").autocomplete({
				source: testarray
				});

				$("#btnSearch").click(function(){
					var fileExist = 0;
					var Searchval = $('#search').val();
					if(Searchval == "" || Searchval.trim().length == 0)
					{
						return false;
					}
					for(i=0;i<testarray.length;i++)
					{
						if(testarray[i] == Searchval)
						{ fileExist = 1;}
					}
					if(fileExist == 1)
					{return true;}
					else
					{$('#search').val("File doesn't exist");return false;}
				});
			});
			</script>
            <div class="navbar" style="margin-top:-20px;">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="PFM.php">PFM</a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                      <li class="active"><a href="PFM.php">Home</a></li>
                      
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">GoTo<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="new.php">Upload New File</a></li>
			  <li class="divider"></li>
                          <li><a href="old.php">Modify Existing File</a></li>
                        </ul>
                      </li>
                    </ul>
                    <form class="navbar-search pull-left form-search" action="search.php" method="POST" style="margin-left:420px;">
		    <div class="input-append">
		      <input type="text" name="file" id="search" class="span2 search-query" onfocus="this.value='';">
		      <input type="submit" id="btnSearch" class="btn" value="Search">
		    </div>
                    </form>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div><!-- /navbar -->
</body>
</html>
