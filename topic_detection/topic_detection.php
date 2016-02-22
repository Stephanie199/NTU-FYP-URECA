<?php
error_reporting(E_PARSE);
ini_set('display_errors', '1');

function writetofile($file, $content, $writeType){
	$fo = fopen($file, $writeType);
	if($fo){
		fwrite($fo,$content);
		fclose($fo);
	}	
}


function preproc($file1){
	echo $file1;
	exec("/Library/Frameworks/Python.framework/Versions/2.7/bin/python preproc.py $file1 2>&1", $output);
	print_r($output);
}

function execpython($file2){
	exec("/Library/Frameworks/Python.framework/Versions/2.7/bin/python predicter.py $file2 2>&1", $output);
	print_r($output);
}



#function getoutput($file1){
#	$fh= fopen($file1, 'r');
#	$theData = fread($fh, filesize("$file1"));
#	return $theData;
#	fclose($fh);
#}

function getoutput($file3){
	$getData=file_get_contents($file3);
	$lines= explode("\n", $getData);
	return $lines;
}
?>

