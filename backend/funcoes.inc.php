<?php

function arrayToString($array){
    $string = '';
    foreach($array as $a){
        $string .= '"'.$a.'",';
    }
    $string = substr($string,0,-1);
    return $string;
}