
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
<html lang='en'>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

    	<title> Topic detection </title>
    	<!-- Bootstrap -->
    	<link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">

  	</head>
  	<body>
    	<div class="container">
      		<div class="row">
        		<center> <h1> Topic Detection </h1> </center><hr />
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
   </body>
</html>