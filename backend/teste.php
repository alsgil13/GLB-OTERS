<?php

require_once "../db/connect.php";

//Fazer select para grupo 1 seq 1
$select_grupo1 = "SELECT seqcod, COUNT(seqcod) as tanto FROM lpactm_data_2 WHERE grupo = 1 GROUP BY seqcod ORDER BY tanto ASC;";
$stmt= $conn->prepare($select_grupo1);
$stmt->execute();
$dados = [];
while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($dados, $d);
}
echo "<pre>";
var_dump($dados);