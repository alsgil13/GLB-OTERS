<?php

require_once "../db/connect.php";


/** Busca Grupos no banco para definir o deste usuário */
//Fazer select para grupo 1 
$select_grupo1 = "SELECT seqcod, COUNT(seqcod) as tanto FROM lpactm_data_2 WHERE grupo = 1 GROUP BY seqcod ORDER BY tanto ASC;";
$stmt= $conn->prepare($select_grupo1);
$stmt->execute();
$grupo1seqs = [];
$totalG1 = 0;
while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
    //array_push($dados, $d);

    //coleta a quantidade de sequências do grupo 1
    
    switch($d['seqcod']){
        case 1:
            $grupo1seqs['1'] = (int)$d['tanto'];
            $totalG1 += $grupo1seqs['1'];
            break;
        case 2:
            $grupo1seqs['2'] = (int)$d['tanto']; 
            $totalG1 += $grupo1seqs['2'];
            break;
        case 3:
            $grupo1seqs['3'] = (int)$d['tanto'];
            $totalG1 += $grupo1seqs['3'];
            break;
    }
}
echo "<pre>";
var_dump($grupo1seqs);
echo "</pre>";
echo "<br>Total grupo 1: $totalG1";



//Fazer select para grupo 2
$select_grupo2 = "SELECT seqcod, COUNT(seqcod) as tanto FROM lpactm_data_2 WHERE grupo = 2 GROUP BY seqcod ORDER BY tanto ASC;";
$stmt= $conn->prepare($select_grupo2);
$stmt->execute();
$grupo2seqs = [];
$totalG2 = 0;
while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
    //array_push($dados, $d);

    //coleta a quantidade de sequências do grupo 2
    
    switch($d['seqcod']){
        case 1:
            $grupo2seqs['1'] = (int)$d['tanto'];
            $totalG2 += $grupo2seqs['1'];
            break;
        case 2:
            $grupo2seqs['2'] = (int)$d['tanto']; 
            $totalG2 += $grupo2seqs['2'];
            break;
        case 3:
            $grupo2seqs['3'] = (int)$d['tanto'];
            $totalG2 += $grupo2seqs['3'];
            break;
    }
}
echo "<pre>";
var_dump($grupo2seqs);
echo "</pre>";
echo "<br>Total grupo 2: $totalG2";

//Fazer select para grupo 3
$select_grupo3 = "SELECT COUNT(grupo) as tanto FROM lpactm_data_2 WHERE grupo = 3;";
$stmt= $conn->prepare($select_grupo3);
$stmt->execute();
$totalG3 = 0;
while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
    $totalG3 = (int)$d['tanto'];
}
echo "<br>Total grupo 3: $totalG3";


//define os grupos

$totais = [
    "1" => $totalG1,
    "2" => $totalG2,
    "3" => $totalG3

];


asort($totais);

foreach($totais as $chave => $valor){
    $grupo = (int)$chave;
    break;
}

echo "<pre>";
var_dump($totais);
echo "</pre>";

//$grupo = (int)$totais[0];
echo "<br>Grupo: $grupo<br>";


//Define a sequência
if($grupo == 3){
    $seqcod = 1;
    $sequencia = "['a','b','c']";
} else {
    //Buscar sequência
    if($grupo == 1){
        echo "<pre>";
        var_dump($grupo1seqs);
        echo "</pre>";
        if(!isset($grupo1seqs[1])){
            $seqcod = 1;
        } elseif(!isset($grupo1seqs[2])){
            $seqcod = 2;
        } elseif(!isset($grupo1seqs[3])){
            $seqcod = 3;
        } else{
            asort($grupo1seqs);
            foreach($grupo1seqs as $chave => $valor){
                $seqcod = (int)$chave;
                break;
            }
        }
    } elseif($grupo == 2){
        echo "<pre>";
        var_dump($grupo2seqs);
        echo "</pre>";
        if(!isset($grupo2seqs[1])){
            $seqcod = 1;
        } elseif(!isset($grupo2seqs[2])){
            $seqcod = 2;
        } elseif(!isset($grupo2seqs[3])){
            $seqcod = 3;
        } else{
            asort($grupo2seqs);
            foreach($grupo2seqs as $chave => $valor){
                $seqcod = (int)$chave;
                break;
            }
        }
    }

}

$array_sequencias = [
    1 => "['a','b','c']",
    2 => "['c','b','a']",
    3 => "['a','c','b']"
];

$sequencia = $array_sequencias[$seqcod];

echo "<br>Sequencia: $seqcod = <br><pre>";
var_dump($sequencia);
echo "</pre>";


