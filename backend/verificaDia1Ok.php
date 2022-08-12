<?php

require_once "../db/connect.php";

if(isset($_GET['email'])){
    $email = $_GET['email'];
    $select = "SELECT fim_test_d2_audio_12 FROM lpactm_data WHERE email = '$email'; ";
    $stmt = $conn->prepare($select);
    $stmt->execute();
    
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if( $data != false ){
        //setcookie("TesteDia","2", time() + 60*60*24*30, '/LPACTM2');
        // setcookie("iteracao","0", time() + 60*60*24*30, '/LPACTM2');
        $return = $data['fim_test_d2_audio_12'];
        echo $return;
    }
    //var_dump($data);



}