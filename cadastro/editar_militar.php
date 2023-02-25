 <?php
 session_start();
 require_once '../index/classe.php';
$u = new usuario();
$u->conectar('ages','localhost','ages','dna,Pncadm3');
global $pdo;
$sql = $pdo->prepare("SELECT * FROM militares order by companhia");
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
        <a href="../cadastro/gerenciar_militar.php"><button class="btn-secondary float-end btn-small border rounded" >Voltar</button></a>
            <h1 class="h3 mb-3 fw-normal text-center">Militares </h1>
            <table class="table">


            <form action='atualizar_militar.php' method="POST">
                <?php 
                if ($sql->rowCount() > 0) {
                    while ( $row = $sql->fetch()){
                        extract($row);
                        echo"<div class='dependentes container border rounded p-3 mb-2 bg-light text-dark '>";
                        echo"<input type='hidden' name='id_militares[$ID]' value='$ID'>";
                        echo" <select class='col-lg-2 border rounded' name='companhia[$ID]' class='col-lg-2 border rounded' value='$companhia'>
                                <option hidden value='$companhia'>$companhia</option>
                                <option value='1CIA'>1CIA</option>
                                <option value='2CIA'>2CIA</option>
                                <option value='3CIA'>3CIA</option>
                                <option value='CEP'>CEP</option>
                                <option value='CCAP'>CCAP</option> 
                        </select>";
                        echo" <select class='col-lg-2 border rounded' name='posto[$ID]' value='$posto'>;
                                <option hidden value='$posto'>$posto</option>
                                <option value='Plantão'>Plantão</option>
                                <option value='CBDIA'>CBDIA</option>
                                <option value='SGTEDIA'>SGTEDIA</option>             
                        </select>";
                        echo"<input type='text' class='col-lg-2 border rounded' name='nomeguerra[$ID]' value='$nomeguerra'>";
                        echo"<input type='number' class='col-lg-2 border rounded' name='numero[$ID]' value='$numero'>";
                        echo"<input type='checkbox' name='excluir[$ID]'  value='1'>Excluir</>
                        </div> ";
                        
               }
            }else{
                echo '<td>Nenhum usuario cadastrado</td>';
            }

                ?>
                
                <button class="w-100 btn btn-lg btn-secondary" type="submit" value="Confirmar">Confirmar</button>
                </form>
                </table>
        </div>
        
</body>
</html>