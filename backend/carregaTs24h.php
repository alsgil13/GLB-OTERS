<?php
require_once "../db/connect.php";



$email = $_COOKIE['email'];

$select = "SELECT 
            grupo,  
            cor_audio_1,
            cor_audio_2,
            cor_audio_3,
            cor_audio_4,
            cor_audio_5,
            cor_audio_6,
            cor_audio_7,
            cor_audio_8
        FROM 
            lpactm_data_2
        WHERE 
            email = '$email'; ";

// echo $select . "<br>";
$stmt = $conn->prepare($select);
$stmt->execute();

$data = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($data);
$lista_de_biscoitos = [
    'ini_test_audio_1' => 'ini_test_d2_audio_1',
    'fim_test_audio_1' => 'fim_test_d2_audio_1',
    'ini_test_audio_2' => 'ini_test_d2_audio_2',
    'fim_test_audio_2' => 'fim_test_d2_audio_2',
    'ini_test_audio_3' => 'ini_test_d2_audio_3',
    'fim_test_audio_3' => 'fim_test_d2_audio_3',
    'ini_test_audio_4' => 'ini_test_d2_audio_4',
    'fim_test_audio_4' => 'fim_test_d2_audio_4',
    'ini_test_audio_5' => 'ini_test_d2_audio_5',
    'fim_test_audio_5' => 'fim_test_d2_audio_5',
    'ini_test_audio_6' => 'ini_test_d2_audio_6',
    'fim_test_audio_6' => 'fim_test_d2_audio_6',
    'ini_test_audio_7' => 'ini_test_d2_audio_7',
    'fim_test_audio_7' => 'fim_test_d2_audio_7',
    'ini_test_audio_8' => 'ini_test_d2_audio_8',
    'fim_test_audio_8' => 'fim_test_d2_audio_8' 
];


//Limpa cookies
setcookie("grupo", "", time() - 3600, '/LPACTM2');
for($i=1;$i<=13;$i++){
    $nome_cok_i = "ini_test_audio_" . $i;
    $nome_cok_f = "fim_test_audio_" . $i;
    $nome_cok_c = "Cor_" . $i;
    setcookie($nome_cok_i, "", time() - 3600, '/LPACTM2');
    setcookie($nome_cok_f, "", time() - 3600, '/LPACTM2');
    setcookie($nome_cok_c, "", time() - 3600, '/LPACTM2');
}



$i = 0;
foreach ($data as $chave => $dado){
    if($chave=="grupo"){
        setcookie("grupo", $dado, time() + 60*60*24*30, '/LPACTM2');
        $gp = $dado;
    } else {
        $nome_cok = "Cor_" . $i;
        setcookie($nome_cok, $dado, time() + 60*60*24*30, '/LPACTM2');
    }
    $i++;
}

if(!in_array($gp,[1,2,3])){
?>
<script>
    window.alert("Erro ao carregar dados do e-mail informado, por favor, verifique o e-mail e tente novamente");
    window.location.replace("https://a-gil.tech/LPACTM2/intrucoesTs24h.html");

</script>
<?php

}


?>
<script>
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });

</script>
<script>window.location.href = "../exibeTs24h.html";</script>