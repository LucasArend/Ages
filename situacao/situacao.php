 <?php
 session_start();
 require_once '../index/classe.php';
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


    </style>


    <!-- Custom styles -->
    <link href="signin.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="container "> <?php include "../bordas/header.html"; ?> </div>
        <div class=" container border rounded p-3 mb-2 bg-light text-dark tamanho">
            <h1 class="h3 mb-3 fw-normal text-center">Situação Militares</h1>
            <p>Procurar<input id='myInput' onkeyup='searchTable()' type='text' ></p>
            <table class="table" id='myTable'>
                <tr>
                  <th scope="col">Companhia</th>
                  <th scope="col">Serviço</th>
                  <th scope="col">Nome de guerra</th>
                  <th scope="col">Numero</th>
                  <th scope="col">Dispensado</th>
                </tr>
                <tbody>
                <?php 
                $u = new usuario();
                $u->conectar('ages','localhost','ages','dna,Pncadm3'); 
                $u->imprimir_situacao()
                ?>
                </tbody>
                </table>
        </div>
    </div>
}
</body>
</html>

<script>
function searchTable() {
    var input, filter, found, table, tr, td, i, j;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
</script>