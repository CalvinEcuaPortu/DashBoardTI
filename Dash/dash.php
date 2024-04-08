<?php
$valor_temperatura = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\valor.txt");
$valor_Humeda = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Humedad\\valor.txt");
$valor_electricida = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Electricida\\valor.txt");
$valor_warning = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Warning\\valor.txt");
$valor_alumbrado = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Alumbrado\\valor.txt");
$valor_Aparcamento = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Aparcamento\\valor.txt");
$hora_temperatura = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\Hora.txt");
$nome_temperatura = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\nombre.txt");
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
    <link rel="stylesheet" type="text/css" href="estilo/estilosD.css">
    <meta http-equiv="refresh" content="5">
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
                    <a class="boton">
                        <div class="menu-item" href="../Dash/dash.php">
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
                            <p class="card-text" >Alertas</p>
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
                        <button class="btn btn-outline-success" type="submit" >Logout</button>
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
                      <h2 style="display: inline-block; padding-right: 680px;" >DashBoard</h2>
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
                    <div class="card text-center" style="border-radius: 24px;">
                            
                        <div class="card-body">
                            <div class="col-sm-7">
                                
                            <h5 class="card-title" style="text-align: left;">Electricidade </h5>
                            <h5 class="card-title "style="text-align: left;  font-size: 40px;"><?php echo $valor_electricida;?>kWh</h5>
                            </div>
                            <p class="card-text " style="text-align: left;">Ultima actualizacao: <?php echo $hora_temperatura;?></p>
                        </div>
                    </div>
                  </div>


                   <div class="col-sm-4">
               <div class="card text-center" style="border-radius: 24px;">
                            
                        <div class="card-body">
                            <div class="col-sm-5">
                                
                            <h5 class="card-title" style="text-align: left;">Temperatura </h5>
                            <h5 class="card-title "style="text-align: left;  font-size: 40px;"><?php echo $valor_temperatura;?>°C</h5>
                            </div>
                            <p class="card-text " style="text-align: left;">Ultima actualizacao: <?php echo $hora_temperatura;?></p>
                        </div>
                    </div>
                  </div>


                  <div class="col-sm-4">
                    <div class="card text-center"style="border-radius: 24px;">
                            
                     <div class="card-body">
                            <div class="col-sm-5">
                                
                            <h5 class="card-title" style="text-align: left;">Humedad </h5>
                            <h5 class="card-title "style="text-align: left;  font-size: 40px;"><?php echo $valor_Humeda;?>%</h5>
                            </div>
                            <p class="card-text " style="text-align: left;">Ultima actualizacao: <?php echo $hora_temperatura;?></p>
                        </div>
                    </div>
                  </div>

            </div>
              
              <br>

             <div class="row">


                <div class="col-sm-4">
    <div class="card text-center" style="border-radius: 24px;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="card-title" style="text-align: left;">Warnings</h5>
                    <h5 class="card-title" style="text-align: left; font-size: 40px;"><?php echo $valor_warning;?></h5>
                    <p class="card-text" style="text-align: left;">Última actualización: <?php echo $hora_temperatura;?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="card text-center" style="border-radius: 24px;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="card-title" style="text-align: left;">Aparcamento</h5>
                    <h5 class="card-title "style=" text-align: left;  font-size: 40px;"><?php echo $valor_Aparcamento;?></h5>
                    </div>
                    <p class="card-text " style="text-align: left;">Ultima actualizacao: <?php echo $hora_temperatura;?></p>
                </div>
            </div>
        </div>
    </div>

<div class="col-sm-4">
    <div class="card text-center" style="border-radius: 24px;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="card-title" style="text-align: left;">Ilumbrado</h5>
                    <h5 class="card-title "style=" text-align: left;  font-size: 40px;"><?php echo $valor_alumbrado;?></h5>
                    </div>
                    <p class="card-text " style="text-align: left;">Ultima actualizacao: <?php echo $hora_temperatura;?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
   <div class="col-sm-6">
    <div class="card text-center" style="border-radius: 24px;">
        <div class="card-body" style="width: 450px;">
    <h5 class="card-title" style="text-align: left;">Visitantes</h5>
            <canvas id="myChart1"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const skipped = (ctx, value) => ctx.p0.skip || ctx.p1.skip ? value : undefined;
                const down = (ctx, value) => ctx.p0.parsed.y > ctx.p1.parsed.y ? value : undefined;

                const ctx1 = document.getElementById('myChart1').getContext('2d');
                new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: ['Segunda-Feira', 'Terca-Feira', 'Quarta-Feira', 'Quinta-Feira'],
                        datasets: [{
                            label: 'Visitantes',
                            data: [<?php echo $valor_temperatura; ?>, 30, 3, 40, 25],
                            borderColor: 'rgb(75, 192, 192)',
                            segment: {
                                borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)') || down(ctx, 'rgb(192,75,75)'),
                                borderDash: ctx => skipped(ctx, [6, 6]),
                            },
                            spanGaps: true
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>
<div class="col-sm-3">
    <div class="card text-center" style="border-radius: 24px;">
        <div class="card-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-12">
                    <img style="width: 138px; border-radius: 14px; margin-bottom: 10px;" src="../imagenes/luis.jpg">
                </div>
                <div class="col-sm-12">
                    <h5 class="card-title" style="font-size: 15px;">Luis Rodriguez</h5>
                    <p class="card-text" style="font-size: 15px;">Estudiante de TI</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-3">
    <div class="card text-center" style="border-radius: 24px;">
        <div class="card-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-12">
                    <img style="width: 138px; border-radius: 14px; margin-bottom: 10px;" src="../imagenes/andrea.jpeg">
                </div>
                <div class="col-sm-12">
                    <h5 class="card-title" style="font-size: 15px;">Andrea Tobar</h5>
                    <p class="card-text" style="font-size: 15px;">Estudiante de TI</p>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>





