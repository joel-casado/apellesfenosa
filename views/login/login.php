<!doctype html>
<html lang="en">
<head>
    <title>Inicia Sessió</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css"> 
    <script src="assets/js/main.js"></script>
    <style>
        body {
            font-family: 'Overpass';
        }
    </style>
</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" id="imageLogo">
						<img src="assets/images/ocellLogo.png" alt="Italian Trulli">
                    </div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Inicia sessió</h3>
                            </div>
                        </div>
                        <form action="index.php?controller=Login&action=login" method="post" class="signin-form"> <!-- Enlace envio formulario -->
                            <div class="form-group mb-3">
                                <label class="label" for="name">Usuari</label><!--no borrar-->
                                <input type="text" name="username" class="form-control" placeholder="Introdueix el nom d'usuari" required> <!-- nombre -->
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Contrasenya</label><!--no borrar-->
                                <input type="password" name="password" class="form-control" placeholder="Introdueix la contrasenya" required> <!-- contraseña -->
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Inicia Sessió</button> <!--boton-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
