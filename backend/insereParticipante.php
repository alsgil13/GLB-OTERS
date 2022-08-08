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

$insert = "INSERT INTO lpactm_data 
(nome, email, dispositivo) VALUES ('$nome','$email','$dispositivo');";

$stmt= $conn->prepare($insert);
$stmt->execute();

echo $msg;