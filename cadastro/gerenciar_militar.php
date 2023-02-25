 <?php
 session_start();
 require_once '../index/classe.php';
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
            margin-bottom: 100px;
        }



body {
  flex-direction: column;
}
    </style>


    <!-- Custom styles -->
    <link href="signin.css" rel="stylesheet">
</head>

<body >
    <div class="container tamanho ">
        <div class="container"> <?php include "../bordas/header.html"; ?> </div>
        <div class=" container border rounded p-3 mb-2 bg-light text-dark teste">
         <a href="../cadastro/editar_militar.php"><button class="btn-secondary float-end btn-small border rounded ">Editar</button></a>
            <h1 class="h3 mb-3 fw-normal text-center">Gerenciar Militares </h1>
            <table class="table">
                <tr>
                  <th scope="col">Companhia</th>
                  <th scope="col">Posto</th>
                  <th scope="col">Nome de guerra</th>
                  <th scope="col">Numero</th>
                  <th scope="col">Situação</th>
                </tr>

                <?php 
                $u->imprimir()
                ?>
                </table>
        </div>
        <div class="dependentes container border rounded p-3 mb-2 bg-light text-dark ">
        <form method="POST" action="cadastrar_militar.php">
            <input class="col-lg-2 border rounded" placeholder="Nome de guerra" type="text" name='nomeguerra'  required/>
            <input class="col-lg-2 border rounded" placeholder="Numero" type="number" name='numero' required />
            <select class="col-lg-2 border rounded" id="companhia" name='companhia' required>
                    <option value="1CIA">1ºCIA</option>
                    <option value="2CIA">2ºCIA</option>
                    <option value="3CIA">3ºCIA</option>
                    <option value="CCAP">CCAP</option>
                    <option value="CEP">CEP</option>              
            </select>
            <select class="col-lg-2 border rounded" id="posto" name='posto' required>
                    <option value="plantao">Plantão</option>
                    <option value="cbdia">CBDIA</option>
                    <option value="sgtedia">SGTEDIA</option>             
            </select>
            </div>
            <button class="w-100 btn btn-lg btn-secondary" type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">Cadastrar</button>
             </form>
        <div class="container"> <?php include "../bordas/footer.html"; ?> </div>
    </div>
    <script type="text/javascript">//<![CDATA[
</body>
</html>