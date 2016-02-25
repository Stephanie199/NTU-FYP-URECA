<?php
	error_reporting(E_PARSE);
	ini_set('display_errors', '1');
	include "topic_detection.php";	
	$text = isset($_POST["text"]) ? $_POST["text"] : '';

	$file = "files/textfile.txt";
	$processed= "files/processed.txt";
	$outputfile= "files/outputfile.txt";

	

	if(!empty($_POST)){
	writetofile($file, $text, "w");
	preproc($file);
	execpython($processed);

	$topic = getoutput($outputfile);
	}

?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>NTU PROJECTS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://bootstraptaste.com" />
<!-- css -->
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" />
<link href="../css/default.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
  <!-- start header -->
  <header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../index.php"><img src="../img/NTULogo.png" width="20%" /></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../sud/">Sentence Unit Detection</a></li>
                        <li class="active"><a href="topic_detection/">Topic Detection</a></li>
                    </ul>
                </div>
            </div>
        </div>
  </header>
  <!-- end header -->

  <section class="callaction">

    	<div class="container">
      		<div class="row">
        		<center> <h1> Topic Detection </h1> </center><hr />

            <!-- Project Info -Links to "Modal" Pop-Up below -->
            <div style="float:right; margin-top:-75px; margin-right:310px; width:10%">
                <a href="#" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#myModal"><i class="fa fa-info"></i> </a> 
            </div>

          			<form method="POST" action="">
          			<div class="form-group">
            			<div align="center"><h4>Enter any sentence here:</h4></div>
            			<p align = "center"><textarea class="form-control" rows="7" cols="100" name="text"></textarea></p>
          			</div>
          			<div align="center"><button type="submit" class="btn btn-default">Submit</button></div>
          			</form>
      		</div>
      		<br />
      		<div class="row">
        		<div class="form-group">
          			<h4><center>Here is the sentence you typed:</center></h4>
          			<div align="center"><h4 style="line-height:150%;"><?php echo $_POST["text"]; ?></h5></div>
          			<hr />
          			<h4> <center> The output: </center> </h4>
          			<div align="center"><h4 style="line-height:150%;"><?php 
          			if(is_array($topic)){
          				$line_count=count($topic);
          				for ($i=0; $i<+ $line_count; $i++){
          					if($i==0){
          						echo '<span style="color:red;">' . $topic[$i] . '</span> <br>';
          					}
          					else {
          						echo '<span style="color:blue;">' . $topic[$i] . '</span><br>';
          					}
          				}
          			}

          			?> </h5></div>
       		 	</div>	
      		</div>
    	</div>

      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Topic Detection</h4>
            </div>
            <div class="modal-body">
              <p>Type Description Here</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  
  </section>


</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>
