<?php

$valor_Humeda = file_get_contents("../Api/files/Humedad/valor.txt");
$hora_Humeda = file_get_contents("../Api/files/Humedad/Hora.txt");
$data_Humeda = file_get_contents("../Api/files/Humedad/data.txt");
$nome_Humeda = file_get_contents("../Api/files/Humedad/nome.txt");

$valor_temperatura = file_get_contents("../Api/files/Temperatura/valor.txt");
$hora_temperatura = file_get_contents("../Api/files/Temperatura/Hora.txt");
$data_temperatura = file_get_contents("../Api/files/Temperatura/data.txt");
$nome_temperatura = file_get_contents("../Api/files/Temperatura/nome.txt");

$valor_Alumbrado = file_get_contents("../Api/files/Alumbrado/valor.txt");
$hora_Alumbrado = file_get_contents("../Api/files/Alumbrado/Hora.txt");
$data_Alumbrado = file_get_contents("../Api/files/Alumbrado/data.txt");
$nome_Alumbrado = file_get_contents("../Api/files/Alumbrado/nome.txt");

$valor_Aparcamentos = file_get_contents("../Api/files/Aparcamento/valor.txt");
$hora_Aparcamentos = file_get_contents("../Api/files/Aparcamento/Hora.txt");
$data_Aparcamentos = file_get_contents("../Api/files/Aparcamento/data.txt");
$nome_Aparcamentos = file_get_contents("../Api/files/Aparcamento/nome.txt");  

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
    <link rel="stylesheet" type="text/css" href="historico.css">
     <link rel="icon" sizes="64x64" href="../imagenes/logo.ico" type="image/x-icon">
    
  </head>
  <body style="background: #2E4053 ;">

<div class="container-fluid">
   <br>
   <nav class="navbar" style="border-radius: 32px; padding: 10px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
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
                      <h2 style="display: inline-block; padding-right: 696px; color: #FDFEFE ;" >Historico</h2>
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
<br>

<div class="row justify-content-center">
    <div class="col-sm">
        <div class="card text-center" style="border-radius: 24px;">
            <div class="card-body">

                 <nav aria-label="...">
      <ul class="pagination pagination-lg">
        <li class="page-item">
            <a class="page-link" href="#" onclick="showTable(1)">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#" onclick="showTable(2)">2</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#" onclick="showTable(3)">3</a>
        </li>
           <li class="page-item">
            <a class="page-link" href="#" onclick="showTable(4)">4</a>
        </li>
    </ul>
</nav>

<!-- Define your tables here, each wrapped in a div with a unique ID -->
<div id="table1" style="display: none;">
    <table class="table">
        <thead>
            <div class="menu-item">
                <span class="material-symbols-outlined" style="padding: 5px;">humidity_percentage</span>
                <h5 class="card-text">Humedad</h5>
            </div>
            <tr>
                <th scope="col">Check</th>
                <th scope="col">Tipo</th>
                <th scope="col">Valor</th>
                <th scope="col">Data de atualização</th>
                <th scope="col">Hora de atualização</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Dividir el contenido del archivo de valores en un array de líneas
            $historico = explode(PHP_EOL, $nome_Humeda);
            // Dividir el contenido del archivo de valores en un array de líneas
            $valores = explode(PHP_EOL, $valor_Humeda);
            // Dividir el contenido del archivo de hora en un array de líneas
            $horas = explode(PHP_EOL, $hora_Humeda);
            // Dividir el contenido del archivo de fecha en un array de líneas
            $fechas = explode(PHP_EOL, $data_Humeda);
            // Contador para el id del checkbox
            $checkbox_id = 1;
            // Iterar sobre cada valor de humedad y mostrarlo en una fila de la tabla
            foreach ($valores as $key => $valor) {
                // Verificar si el valor de humedad es válido
                if (!empty($valor)) {
                    echo "<tr>";
                    echo "<td>";
                    echo "<input class='form-check-input me-1' type='checkbox' value='' id='checkbox$checkbox_id'>";
                    echo "</td>";
                    // Verificar si el índice actual existe en el array de horas antes de mostrarlo
                    $hora = isset($horas[$key]) ? $horas[$key] : '';
                    $fecha = isset($fechas[$key]) ? $fechas[$key] : '';
                    echo "<td>$historico[$key]</td>"; // Mostrar el tipo de humedad correspondiente
                    echo "<td>$valor %</td>";
                    echo "<td>$fecha</td>";
                    echo "<td>$hora</td>";
                    echo "</tr>";
                    $checkbox_id++;
                }
            }
            ?>
        </tbody>
    </table>
</div>


<div id="table2" style="display: none;">
    <table class="table">
        <thead>
            <div class="menu-item">
                <span class="material-symbols-outlined" style="padding: 5px;">thermometer</span>
                <h5 class="card-text">Temperatura</h5>
            </div>
            <tr>
                <th scope="col">Check</th>
                <th scope="col">Tipo</th>
                <th scope="col">Valor</th>
                <th scope="col">Data de atualização</th>
                <th scope="col">Hora de atualização</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Dividir el contenido del archivo de valores en un array de líneas
            $historico = explode(PHP_EOL, $nome_temperatura);
            // Dividir el contenido del archivo de valores en un array de líneas
            $valores = explode(PHP_EOL, $valor_temperatura);
            // Dividir el contenido del archivo de hora en un array de líneas
            $horas = explode(PHP_EOL, $hora_temperatura);
            // Dividir el contenido del archivo de fecha en un array de líneas
            $fechas = explode(PHP_EOL, $data_temperatura);
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
                    echo "<td>$historico[$key]</td>"; // Mostrar el tipo de temperatura correspondiente
                    echo "<td>$valor °C</td>";
                    echo "<td>$fecha</td>";
                    echo "<td>$hora</td>";
                    echo "</tr>";
                    $checkbox_id++;
                }
            }
            ?>
        </tbody>
    </table>
