<?php

function execSenna($sennaInput,$sennaOutput){
	exec("cd senna-v3.0\\senna && senna-win32.exe -pos -chk < ../../".$sennaInput."> ../../".$sennaOutput);
}

function execCrfTest($model,$crfTestInput,$crfTestOutput){
	exec("cd CRF++-0.58 && crf_test.exe -m ../".$model." ../".$crfTestInput." > ../".$crfTestOutput);
}

function writeToTextFile($file,$lineContent,$writeType){
	$fo = fopen($file,$writeType);
	fwrite($fo,$lineContent);

	fclose($fo);
}

function formatSennaOutput($fileIn,$fileOut){
	$fi = fopen($fileIn, "r");
	$fo = fopen($fileOut, "a");

	while(!feof($fi)){
    	$line = fgets($fi);
    	$parts = preg_split("/[\t]/", $line);

    	$lenChar = strlen(trim($parts[0]));
    	
    	if ($lenChar > 0){
    		$text = trim($parts[0])." ".trim($parts[1])." ".trim($parts[2])."\n";
    		fwrite($fo,$text); 
    	}
	}
	
	fclose($fi);
	fclose($fo);
}

function highlightSentences($sentences){
	$parts = explode(" . ", $sentences);
	$color = array('#fff37d','#a2bef9');
	$str = "";

	$j=0;

	$parts = array_filter(array_map('trim',$parts),'strlen');

	foreach($parts as $sentence){
		$str = $str.'<span style="background-color:'.$color[$j].'">'.$sentence.'</span>'." . ";

		if ($j==1){ $j=0; }else{ $j++; }
	}

	return $str;
}

function getSentences($file){
	$fi = fopen($file, "r");
	$str = "";

	while(!feof($fi)){
    	$line = fgets($fi);
    	$parts = preg_split("/[\t]/", $line);
    	
    	$result = trim($parts[3]);
    	$word = trim($parts[0]);

    	#echo $result;

    	if($result==0){
    		$str = $str.$word." ";	
    	}else{
    		$str = $str.$word." . ";
    	}
    }

    fclose($fi);

    return $str;
}


?>