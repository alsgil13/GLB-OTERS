<?php
require_once "../db/connect.php";

$email = $_COOKIE['email'];
$lista_de_biscoitos = [
    'ini_test_audio_1' => 'ini_test_d2_audio_9',
    'fim_test_audio_1' => 'fim_test_d2_audio_9',
    'ini_test_audio_2' => 'ini_test_d2_audio_10',
    'fim_test_audio_2' => 'fim_test_d2_audio_10',
    'ini_test_audio_3' => 'ini_test_d2_audio_11',
    'fim_test_audio_3' => 'fim_test_d2_audio_11',
    'ini_test_audio_4' => 'ini_test_d2_audio_12',
    'fim_test_audio_4' => 'fim_test_d2_audio_12',
    'ini_test_audio_5' => 'ini_test_d2_audio_13',
    'fim_test_audio_5' => 'fim_test_d2_audio_13',
    'ini_test_audio_6' => 'ini_test_d2_audio_14',
    'fim_test_audio_6' => 'fim_test_d2_audio_14',
    'ini_test_audio_7' => 'ini_test_d2_audio_15',
    'fim_test_audio_7' => 'fim_test_d2_audio_15',
    'ini_test_audio_8' => 'ini_test_d2_audio_16',
    'fim_test_audio_8' => 'fim_test_d2_audio_16' 
];


//Limpa cookies Colocar em outro lugar
// for($i=1;$i<=13;$i++){
//     $nome_cok_i = "ini_test_audio_" . $i;
//     $nome_cok_f = "fim_test_audio_" . $i;
//     setcookie($nome_cok_i, "", time() - 3600, '/LPACTM2');
//     setcookie($nome_cok_f, "", time() - 3600, '/LPACTM2');
// }


$update = "UPDATE lpactm_data_2 SET ";

foreach($lista_de_biscoitos as $c => $v){
    if(isset($_COOKIE[$c])){
        $update .= $v . " = " . $_COOKIE[$c] . ", "; 
    }
}
$update = substr($update, 0, -2);

$update .= " WHERE email = '$email';";


//echo "<br>" . $update . "<br>";

$stmt= $conn->prepare($update);
$stmt->execute();

?>
<head>
<script src="../assets/js/validaForms.js?v=2"></script>
<script>
    //window.alert("Você será redirecionado à um formulário Google, por favor preencha até o final e envie. \nUtilize o mesmo e-mail informado nessa etapa, tentaremos preenchê-lo automaticamente para você");

    var email = getCookie("email");
    var grupo = parseInt(getCookie("grupo"));
    switch (grupo) {
        case 1:
            var urlForm = "https://docs.google.com/forms/d/e/1FAIpQLSeK9JL1XZguYuGcg3n5rPzumypE0MdVjM5erKiPI5hM5_EFpw/viewform?usp=pp_url&entry.757752652="+email;
            break;
        case 2:
            var urlForm = "https://docs.google.com/forms/d/e/1FAIpQLSfp4Ct4Mu8yxG9EqXw4DKKJPY8QGOrmFRJJyLA1myyHJ9kP-g/viewform?usp=pp_url&entry.757752652="+email;
            break;
        case 3:
            var urlForm = "https://docs.google.com/forms/d/e/1FAIpQLSffDETB2LNNv_rQXw95OXSpAskqSqZj7CZa8UN7kA9rbfR0cg/viewform?usp=pp_url&entry.757752652="+email;
            break;
      }
    mostraCookies();
    window.alert("Você será redirecionado à um formulário Google, por favor preencha até o final e envie. \nUtilize o mesmo e-mail informado nessa etapa, tentaremos preenchê-lo automaticamente para você.");
    window.location.replace(urlForm);
</script>
</head>
