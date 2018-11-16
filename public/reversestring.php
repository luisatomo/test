<?php 

function reverseString($stringToReverse){
    $j=strlen($stringToReverse);
    $newString='';
    while($j>=0){
        $newString=$newString.$stringToReverse[$j];
        $j=$j-1;
    }
    return $newString;
}

echo reverseString("Hola1 2");