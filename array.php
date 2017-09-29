<?php
function rotate(array $array, $nTimes)
{
    for ($i = 0; $i < $nTimes; $i++) {
        array_unshift($array, array_pop($array));
    }

    // if you want to simply return the array, use the line below
    return $array;

    // if you want to return string formatted as in the example, use the block of code below instead
	/*
	$tmp = '';
	foreach($array as $r) {
		$tmp .= $r.', ';
	}
	$str = '[';
	$str .= substr($tmp, 0, strlen($tmp)-2);
	$str .= ']';
	return $str;
	*/
}

$array = array(100, 3, 8, 9, 7, 6, 500, 1000);
print_r(rotate($array, 3));

// if you want to return string formatted as in the example, use the block of code below instead
//echo rotate($array, 3);