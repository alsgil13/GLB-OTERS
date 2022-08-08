<?php

require_once "../db/connect.php";

if(isset($_GET['email'])){
    $email = $_GET['email'];
    $select = "SELECT nome FROM lpactm_data_2 WHERE email = '$email'; ";
    $stmt = $conn->prepare($select);
    $stmt->execute();
    
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if( $data != false ){
        $return = $data['nome'];
        echo $return;
    }
    //var_dump($data);


}