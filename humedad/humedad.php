<?php
session_start();

// Si se envía el formulario de logout
if(isset($_POST['logout'])) {
    // Destruir la sesión
    session_unset();
    session_destroy();
    // Redireccionar a la página de inicio
    header("Location: ../index.php");
    exit();
}

// Verificar si el usuario está logueado
if(!isset($_SESSION['username'])){
    // Si no está logueado, redireccionar a la página de inicio de sesión
    header("refresh:5;url=../index.php");
    echo "Acceso restringido. Redireccionando a la página de inicio de sesión en 5 segundos...";
    exit(); // Importante: detener la ejecución del script después de la redirección
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DashBoardTI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="estiloHum.css">
  </head>
  <body style="background: #F0F3F6 ;">






<div class="container-fluid">
   <br>
   <nav class="navbar" style="border-radius: 32px; padding: 10px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
     <div class="container-fluid">
       <div class="menu-item" href="../Dash/dash.php">
        <img src="../imagenes/logo.png" style="width:40px; ">
        <a class="navbar-brand"><b>Navbar</b></a>
      </div>
       <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
       </form>
      <span class="material-symbols-outlined">account_circle</span>
     </div>
   </nav>
   <br>
 </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <div class="card text-fluid" style="border-radius: 32px; padding: 10px;">
                <div class="card-body">
                    <h5 class="card-title">Menu</h5>

                   <div class="d-flex flex-column">
                    <a class="boton" href="../Dash/dash.php">
                        <div class="menu-item">
                            <span class="material-symbols-outlined" style="padding: 5px;">widgets</span>
                            <p class="card-text">Dashboard</p>
                        </div>
                    </a>

                    <a class="boton" href="../alumbrado/alumbrado.php">
                        <div class="menu-item">
                            <span class="material-symbols-outlined" style="padding: 5px;">light</span>
                            <p class="card-text">Iluminacion</p>
                        </div>
                    </a>

                    <a class="boton" href="../temperatura/temperatura.php">
                        <div class="menu-item">
                            <span class="material-symbols-outlined" style="padding: 5px;">thermometer</span>
                            <p class="card-text">Temperatura</p>
                        </div>
                    </a>

                    <a class="boton" href="../humedad/humedad.php">
                        <div class="menu-item">
                            <span class="material-symbols-outlined" style="padding: 5px;">humidity_percentage</span>
                            <p class="card-text">Humedad</p>
                        </div>
                    </a>

                    <a class="boton" href="../alertas/alertas.php">
                        <div class="menu-item">
                            <span class="material-symbols-outlined" style="padding: 5px;">emergency_home</span>
                            <p class="card-text">Alertas</p>
                        </div>
                    </a>

                    <a class="boton" href="../aparcamento/aparcamento.php">
                        <div class="menu-item">
                            <span class="material-symbols-outlined" style="padding: 5px;">garage</span>
                            <p class="card-text">Aparcamento</p>
                        </div>
                    </a>
                  </div>
                    <br>

                    <form class="d-flex" role="search" action="../index.php" method="POST">
                        <button class="btn btn-outline-success" type="submit">Logout</button>
                    </form>
                    <br>
                </div>
            </div>
            <br>
        </div>
       
         <div class="col-sm-8">
        <div class="col-sm-4">
           <div class="main--content">
             <div class="header--wrapper">
                <div class="header--title">
                   <div class="menu-item" >
                      <h2 style="display: inline-block; padding-right: 688px;" >Humedad</h2>
                      <div class="col-sm-5">
                         <div class="card text-center" style="border-radius: 24px; display: inline-block; margin-left: 20px;">   
                            <div class="card-body" >
                               <div class="menu-item">
                                <span class="material-symbols-outlined" style="padding-right: 10px;">calendar_today</span>
                                <div id="fechaActual"></div>

                              </div>
                               
                            </div>
                         </div>
                      </div>
                    </div>
                </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const fechaElement = document.getElementById("fechaActual");
            const now = new Date();
            fechaElement.innerText = now.toLocaleDateString(); // Muestra la fecha en el formato local
        });
    </script>
             </div>
           </div>
         </div>

   
            <div class="row">

                   <div class="col-sm-4">
                    <div class="card text-center"style="border-radius: 24px;">
                            
                        <div class="card-body">
                            <h5 class="card-title">Alumbrado Publico</h5>
                            <p class="card-text">Ligth</p>
                            <a href="#" class="btn btn-primary">Apagado</a>
                        </div>
                    </div>
                  </div>


                   <div class="col-sm-4">
               <div class="card text-center"style="border-radius: 24px;">
                            
                        <div class="card-body">
                            <h5 class="card-title">Temperatura ambiente</h5>
                            <p class="card-text">Temperature</p>
                            <a href="#" class="btn btn-primary">Apagado</a>
                        </div>
                    </div>
                  </div>


                  <div class="col-sm-4">
                    <div class="card text-center"style="border-radius: 24px;">
                            
                        <div class="card-body">
                            <h5 class="card-title">Humedad ambiente</h5>
                            <p class="card-text">Humidity</p>
                            <a href="#" class="btn btn-primary">Apagado</a>
                        </div>
                    </div>
                  </div>

            </div>
              
              <br>

             <div class="row">


                   <div class="col-sm-4">
               <div class="card text-center"style="border-radius: 24px;">
                           
                        <div class="card-body">
                            <h5 class="card-title">Alertas Importantes</h5>
                            <p class="card-text">Warnings</p>
                            <a href="#" class="btn btn-primary">Apagado</a>
                        </div>
                    </div>
                  </div>


                   <div class="col-sm-4">
                    <div class="card text-center"style="border-radius: 24px;">
                            
                        <div class="card-body">
                            <h5 class="card-title">Camara Publico</h5>
                            <p class="card-text">Public Cameras</p>
                            <a href="#" class="btn btn-primary">Apagado</a>
                        </div>
                    </div>
                  </div>


                   <div class="col-sm-4">
               <div class="card text-center"style="border-radius: 24px;">
                            
                        <div class="card-body">
                            <h5 class="card-title">Restaurantes</h5>
                            <p class="card-text">Restaurants</p>
                            <a href="#" class="btn btn-primary">Apagado</a>
                        </div>
                    </div>
                  </div>


            </div>  
            
            <br>  

   
<br>
        </div>
    </div>
</div>

 



    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
