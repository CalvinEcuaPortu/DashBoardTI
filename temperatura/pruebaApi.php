<?php
// Ruta del archivo valor.txt
$valor_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\valor.txt';
$valor_temperatura = file_get_contents($valor_file);
$hora_temperatura = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\Hora.txt");
$data_temperatura = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\data.txt");

$valor_Alerta = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Warning\\tipo.txt");
$viento_Alerta = file_get_contents("C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Vientos\\vientos.txt");

// Función para obtener el color de la alerta según el valor
function getAlertColor($alertValue) {
    switch ($alertValue) {
        case "High":
            return "red"; // Rojo para alerta alta
        case "Medium":
            return "yellow"; // Amarillo para alerta media
        case "Low":
            return "lightgreen"; // Verde claro para alerta baja
        case "Null":
            return "#010707"; // Negro para ninguna alerta
        default:
            return "#FFFFFF"; // Gris por defecto
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Valores de Temperatura</title>
</head>
<body>

<h2>Valores de Temperatura</h2>

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
                    <tbody id="seccionAActualizar">
                        <?php
                        // Dividir el contenido del archivo de valores en un array de líneas
                        $valores = explode(PHP_EOL, $valor_temperatura);
                        // Dividir el contenido del archivo de hora en un array de líneas
                        $horas = explode(PHP_EOL, $hora_temperatura);
                        // Dividir el contenido del archivo de fecha en un array de líneas
                        $fechas = explode(PHP_EOL, $data_temperatura);
                        // Dividir el contenido del archivo de fecha en un array de líneas
                        $alerta = explode(PHP_EOL, $valor_Alerta);
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
                                echo "<td><div class='alert-circle' style='background-color: " . getAlertColor($alerta[$key]) . "; width: 10px; height: 10px; border-radius: 50%;'></div></td>";
                                echo "<td>$viento[$key]</td>"; // Cambiado de $viento a $viento[$key]
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

<script>
    // Función para actualizar automáticamente la sección cada 5 segundos
    setInterval(function(){
        // Realizar una solicitud fetch para obtener el nuevo contenido
        fetch("ruta/a/tu/script.php")
            .then(response => response.text()) // Convertir la respuesta a texto
            .then(data => {
                // Actualizar el contenido del contenedor con el nuevo contenido obtenido
                document.getElementById("seccionAActualizar").innerHTML = data;
            })
            .catch(error => console.error('Error al obtener el contenido:', error));
    }, 5000); // 5000 milisegundos = 5 segundos
</script>

</body>
</html>
