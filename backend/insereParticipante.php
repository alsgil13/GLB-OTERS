<?php
require_once "../db/connect.php";
require_once "funcoes.inc.php";

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



// echo $msg;

//Define grupos e sequência
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


//Fazer select para grupo 3
$select_grupo3 = "SELECT COUNT(grupo) as tanto FROM lpactm_data_2 WHERE grupo = 3;";
$stmt= $conn->prepare($select_grupo3);
$stmt->execute();
$totalG3 = 0;
while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
    $totalG3 = (int)$d['tanto'];
}



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


//Define a sequência
if($grupo == 3){
    $seqcod = 1;
    $sequencia =        ["vhabex.mp3",	    "vhnaebx.mp3",	"vhnasffz.mp3",	"vhadz.mp3",	"vhaedz.mp3",	"vhnaax.mp3",	"vhabex.mp3",	"vhadz.mp3",		"vhnasffz.mp3",	"vhaedz.mp3",	"vhnaax.mp3",	"vhnaebx.mp3"];
    $sequencia_cores =  ["VERDE",	        "VERDE",	    "AZUL",	        "AZUL",	        "VERDE",	    "AZUL",	        "AZUL",	        "VERDE",		    "VERDE",	    "AZUL",	        "VERDE",	    "AZUL"];


} else {
    //Buscar sequência
    if($grupo == 1){
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
    1 => ["vhawz.mp3",    "vhapx.mp3",  	    "vhnahx.mp3", 	    "vhnahpz.mp3",	"vhagtx.mp3",       "vhnaivz.mp3",      "vhaggx.mp3",   "vhnanaz.mp3",  "vhaifz.mp3",   "vhnahpx.mp3",  "vhacsz.mp3",   "vhnadsz.mp3"],
    2 => ["vhapx.mp3",    "vhnahpz.mp3",    	"vhaifz.mp3", 	    "vhagtx.mp3",	"vhnaivz.mp3",      "vhnahx.mp3",       "vhaggx.mp3",   "vhnahpx.mp3",  "vhacsz.mp3",   "vhawz.mp3",    "vhnadsz.mp3",  "vhnanaz.mp3"],
    3 => ["vhnahx.mp3",   "vhapx.mp3", 	    "vhnahpz.mp3", 	    "vhnaivz.mp3",	"vhaifz.mp3",       "vhagtx.mp3",       "vhnahpx.mp3",  "vhaggx.mp3",   "vhnanaz.mp3",  "vhnadsz.mp3",  "vhacsz.mp3",   "vhawz.mp3"],
];

$sequencia = $array_sequencias[$seqcod];

$insert = "INSERT INTO lpactm_data_2 
(nome, email, dispositivo, grupo, seqcod, sequencia) VALUES ('$nome', '$email', '$dispositivo', $grupo, $seqcod, '$sequencia');";

$stmt= $conn->prepare($insert);
$stmt->execute();

echo arrayToString($sequencia);
//Salvar em cookies

    //grupo

    //sequencia

    //se grupo 3: sequencia cores