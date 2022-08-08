<?php

require_once "../db/connect.php";

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
    //array_push($dados, $d);
    $totalG3 = (int)$d['tanto'];
    //coleta a quantidade de sequências do grupo 2

}
echo "<br>Total grupo 3: $totalG3";


//define os grupos
$totais = [
    "1" => $totalG1,
    "2" => $totalG2,
    "3" => $totalG3
];

array_multisort($totais, SORT_DESC);
//usort($totais,'DescSort');

echo "<pre>";
var_dump($totais);
echo "</pre>";
//echo "<br>Total grupo 2: $totalG2";

// if($totalG1 <= $totalG2 && $totalG1 <= $totalG3){
//     $grupo = 1;
// }

// if($totalG2 <= $totalG1 && $totalG2 <= $totalG3){
//     $grupo = 2;
// }

// if($totalG3 <= $totalG1 && $totalG3 <= $totalG2){
//     $grupo = 3;
// }