<?php
require_once "../db/connect.php";

$msg = "";
if(isset($_COOKIE["email"])){
    $email = $_COOKIE["email"];
} else {
    $msg .= "Email não encontrado nos arquivos do navegador";
}


if(isset($_COOKIE["nome"])){
    $nome = $_COOKIE["nome"];
} else {
    $msg .= "\nNome não encontrado nos arquivos do navegador";
}


if(isset($_COOKIE["dispositivo"])){
    $dispositivo = $_COOKIE["dispositivo"];
} else {
    $msg .= "\nDispositivo não encontrado nos arquivos do navegador";
}

$insert = "INSERT INTO lpactm_data_2 
(nome, email, dispositivo) VALUES ('$nome','$email','$dispositivo');";

$stmt= $conn->prepare($insert);
$stmt->execute();

echo $msg;

//Define grupos e sequência


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

//Fazer select para grupo 1 seq 2

//Fazer select para grupo 1 seq 3




//Fazer select para grupo 2 seq 1

//Fazer select para grupo 2 seq 2

//Fazer select para grupo 2 seq 3


//Fazer select para grupo 3 seq 1

// $select_grupo = "SELECT grupo, COUNT(grupo) as tanto FROM lpactm_data_2 GROUP BY grupo ORDER BY tanto ASC;";
// $stmt= $conn->prepare($select);
// $stmt->execute();
// //$dados = [];
// while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
//     $grupo = (int)$d['grupo'];
//     break;
// }

// if($grupo < 3){
//     //define sequência
// } else {
//     //Grupo 3 só tem uma sequência
//     $seq = 1;
// }