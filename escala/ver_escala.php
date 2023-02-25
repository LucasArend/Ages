<?php
    require_once '../index/classe.php';
    session_start();
    $u = new usuario();
$u->conectar('ages','localhost','ages','dna,Pncadm3'); 
$cat_id_escala= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
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
           <?php echo"<a href='../escala/editar_escala.php?id=$cat_id_escala'><button class='btn-secondary float-end btn-small border rounded '>Editar</button></a>"; ?>
                <?php 
                    if(isset($_SESSION['login'] )){
                     # $u->imprimir_previsao($cat_id_escala);

                    $resultado = $pdo->prepare("SELECT servico
                                  FROM escala
                                  WHERE `id_escala` = $cat_id_escala");
                    $resultado->execute();
                     while($row = $resultado->fetch()) {   
                        extract($row);
                
                    }
                    echo "<p ><h2 class='text-center'>$servico</h2></p>";



                    $resultado = $pdo->prepare("SELECT trocas, nomeguerra, dia
                                  FROM previsao
                                  JOIN escala ON previsao.escala_prev = escala.id_escala
                                  JOIN militares ON militar_prev = militares.ID
                                  WHERE `id_escala` = $cat_id_escala
                                  ORDER BY dia asc
                                  LIMIT 7;");
                    $resultado->execute();
                    echo "

                    <table class='table'>
                    <tr><th>nomeguerra</th>
                    ";
                    while($row = $resultado->fetch()) {   
                        extract($row);
                        echo "<td>$nomeguerra</td>";
                    }
                                        $resultado = $pdo->prepare("SELECT trocas, nomeguerra, dia
                                  FROM previsao
                                  JOIN escala ON previsao.escala_prev = escala.id_escala
                                  JOIN militares ON militar_prev = militares.ID
                                  WHERE `id_escala` = $cat_id_escala
                                  ORDER BY dia asc
                                  LIMIT 7;");
                    $resultado->execute();
                    echo "</tr>

                    <tr><th>Dia</th>
                    ";
                    while($row = $resultado->fetch()) {   
                        extract($row);
                        $dia_br = date("d/m/Y", strtotime($dia));
                        echo "<td>$dia_br</td>";
                    }
                    $resultado = $pdo->prepare("SELECT trocas, nomeguerra, dia
                                  FROM previsao
                                  JOIN escala ON previsao.escala_prev = escala.id_escala
                                  JOIN militares ON militar_prev = militares.ID
                                  WHERE `id_escala` = $cat_id_escala
                                  ORDER BY dia asc
                                  LIMIT 7;");
                    $resultado->execute();
                    echo "</tr>

                    <tr><th>Trocas</th>
                    ";
                    while($row = $resultado->fetch()) {   
                        extract($row);
                        echo "<td>$trocas</td>";
                    }
                    echo"</tr></table>";
                    }
                    else{
                      echo"Bem-Vindo, convidado <br>";
                      echo"Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
                      echo"<br><a href='../login/login.html'>Faça Login</a> Para ler o conteúdo";
                    } 
                ?>
            </div>
        </div>
            
        <div class="container"> <?php include "../bordas/footer.html"; ?> </div>

    </div>
</body>
</html>