<?php
	include "en_sud_functions.php";

	function execTok ($tokInput, $tokOutput)
	{
		exec ("cd vnTok-4.1.1 && vnTokenizer.bat -i ../../".$tokInput." -o ../../".$tokOutput);
	}

	function formatTokOutput($fileIn,$fileOut){
		$fi = fopen($fileIn, "r");
		$fo = fopen($fileOut, "a");

		while(!feof($fi)){
	    	$line = fgets($fi);
	    	$line = mb_convert_encoding($line, "UTF-8");
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
	    	$line = mb_convert_encoding($line, "UTF-8");
	    	$parts = preg_split("/[\t]/", $line);
	    	
	    	$result = trim($parts[3]);
	    	$word = trim($parts[0]);

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