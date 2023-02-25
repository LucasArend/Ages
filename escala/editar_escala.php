 <?php
     session_start();
     require_once '../index/classe.php';
    $u = new usuario();
    $u->conectar('ages','localhost','ages','dna,Pncadm3');
    global $pdo;
    $cat_id_escala= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = $pdo->prepare("SELECT id_previsao, dia, nomeguerra , previsao.folga_preta as folgap, previsao.folga_vermelha as folgav , trocas, numero, ID
                                      FROM previsao
                                      JOIN escala ON previsao.escala_prev = escala.id_escala
                                      JOIN militares ON militar_prev = militares.ID
                                      WHERE `id_escala` = $cat_id_escala
                                      ORDER BY dia;");
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
                
                <h1 class="h3 fw-normal text-center">Militares </h1>
                <?php echo"<a href='../escala/ver_escala.php?id=$cat_id_escala'><button class='btn-secondary float-end btn-small border rounded '>Voltar</button></a>"; ?>
                <table class="table">
                    <form action='atualizar_escala.php' method="POST">
                        <?php 
                            echo"
                                         <tr>
                                             <th>Militar</th>
                                             <th>Folga Preta</th>
                                             <th>Folga Vermelha</th>
                                             <th>Dia</th>
                                             <th>Trocas</th>
                                             <th>Excluir</th>
                                         </tr>";

                            if ($sql->rowCount() > 0) {
                                while ( $row = $sql->fetch()){
                                    extract($row);
                                    $dia_br = date("Y-m-d", strtotime($dia));
                                    echo"<input type='hidden' name='escala_prev[$id_previsao]' value=' $cat_id_escala'>
                                          <input type='hidden' name='id_prev[$id_previsao]' value=' $id_previsao'>                            
                                         <tr>";
                                               $resultado = $pdo->prepare("SELECT nomeguerra, numero, ID FROM militares");
                                               $resultado->execute();
                                               echo "<td><select class=' border rounded' name='militar_prev[$id_previsao]' value='$ID'>
                                               <option hidden value='$ID'>$nomeguerra - $numero</option>";
                                               while($row = $resultado->fetch()) {   
                                                   extract($row);
                                                   echo "<option value='$ID'>$nomeguerra - $numero </option>";
                                               }
                                               echo" </select></td>
                                               <td><input type='number' class='col-lg-2 border rounded' name='folga_preta[$id_previsao]' value='$folgap'></td>
                                               <td><input type='number' class='col-lg-2 border rounded' name='folga_vermelha[$id_previsao]' value='$folgav'></td>
                                               <td><p><input name='dia[$id_previsao]' value='$dia_br' type='date'  ></p></td>
                                               <td><select class=' border rounded' name='trocas[$id_previsao]' value=''>
                                               <option value='$trocas'>Ninguem</option>";
                                               $resultado = $pdo->prepare("SELECT nomeguerra, numero, ID FROM militares");
                                               $resultado->execute();
                                               while($row = $resultado->fetch()) {   
                                                   extract($row);
                                                   echo "<option value='$nomeguerra'>$nomeguerra - $numero</option>";
                                               }
                                               echo" </select></td>
                                               <td><input type='checkbox' name='excluir[$id_previsao]'  value='1' /></td>
                                       </tr>";                                     
  
                                
                                }
                           }else{
                               echo "<td>Nenhum usuario cadastrado</td>";
                           }

                        ?>
                        <td><button class="w-100 btn btn-lg btn-secondary" type="submit" value="Confirmar">Confirmar</button></td>
                
                    </form>
                </table>
        </div>
        <div class="dependentes container border rounded p-3 mb-2 bg-light text-dark ">
        <form action="adicionar_militar_previsao.php" method="POST" >
        <?php
           echo"
              <input type='hidden' name='id_escala' value='$cat_id_escala'/> 
              <select class=' border rounded' name='id_militar'>
                  <option hidden value='NULL'>Escolha o Militar</option>";
                  $resultado = $pdo->prepare("SELECT nomeguerra, numero, ID FROM militares");
                  $resultado->execute();
                  while($row = $resultado->fetch()) {   
                  extract($row);
                  echo "<option value='$ID'>$nomeguerra - $numero</option>";
              }  
              echo"
                  <td><input type='number' class='col-lg-2 border rounded' name='folgap' value='$nova_folgap'></td>
                  <td><input type='number' class='col-lg-2 border rounded' name='folgav' value='$nova_folgav'></td>
                               
                    ";
            ?>
            <button class=" btn btn-lg btn-secondary " type="submit" value="Cadastrar">Adicionar</button>
                             </form>
                        </div>      
                
                <div class="container"> <?php include "../bordas/footer.html"; ?> </div>
    </div>       
</body>
</html>
