 <?php
     session_start();
     require_once '../index/classe.php';
    $u = new usuario();
    $u->conectar('ages','localhost','ages','dna,Pncadm3');
    global $pdo;
    $cat_id_escala= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = $pdo->prepare("SELECT * FROM situacao LEFT JOIN militares ON situacao.IDmilitar WHERE ID = $cat_id_escala;");
    $sql->execute();

?>

<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Arend">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro</title>
    <script src="main.js"></script>


    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css'>
    <link rel='stylesheet' href='/resources/demos/style.css'>
    <script src='https://code.jquery.com/jquery-3.6.0.js'></script>
    <script src='https://code.jquery.com/ui/1.13.0/jquery-ui.js'></script>

  <script>



</script>
    <style>
        .tamanho {
            font-size: 1.125rem;
            width: 500px;
            right: 0;
            margin-bottom: 100px;
        }


        body {
  flex-direction: column;
}
    </style>


    <!-- Custom styles -->
    <link href="signin.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="container ajuste"> <?php include "../bordas/header.html"; ?> </div>
        <div class=" container border rounded p-3 mb-2 bg-light text-dark tamanho">
                
                
                <?php
                $resultado = $pdo->prepare("SELECT nomeguerra, numero FROM militares WHERE ID = $cat_id_escala;");
                $resultado->execute();
                while($row = $resultado->fetch()) {   
                extract($row);
                
                }
                echo "<p ><h2 class='text-center'>$nomeguerra - $numero </h2></p>";
                echo"<a href='../situacao'><button class='btn-secondary float-end btn-small border rounded '>Voltar</button></a>"; ?>
                <table class="table">
                    <form action='atualizar_situacao.php' method="POST">
                        <?php 
                            echo"
                                         <tr>
                                             <th>Motivo</th>
                                             <th>Data inicio </th>
                                             <th>Data Fim</th>
                                             <th>Revogar dispença</th>
                                             <th>Em vigor</th>
                                             <th>Deletar</th>
                                         </tr>";

                            if ($sql->rowCount() > 0) {
                                while ( $row = $sql->fetch()){
                                    extract($row);
                                    #$dia_br = date("Y-m-d", strtotime($dia));
                                    echo"
                                       <tr>
                                       <input type='hidden' name='IDmilitar[$id_situacao]' value='$cat_id_escala'/>
                                       <input type='hidden' name='id_situacao[$id_situacao]' value='$id_situacao'/>
                                       <td><input class='form-control' type='text' placeholder='$motivo' readonly>
                                       <td><input type='date' class=' border rounded' name='data_inicio[$id_situacao]' value='$data_inicio' ></td>
                                       <td><input type='date' class=' border rounded' name='data_fim[$id_situacao]' value='$data_fim'></td>";
                                       if($ativo == '1'){
                                       echo"<td><input type='checkbox' name='ativo[$id_situacao]'  value='0' checked/></td>";
                                       }
                                       else{
                                       echo"<td><input type='checkbox' name='ativo[$id_situacao]'  value='0' /></td>";
                                       }
                                              
                                       if ($ativo == 0) {
                                            echo"<td>Nao</td>";
                                       }
                                       else{
                                           echo"<td>Sim</td>";
	                                    }
                                        echo"<td><input type='checkbox' name='excluir[$id_situacao]'  value='1' /></td></tr>";                                
                                }
                           }
                           else{
                               echo "<td>Nenhum usuario cadastrado</td>";
                           }

                        ?>
                        <td><button class="w-100 btn btn-lg btn-secondary" type="submit" value="Confirmar">Confirmar</button></td>
                
                    </form>
                </table>
        </div>
        <div class="dependentes container border rounded p-3 mb-2 bg-light text-dark ">
        <table class="table">
        <form action="adicionar_situacao.php" method="POST" >
        <?php
              echo"
                  <input type='hidden' name='IDmilitar' value='$cat_id_escala'/>
                  <input type='hidden' value='0' name='ativo'>
                  
                  <tr>
                  <th>Militar</th>
                  <th>Motivo</th>
                  <th>Data de inicio</th>
                  <th>Data de fim</th>
                  <th>Prejuiso na escala</th>
                  </tr>
                  <td>$numero - $nomeguerra
                  <td><textarea rows='3' class='border rounded' name='motivo' ></textarea></td>
                  <td><input type='date' class=' border rounded' name='data_inicio' ></td>
                  <td><input type='date' class=' border rounded' name='data_fim'></td>
                  <td><input type='checkbox' name='ativo'  value='1' /></td>
                               
                    ";
            ?>
            <td><button class=" btn btn-lg btn-secondary " type="submit" value="Cadastrar">Adicionar</button></td>
                             </form>
                             </table>
                        </div>      
                
                <div class="container"> <?php include "../bordas/footer.html"; ?> </div>
    </div>       
</body>
</html>
