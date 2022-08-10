<?php 

require_once "../db/connect.php";

$email = $_COOKIE['email'];
$lista_de_biscoitos = [

    'Audio_1',
    'Cor_1',
    'ini_test_audio_1',
    'fim_test_audio_1',
    
    'Audio_2',
    'Cor_2',
    'ini_test_audio_2',
    'fim_test_audio_2',
    
    'Audio_3',
    'Cor_3',
    'ini_test_audio_3',
    'fim_test_audio_3',
    
    'Audio_4',
    'Cor_4',
    'ini_test_audio_4',
    'fim_test_audio_4',

    
    'Audio_5',
    'Cor_5',
    'ini_test_audio_5',
    'fim_test_audio_5',

    
    'Audio_6',
    'Cor_6',
    'ini_test_audio_6',
    'fim_test_audio_6',

    
    'Audio_7',
    'Cor_7',
    'ini_test_audio_7',
    'fim_test_audio_7',

    
    'Audio_8',
    'Cor_8',
    'ini_test_audio_8',
    'fim_test_audio_8',

    
    'Audio_9',
    'Cor_9',
    'ini_test_audio_9',
    'fim_test_audio_9',


    'Audio_10',
    'Cor_10',
    'ini_test_audio_10',
    'fim_test_audio_10',

    'Audio_11',
    'Cor_11',
    'ini_test_audio_11',
    'fim_test_audio_11',
    
    'Audio_12',
    'Cor_12',
    'ini_test_audio_12',
    'fim_test_audio_12'    
    
];


$desambigBD = [
    "Audio_1"    => "file_audio_1",
    "Cor_1"      => "cor_audio_1",

    "Audio_2"    => "file_audio_2",
    "Cor_2"      => "cor_audio_2",

    "Audio_3"    => "file_audio_3",
    "Cor_3"      => "cor_audio_3",

    "Audio_4"    => "file_audio_4",
    "Cor_4"      => "cor_audio_4",

    "Audio_5"    => "file_audio_5",
    "Cor_5"      => "cor_audio_5",

    "Audio_6"    => "file_audio_6",
    "Cor_6"      => "cor_audio_6",

    "Audio_7"    => "file_audio_7",
    "Cor_7"      => "cor_audio_7",

    "Audio_8"    => "file_audio_8",
    "Cor_8"      => "cor_audio_8",

    "Audio_9"    => "file_audio_9",
    "Cor_9"      => "cor_audio_9",

    "Audio_10"    => "file_audio_10",
    "Cor_10"      => "cor_audio_10",

    "Audio_11"    => "file_audio_11",
    "Cor_11"      => "cor_audio_11",

    "Audio_12"    => "file_audio_12",
    "Cor_12"      => "cor_audio_12",
];


$update = "UPDATE lpactm_data_2 SET ";
foreach($lista_de_biscoitos as $c){
    if(isset($_COOKIE[$c])){
        //verificar tipo de dado
        if (strpos($c, '_test_')) {
            $update .= $c . " = " . $_COOKIE[$c] . ", "; 
        } else {
            $update .= $desambigBD[$c] . " = '" . $_COOKIE[$c]. "', ";
            //$dado = "'" . $_COOKIE[$c] . "'"; //false
        }
    } else {
        //$dado = 'NULL';
    }
    //$insert_pt2 .= $dado . ", ";
    //$dados_cookies[$c] = $dado;
    
}
$update = substr($update, 0, -2);
// $insert = $insert_pt1 . $insert_pt2;

$update .= " WHERE email = '$email';";


echo "<br>" . $update . "<br>";

$stmt= $conn->prepare($update);
$stmt->execute();



?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="icon" href="favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Laboratório de Processos Associativos, Controle Temporal e Memória</title>
</head>
<body onload="telaEspera()">

<div class="container">
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <br><br><br>
        </div>
    </div>

    
    
    
</div>

<script src="assets/js/validaForms.js?v=2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>
</html>