<?php
session_start();

$username = "Luis";
$password_hash = '$2y$10$IJKD1ADf2/F7CU1CQStZzeqPXV2sjiAYZO7lhTzZkOmRUgivbvY/K'; 

if (isset($_POST['username']) && isset($_POST['password'])) {
  if ($_POST['username'] == $username && password_verify($_POST['password'], $password_hash)) {
    echo "Credenciales correctas";
    $_SESSION['username'] = $_POST['username'];
    header("Location: Dash/dash.php"); // Utiliza "Location" en lugar de "url" y la dirección completa de la página a la que deseas redirigir
    exit(); // Importante: detener la ejecución del script después de la redirección
  } else {
    echo "Credenciales incorrectas";
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo/style.css">
  </head>
  <body style="background-image:url('imagenes/fondo.jpg') ;background-repeat: no-repeat;background-size: cover;">

   <div class="container">
     <div class="row justify-content-center">
     <form class="TIform" method="POST" style="background-color: #FFFFFF ; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);"> <!-- Corrección en el método de envío del formulario -->
      <label>---------------- Dashboard IPLeria -----------------</label>
      <img class="img-fluid" src="imagenes/logo.png" height="20px">
  <p>
    <label class="row justify-content-center" for="signup">Login</label>
    <label for="username">Username</label><br>
    <input type="text" id="username" name="username" placeholder="Insira o seu Username"><br>
    <label for="password">Password</label><br>
    <input type="password" id="password" name="password" placeholder="Insira o seu Password"><br><br>
    <button type="submit" class="btn btn-primary">Submeter</button>
    <a href="#">Forgot Password?</a>
  </p>
</form>
     </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
