<?php

	function execTag ($tagInput, $tagOutput)
	{
		exec ("cd vnTagger && vnTagger.bat -i ../".$tagInput." -o ../".$tagOutput." -u -p");
	}

	function formatTagOutput($fileIn,$fileOut){
		$fi = fopen($fileIn, "r");
		$fo = fopen($fileOut, "a");

		while(!feof($fi)){
	    	$line = fgets($fi);
	    	$line = mb_convert_encoding($line, "UTF-8");
	    	if (trim($line) == "")
	    		continue;
	    	//echo $line;
	    	$parts = preg_split("[\s]", $line);

	    	foreach ($parts as $word)
	    	{
	    		if (trim($word) == "")
	    			continue;
	    		$field = preg_split("[/]", $word);
	    		$text = trim($field[0])."\t".trim($field[1])."\n";
	    		//echo $text."\n";
	    		fwrite($fo,$text);
	    	}
		}
		
		fclose($fi);
		fclose($fo);
	}

	function writeToTextFileUTF ($file,$lineContent,$writeType){
		$fo = fopen($file,$writeType);
		$lineContent = mb_convert_encoding($lineContent, "UTF-8");
		fwrite($fo,$lineContent);

		fclose($fo);
	}

	function getSentencesUTF($file){
		$fi = fopen($file, "r");
		$str = "";

		while(!feof($fi)){
	    	$line = fgets($fi);
	    	if (trim($line) == "")
	    		continue;
	    	$line = mb_convert_encoding($line, "UTF-8");
	    	$parts = preg_split("/[\t]/", $line);
	    	
	    	$result = trim($parts[2]);
	    	$word = trim($parts[0]);
	    	//echo $word." ".$result."\n";

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