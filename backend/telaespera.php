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


//echo "<br>" . $update . "<br>";

$stmt= $conn->prepare($update);
$stmt->execute();


setcookie("TesteDia","1", time() + 60*60*24*30, '/LPACTM2');
setcookie("iteracao","0", time() + 60*60*24*30, '/LPACTM2');


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
<link rel="stylesheet" href="../assets/css/style.css">
<title>Laboratório de Processos Associativos, Controle Temporal e Memória</title>
</head>
<body onload="telaEspera()">

<div class="container">
    
    <div class="row invisivel" id='instru-espera'>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <br><br><br><br>

            <p>Esta etapa é igual à anterior: serão apresentados estímulos e você fará a reprodução da duração.</p>
            <p>Serão apresentados estímulos visuais - círculo, <u>mas sem os estímulos sonoros</u>.<br><strong>Relembrando:</strong></p>
            <ul>
                <li>Clique sobre o botão virtual Iniciar a apresentação do estímulo.</li>
                <li>Quando o estímulo (círculo) apagar, clique em Próximo.</li>
                <li>Em seguida, você irá reproduzir a duração da apresentação do estímulo que acabou de ver.  Clique a tecla INÍCIO e deixe o tempo passar.</li>
                <li>Quando você achar que o tempo que está passando for igual ao do estímulo apresentado, aperte a tecla FIM.</li>
                <li>Clique em Próximo para prosseguir com a tarefa.</li>
            </ul>
            <p> Lembre-se que é muito importante que você não utilize nenhum recurso para contar a duração do estímulo. Isso pode interferir nos resultados do estudo. <br>
                Nesta fase você repetirá o procedimento de estimar a duração de cada estímulo apresentado.
            </p>


            
            <!-- <p class="text-center" id="teste-exp-sm"><small>Aguarde e você será redirecionado para a próxima etapa</small></p> -->
        </div>
    </div>
    <h1 class="text-center" id="teste-exp">Aguarde</h1>

    
    <div class="row invisivel" id='btn-espera'>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <button onclick='carregaEspera()'>INICIAR EXIBIÇÃO</button>
            
        </div>
    </div>
    

    
    
    
</div>

<script src="../assets/js/validaForms.js?v=2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>
</html>