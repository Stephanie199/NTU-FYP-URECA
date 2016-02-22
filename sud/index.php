<?php
  include "en_sud_functions.php";
  $text = strtolower($_POST["text"]);
  $language = $_POST["language"];

  if(!empty($_POST)){
    if($language == 'english'){
        $sennaInput = "data-en/sennaInput.txt";
        $sennaOutput = "data-en/sennaOutput.txt";
        $model = "data-en/model_rt04.txt";
        $crfTestInput = "data-en/crfTestInput.txt";
        $crfTestOutput = "data-en/crfTestOutput.txt";
        $tempResult = "data-en/tempResult.txt";

        writeToTextFile($sennaInput,$text,"w");
        execSenna($sennaInput,$sennaOutput);
        formatSennaOutput($sennaOutput,$crfTestInput);
        execCrfTest($model,$crfTestInput,$crfTestOutput);

        $sentences = getSentences($crfTestOutput);
        $result = highlightSentences($sentences);

        unlink($crfTestInput);
    }else{
        $result = "Do Some Function Here!";
    }
    
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Moderna - Bootstrap 3 flat corporate template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://bootstraptaste.com" />
<!-- css -->
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" />
<link href="../css/languages.min.css" rel="stylesheet" />
<link href="../css/default.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-iconhttp://twitter.github.io/bootstrap/scaffolding.htmls.min.css" rel="stylesheet">

<script src="../js/msdropdown/jquery.dd.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/msdropdown/dd.css" />

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
                    <a class="navbar-brand" href="index.html"><img src="../img/NTULogo.png" width="20%" /></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="../index.php">Home</a></li>
                        <li class="active"><a href="#">Sentence Unit Detection</a></li>
                        <li><a href="../topic_detection/">Topic Detection</a></li>
                    </ul>
                </div>
            </div>
        </div>
  </header>
  <!-- end header -->

  <section class="callaction">

    <div class="container">
      <div class="row">
        <center> <h1> Sentence Unit Detection </h1> </center>

      <!-- Project Info -->
      <div style="float:right; margin-top:-55px; margin-right:230px; width:10%">
          <a href="#" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#myModal"><i class="fa fa-info"></i> </a> 
      </div>

      <form method="post" action="">
      <!-- Select Language -->
      <div style="float:right; margin-top:-55px; width:15%"> 
          <select class="form-control" name="language">
          <option value="english" data-image="../img/lang/en.png">English</option>
          <option value="vietnamese" data-image="../img/lang/vn.png">Vietnamese</option>
      </select> 
      </div>
      </div>
      
      <hr />
      
      <div class="row">
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
          <div class="span2 well" align="center"><h4 style="line-height:150%;"><?php echo $result ?></h5></div>
        </div>
      </div>
    </div>

</section>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sentence Unit Detection</h4>
        </div>
        <div class="modal-body">
          <p>
             Sentence unit detection (SUD) in automated speech recognition (ASR) system is crucial for enriching the ASR output, improving the human readability and 
             process the word stream of the output. This web demo presents the models for sentence unit detection in written text. In this context, sentence unit is referred to 
             punctuation marks in the sentence, in which the focus is on adding period to the unstructured word sequence.
          </p>

          <hr />
          <p>
            <b> SUD ENGLISH </b>
          </p>
          <p> By Stephanie - for Fulfillment of the Requirements for Final Year Project 2015/16 [SCE 15-0103] </p>
          <hr />
          
          <p>
             The implementation of the SUD English system is based on Conditional Random Fields. CRF++ was used as machine learning tool. 
             Various kinds of lexical features are combined using Conditional Random Fields. 
             These features include token n-grams and syntactic information, such as part of speech (POS) and chunk (IOBES) tag, 
             which were generated using SENNA parser.
          </p>
          <p>
              The model was generated from training RT-04 corpus, which is a broadcasting news transcript.
              The resulting models were cross-evaluated on various test set, such as Gigaword English 2002 (newspaper text), 
              RT-04 and Ted Talk transcript. The newly developed models performed relatively well in terms of average F1-score
              (62.7%) and NIST error rate (72.17%).
          </p>
          <p>
              The evaluation of the performance shows that the syntatic information played an important role as the additional information in
              well-structured sentences. There are still lots of improvements that could be done in order to achieve the-state-ofthe-art performance 
              of the model. The following areas can be further explored: 1) improvement on lexical features
              and 2) implement prosodic features to the spoken text transcript.
          </p>

          <hr />
          <p>
            <b> SUD VIETNAMESE </b>
          </p>
          <p> By Vu - for the completion of URECA Project 2015
          <hr />
          
          <p>
             [Type Description Here]
          </p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>

<script language="javascript">
    $(document).ready(function(e) {
      try {
        $("body select").msDropDown();
      } catch(e) {
        alert(e.message);
      }
    });
</script>