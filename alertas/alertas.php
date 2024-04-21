<?php

$valor_Alerta1 = file_get_contents("../Api/files/Warning/tipo.txt");
$viento_Alerta = file_get_contents("../Api/files/Warning/viento.txt");
$valor_temperatura = file_get_contents("../Api/files/Temperatura/valor.txt");
$hora_temperatura = file_get_contents("../Api/files/Warning/Hora.txt");
$data_temperatura = file_get_contents("../Api/files/Warning/data.txt");

// Función para obtener el color de la alerta según el valor
function getAlertColor($alerta) {
    switch ($alerta) {
        case "High":
            return "red"; // Rojo
        case "Medium":
            return "yellow"; // Amarillo
        case "Low":
            return "#229954"; // Verde
        case "Null":
            return "#17202A"; // Preto
        default:
            return "white"; // Blanco por defecto
    }
}
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
    <title>OceanView</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="estiloAlerta1.css">
    <link rel="icon" sizes="64x64" href="../imagenes/logo.ico" type="image/x-icon">
  </head>
  <body style="background: #2E4053 ;">
    <div class="container-fluid">
       <br>
       <nav class="navbar" style="border-radius: 32px; padding: 10px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); background-color: #FFFFFF;">
         <div class="container-fluid">
            <div class="menu-item" href="../Dash/dash.php">
            <img src="../imagenes/logo.png" style="width:40px; ">
            <a class="navbar-brand"><b>OceanView</b></a>
          </div>
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

                         <a class="boton" href="../historico/historico.php">
                            <div class="menu-item">
                                <span class="material-symbols-outlined" style="padding: 5px;">timeline</span>
                                <p class="card-text">Historico</p>
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
                                <span class="material-symbols-outlined" style="padding: 5px;">local_parking</span>
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
            <div class="col-sm-8">
               <div class="main--content">
                 <div class="header--wrapper">
                    <div class="header--title">
                       <div class="menu-item" >
                          <h2 style="display: inline-block; padding-right: 696px;color: #FDFEFE ;" >Warnings</h2>
                          <div class="col-sm">
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

    <div class="row justify-content-center">
        <div class="col-sm">
            <div class="card text-center" style="border-radius: 24px;">
                <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" style="border-radius: 24px;">
                        <div class="carousel-item active">
                            <img style="border-radius: 24px;" src="../imagenes/principal11.jpg" class="d-block w-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img style="border-radius: 24px;" src="../imagenes/verde1.jpg" class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img style="border-radius: 24px;" src="../imagenes/amarillo1.jpg" class="d-block w-100" alt="Slide 3">
                        </div>
                        <div class="carousel-item">
                            <img style="border-radius: 24px;" src="../imagenes/rojo1.jpg" class="d-block w-100" alt="Slide 4">
                        </div>
                        <div class="carousel-item">
                            <img style="border-radius: 24px;" src="../imagenes/negro1.jpg" class="d-block w-100" alt="Slide 5">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm">
                <div class="card text-center" style="border-radius: 24px;">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: left;">Historico Warnings</h5>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Check</th>
                                <th scope="col">Temperatura</th>
                                <th scope="col">Data de actualizacao</th>
                                <th scope="col">Hora de actualizacao</th>
                                <th scope="col">Alertas</th>
                                <th scope="col">Vientos</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // Dividir el contenido del archivo de valores en un array de líneas
                            $valores = explode(PHP_EOL, $valor_temperatura);
                            // Dividir el contenido del archivo de hora en un array de líneas
                            $horas = explode(PHP_EOL, $hora_temperatura);
                            // Dividir el contenido del archivo de fecha en un array de líneas
                            $fechas = explode(PHP_EOL, $data_temperatura);
                            // Dividir el contenido del archivo de fecha en un array de líneas
                            $alerta = explode(PHP_EOL, $valor_Alerta1);
                            // Dividir el contenido del archivo de fecha en un array de líneas
                            $viento = explode(PHP_EOL, $viento_Alerta);

                            // Contador para el id del checkbox
                            $checkbox_id = 1;
                            // Iterar sobre cada valor de temperatura y mostrarlo en una fila de la tabla
                            foreach ($valores as $key => $valor) {
                                // Verificar si el valor de temperatura es válido
                                if (!empty($valor)) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "<input class='form-check-input me-1' type='checkbox' value='' id='checkbox$checkbox_id'>";
                                    echo "</td>";
                                    // Verificar si el índice actual existe en el array de horas antes de mostrarlo
                                    $hora = isset($horas[$key]) ? $horas[$key] : '';
                                    $fecha = isset($fechas[$key]) ? $fechas[$key] : '';
                                    echo "<td>$valor °C</td>";
                                    echo "<td>$fecha</td>";
                                    echo "<td>$hora</td>";
                                    // Añadir la bolita de color que cambia según el valor de alerta
                                    echo "<td><div class='alert-circle' style='background-color: " . getAlertColor($alerta[$key]) . ";'></div></td>";
                                    echo "<td>$viento[$key] km</td>"; // Cambiado de $viento a $viento[$key]
                                    echo "</tr>";
                                    $checkbox_id++;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
