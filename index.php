<?php
  include "en_sud_functions.php";
  $text = $_POST["text"];

  $sennaInput = "data/sennaInput.txt";
  $sennaOutput = "data/sennaOutput.txt";
  $model = "data/model_rt04.txt";
  $crfTestInput = "data/crfTestInput.txt";
  $crfTestOutput = "data/crfTestOutput.txt";
  $tempResult = "data/tempResult.txt";

  if(!empty($_POST)){
    writeToTextFile($sennaInput,$text,"w");
    execSenna($sennaInput,$sennaOutput);
    formatSennaOutput($sennaOutput,$crfTestInput);
    execCrfTest($model,$crfTestInput,$crfTestOutput);

    $sentences = getSentences($crfTestOutput);
    //unlink($tempResult);

    unlink($crfTestInput);
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Sentence Unit Detection</title>

    <!-- Bootstrap -->
    <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <center> <h1> Sentence Unit Detection </h1> </center><hr />
          <form method="post" action="">
          <div class="form-group">
            <div align="center"><h4>Enter any paragraphs without any punctuations here:</h4></div>
            <textarea class="form-control" rows="7" name="text"></textarea>
          </div>
          <div align="center"><button type="submit" class="btn btn-default">Submit</button></div>
          </form>
      </div>
      <br />
      <div class="row">
        <div class="form-group">
          <div align="center"><h4>Here are the sentences:</h4></div> 
          <hr />
          <div align="center"><h4 style="line-height:150%;"><?php echo highlightSentences($sentences); ?></h5></div>
        </div>
      </div>
    </div>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  </body>
</html>