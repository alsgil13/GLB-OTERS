<html>
<?php
require_once "../db/connect.php";

$email = $_COOKIE['email'];
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

    // var email = getCookie("email");
    // var urlForm = "https://docs.google.com/forms/d/e/1FAIpQLSdn50tRx1FU3LozxlGuuyqIotNCN6VG0QhXGgaaYsRHkLgZlQ/viewform?usp=pp_url&entry.662501075="+email;
    // mostraCookies();
    // window.alert("Você será redirecionado à um formulário Google, por favor preencha até o final e envie. \nUtilize o mesmo e-mail informado nessa etapa, tentaremos preenchê-lo automaticamente para você.");
    // window.location.replace(urlForm);
</script>

<!-- Latest compiled and minified CSS & JS -->
<link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">


</head>
<body>
    
    <div class="container">
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1>Obrigada por sua participação hoje! Aguardo você amanhã no mesmo horário.</h1>
                
            </div>
        </div>
        
    </div>
    
<script>
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });

</script>
<script src="//code.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
