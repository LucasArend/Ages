<?php
    require_once 'classe.php';
    session_start();
    $u = new usuario();
$u->conectar('ages','localhost','ages','dna,Pncadm3'); 
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
        <div class="container border rounded p-3 mb-2 bg-light text-dark tamanho text-center">
                <div class=" container border rounded p-3 mb-2 bg-light text-dark teste">
            <table class="table">
                <tr>
                  <th scope="col">Serviço</th>
                  <th scope="col">Descrição</th>
                  <th scope="col">Folga preta</th>
                  <th scope="col">Folga Vermelha</th>
                  <th scope="col">Inativos</th>
                  <th scope="col">CIA</th>
                  <th scope="col">Visualizar</th>
                  <th scope="col">Excluir</th>
                </tr>

                <?php 
                    if(isset($_SESSION['login'] )){
            $sql = $pdo->prepare("SELECT * FROM escala");
            $sql->execute();
            if ($sql->rowCount() > 0) {
               while ( $row = $sql->fetch()){
                        extract($row);
                        echo "<tr>";
                        echo "<td>$servico</td>";
                        echo "<td>$descricao</td>";
                        echo "<td>$folga_preta</td>";
                        echo "<td>$folga_vermelha</td>";
                        echo "<td>$ativos</td>";
                        echo "<td>$cia</td>";
                        echo "<td><a href='../escala/ver_escala.php?id=$id_escala'> ver </a></td>";
                        echo"<form action='atualizar_index.php' method='POST'>
                        <td><input type='checkbox' name='excluir[$id_escala]'  value='1' /></td>
                        <input type='hidden' name='id_escala[$id_escala]' value='$id_escala'>
                        ";
                        
                        
               }
               echo "</tr>";
            }else{
                echo '<td>Nenhum usuario cadastrado</td>';
            }
        }
        

    
    else{
      echo"Bem-Vindo, convidado <br>";
      echo"Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
      echo"<br><a href='../login/login.html'>Faça Login</a> Para ler o conteúdo";
    }
                
                ?>
                </table>
                 <td><button class='w-100 btn btn-lg btn-secondary' type='submit' value='Confirmar'>Confirmar</button></td>
               </form>
        </div>
        </div>
                <div class="dependentes container border rounded p-3 mb-2 bg-light text-dark ">
        <form method="POST" action="../escala/inserir_escala.php">
            <input class="col-lg-2 border rounded" placeholder="Nome escala" type="text" name='servico'  required/>
            <input class="col-lg-2 border rounded" placeholder="Descrição" type="text" name='descricao'>
            <input class="col-lg-2 border rounded" placeholder="quantia" type="number" name='quantia'>
            <button class="btn-lg btn-secondary" type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">Cadastrar</button>
            </div>
            
             </form>
        <div class="container"> <?php include "../bordas/footer.html"; ?> </div>
    </div>
</body>
</html>