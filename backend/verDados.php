
<?php
require_once "../db/connect.php";
$admin = false;

$action = isset($_POST['action']) ? (int)$_POST['action']           : 0;

if($action == 1){
    $senha = isset($_POST['senha']) ? str_replace("'", "''", trim($_POST['senha']))           : '';
    if($senha == "W1nt3rmut3%rul&5Dw0rlD"){
        $admin = true;
        $select = "Select nome, email, grupo, seqcod, fim_test_d2_audio_12 as D2 FROM lpactm_data_2";
        $stmt= $conn->prepare($select);
        $stmt->execute();
        $dados = [];
        while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($dados, $d);
        }

        $select = "SELECT grupo, seqcod, COUNT(seqcod) as tanto FROM lpactm_data_2 GROUP BY grupo, seqcod ORDER BY grupo, seqcod ASC;";
        $stmt= $conn->prepare($select);
        $stmt->execute();
        $dados_bal = [];
        while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($dados_bal, $d);
        }

    } else {
        echo "<script>window.alert('Senha incorreta')</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="icon" href="favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Laboratório de Processos Associativos, Controle Temporal e Memória</title>
</head>
<body onload="desativaBack()">
    
    <div class="container">
    <?php 
         if(isset($dados)){
            echo "<h2 class='text-center'>Interface de Vizualização de Dados</h2>";
            echo '<form action="verDados.php" method="POST" role="form" class="invisivel">';
         } else {
            echo '<form action="verDados.php" method="POST" role="form">';
         }
        ?>
        <!-- <form action="verDados.php" method="POST" role="form"> -->
            <legend>Interface de Vizualização de Dados</legend>
        
            <div class="form-group">
                <label for="">Digite a Senha</label>
                <input type="hidden" name="action" value="1">
                
                <input type="password" class="form-control mt-5" id="senha" name="senha" placeholder="Senha" required>
            </div>
        
            
        
            <button type="submit" class="btn btn-primary mt-5">Carregar Dados</button>
        </form>
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2>Balanceamento dos grupos</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Sequência</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($dados_bal)){ 
                        
                        foreach($dados_bal as $d){
                            

                            
                    ?>
                    <tr>
                        <td><?=$d['grupo'] ?></td>
                        <td><?=$d['seqcod'] ?></td>
                        <td><?=$d['tanto'] ?></td>
                    </tr>
                    <?php } }?>
                    </tbody>
                </table>                
            </div>
        </div>
        
       
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h2>Participantes</h2>
                <table class="table table-hover">
                    <thead>
                        
                    </thead>
                    <tbody>
                        <?php
                        if(isset($dados)){ 
                            echo "<tr><th>Nome</th><th>E-mail</th><th>Grupo</th><th>Sequência</th><th>Status Dia 2</th></tr>";
                            foreach($dados as $d){
                                

                                
                        ?>
                        <tr>
                            <td><?=$d['nome'] ?></td>
                            <td><?=$d['email'] ?></td>
                            <td><?=$d['grupo'] ?></td>
                            <td><?=$d['seqcod'] ?></td>
                            <td><?php
                                if($d['D2'] == "NULL" || $d['D2'] == ""){
                                    echo "<span class='text-danger'>Pendente<span>";
                                } else{
                                    echo "<span class='text-success'>Ok<span>";
                                }
                            ?></td>
                        </tr>
                        <?php } }?>
                    </tbody>
                </table>
            </div>
        </div>
        
       
    
<?php
        // echo "<pre>";
        // var_dump($dados);
?>
    </div>
    

<script src="assets/js/validaForms.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>
</html>