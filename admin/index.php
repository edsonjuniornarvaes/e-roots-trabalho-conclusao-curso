<!DOCTYPE html>
<html>

<head>
    <title>E-Roots - Sistema para Tabacaria</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="../arquivos/imagens/icone.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>

</head>

<body>
<div class="container">
<div class="row">
        <div class="col-md-3 col-xl-3 col-sm-12"></div>
        <div class="wrapper col-md-6 col-xl-6 col-sm-12">
            <form action="verificar.php" data-parsley-validate method="post" class="form-signin">

                <h3 class="form-signin-heading" id="lg">
                    <img src="../arquivos/imagens/logo1.png" id="logo1"><br>E-Roots</h3>
                <hr class="sublinha">

                <label for="login" id="lb"><i class="fa fa-user-circle" id="red"></i> <b>Login:</b></label>
                <input type="text" class="form-control" name="login" required class="form-control" data-parsley-required-message="Por favor preencha o Login"><br>

                <label for="senha" id="lb"><i class="fa fa-key" id="red"></i> <b>Senha:</b></label>
                <input type="password" class="form-control" name="senha" required class="form-control" data-parsley-required-message="Por favor preencha a Senha"> <br>
            
                <button class="btn btn-lg btn-outline-danger btn-block" id="logn" type="submit">Login</button></br>
            </form>
        </div>
        <div class="col-md-3 col-xl-3 col-sm-12"></div>
    </div>
    </div>

    </div>
    </div>
    </div>
</body>

</html>