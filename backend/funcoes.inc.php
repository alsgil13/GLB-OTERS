<?php

function arrayToString($array){
    $string = '';
    foreach($array as $a){
        $string = '"'.$a.'",';
    }
    //$string = substr($string,-1,1);
    return $string;
}