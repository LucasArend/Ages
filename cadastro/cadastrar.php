 <?php
 session_start();
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

        .ajuste {
            margin-top: 100px;
        }
    </style>


    <!-- Custom styles -->
    <link href="signin.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="container ajuste"> <?php include "../bordas/header.html"; ?> </div>
        <div class="container border rounded p-3 mb-2 bg-light text-dark tamanho text-center">
            <main class="form-signin">
                <form method="POST" action="cadastro.php">
                    <h1 class="h3 mb-3 fw-normal">Ages</h1>

                    <div class="form-floating">
                        <input type="text" name="login" class="form-control" id="floatingInput" placeholder="Login">
                        <label for="floatingInput">Login</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Senha">
                        <label for="floatingPassword">Senha</label>
                    </div>
                     <div class="form-floating">
                        <input type="text" name="cia" class="form-control" id="floatingInput" placeholder="Cia">
                        <label for="floatingInput">Cia</label>
                    </div>
                    <div class="col-md-auto">
                        <label for="nivel" class="form-label">Nivel de permissão</label>
                        <select class="form-select" id="nivel" name="nivel" required>
                            <option value="1">Administrador</option>
                            <option value="2">Sargenteante</option>
                            <option value="3">Médico</option>
                        </select>
                    </div>
                    <br />
                    <button class="w-100 btn btn-lg btn-primary" type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">cadastrar</button>
                    <p class="mt-5 mb-3 text-muted"> 2021</p>
                </form>
            </main>
        </div>
        <div class="container"> <?php include "../bordas/footer.html"; ?> </div>
    </div>
</body>
</html>