</div>


<div id="table3" style="display: none;">
    <table class="table">
        <thead>
            <div class="menu-item">
                <span class="material-symbols-outlined" style="padding: 5px;">lightbulb</span>
                <h5 class="card-text">Iluminacion</h5>
            </div>
            <tr>
                <th scope="col">Check</th>
                <th scope="col">Tipo</th>
                <th scope="col">Valor</th>
                <th scope="col">Data de atualização</th>
                <th scope="col">Hora de atualização</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Dividir el contenido del archivo de valores en un array de líneas
            $historico = explode(PHP_EOL, $nome_Alumbrado);
            // Dividir el contenido del archivo de valores en un array de líneas
            $valores = explode(PHP_EOL, $valor_Alumbrado);
            // Dividir el contenido del archivo de hora en un array de líneas
            $horas = explode(PHP_EOL, $hora_Alumbrado);
            // Dividir el contenido del archivo de fecha en un array de líneas
            $fechas = explode(PHP_EOL, $data_Alumbrado);
            // Contador para el id del checkbox
            $checkbox_id = 1;
            // Iterar sobre cada valor de iluminación y mostrarlo en una fila de la tabla
            foreach ($valores as $key => $valor) {
                // Verificar si el valor de iluminación es válido
                if (!empty($valor)) {
                    echo "<tr>";
                    echo "<td>";
                    echo "<input class='form-check-input me-1' type='checkbox' value='' id='checkbox$checkbox_id'>";
                    echo "</td>";
                    // Verificar si el índice actual existe en el array de horas antes de mostrarlo
                    $hora = isset($horas[$key]) ? $horas[$key] : '';
                    $fecha = isset($fechas[$key]) ? $fechas[$key] : '';
                    echo "<td>$historico[$key]</td>"; // Mostrar el tipo de iluminación correspondiente
                    echo "<td>$valor kWh</td>";
                    echo "<td>$fecha</td>";
                    echo "<td>$hora</td>";
                    echo "</tr>";
                    $checkbox_id++;
                }
            }
            ?>
        </tbody>
    </table>
</div>



<div id="table4" style="display: none;">
    <table class="table">
        <thead>
            <div class="menu-item">
                <span class="material-symbols-outlined" style="padding: 5px;">directions_car</span>
                <h5 class="card-text">Aparcamento</h5>
            </div>
            <tr>
                <th scope="col">Check</th>
                <th scope="col">Tipo</th>
                <th scope="col">Valor</th>
                <th scope="col">Data de atualização</th>
                <th scope="col">Hora de atualização</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Dividir el contenido del archivo de valores en un array de líneas
            $historico = explode(PHP_EOL, $nome_Aparcamentos);
            // Dividir el contenido del archivo de valores en un array de líneas
            $valores = explode(PHP_EOL, $valor_Aparcamentos);
            // Dividir el contenido del archivo de hora en un array de líneas
            $horas = explode(PHP_EOL, $hora_Aparcamentos);
            // Dividir el contenido del archivo de fecha en un array de líneas
            $fechas = explode(PHP_EOL, $data_Aparcamentos);
            // Contador para el id del checkbox
            $checkbox_id = 1;
            // Iterar sobre cada valor de humedad y mostrarlo en una fila de la tabla
            foreach ($valores as $key => $valor) {
                // Verificar si el valor de humedad es válido
                if (!empty($valor)) {
                    echo "<tr>";
                    echo "<td>";
                    echo "<input class='form-check-input me-1' type='checkbox' value='' id='checkbox$checkbox_id'>";
                    echo "</td>";
                    // Verificar si el índice actual existe en el array de horas antes de mostrarlo
                    $hora = isset($horas[$key]) ? $horas[$key] : '';
                    $fecha = isset($fechas[$key]) ? $fechas[$key] : '';
                    echo "<td>$historico[$key]</td>"; // Mostrar el tipo de humedad correspondiente
                    echo "<td>$valor P</td>";
                    echo "<td>$fecha</td>";
                    echo "<td>$hora</td>";
                    echo "</tr>";
                    $checkbox_id++;
                }
            }
            ?>
        </tbody>
    </table>
</div>


<script>
    // Function to show the selected table and hide others
    function showTable(tableNumber) {
        event.preventDefault();
        // Hide all tables
        document.querySelectorAll('.table-container').forEach(function(table) {
            table.style.display = 'none';
        });
        // Show the selected table
        document.getElementById('table' + tableNumber).style.display = 'block';
    }

    // Show table 1 by default when the page loads
    window.onload = function() {
        showTable(1);
    };
</script>


                
            </div>
        </div>
    </div>
</div>
<br>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>