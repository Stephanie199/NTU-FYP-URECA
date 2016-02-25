<?php
function cleanText($text){
	$str = cleanString($text);
	$str = expandAbbreviation($str);
	$str = removeString($str);

	return $str;
}

function removeString($text) {
	$str = str_replace(',', '', $text);
	$str = str_replace(':', '', $str);
	$str = str_replace(';', '', $str);
	$str = str_replace('\'', '', $str);
	$str = str_replace('(', '', $str);
	$str = str_replace(')', '', $str);
	$str = str_replace('-', '', $str);
	$str = str_replace('—', '', $str);
	$str = str_replace('"', '', $str);
	$str = str_replace('...', '', $str);
	$str = str_replace('#', '', $str);
	$str = str_replace('?', '', $str);
	$str = str_replace('!', '', $str);
	$str = str_replace('.', '', $str);

	return $str;
}

function expandAbbreviation($text){
	$str = str_replace("dr.", 'doctor', $text);
	$str = str_replace("mr.", 'mister', $str);
	$str = str_replace("ms.", 'miss', $str);
	$str = str_replace("mrs.", 'miss', $str);
	$str = str_replace("'m", ' am', $str);
	$str = str_replace("'re", ' are', $str);
	$str = str_replace("'ll", ' will', $str);
	$str = str_replace("'d", ' had', $str);
	$str = str_replace("'ve", ' have', $str);
	$str = str_replace("it's", 'it is', $str);
	$str = str_replace("he's", 'he is', $str);
	$str = str_replace("she's", 'she is', $str);
	$str = str_replace("there's", 'there is', $str);
	$str = str_replace("here's", 'here is', $str);
	$str = str_replace("who's", 'who is', $str);
	$str = str_replace("what's", 'what is', $str);
	$str = str_replace("that's", 'that is', $str);
	$str = str_replace("won't", 'will not', $str);
	$str = str_replace("can't", 'can not', $str);
	$str = str_replace("n't", '  not', $str);

	return $str;
}

function cleanString($text) {
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   '', // Literally a single quote
        '/[“”«»„]/u'    =>   '', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}
?>