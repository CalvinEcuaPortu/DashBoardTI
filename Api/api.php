<?php
header('Content-Type: text/html; charset=utf-8');

// Función para obtener la fecha y hora actual en el formato especificado
function getFormattedDateTime() {
    return date('Y/m/d H:i:s');
}

function getFormattedTime() {
    return date('H:i:s');
}

function getFormattedData() {
    return date('d/m/Y');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "recibido un POST";

    // Verificar si se han recibido los parámetros necesarios
    if(isset($_POST['valor']) && isset($_POST['valorHumeda'])) {
        // Obtener los valores de temperatura y humedad del POST
        $temperatura = $_POST['valor'];
        $humedad = $_POST['valorHumeda'];
        $electricidade = $_POST['valorEnergy'];
        $aparcamentos = $_POST['valorP'];
        $visitas =$_POST['visitas'];
        $vientos =$_POST['vientos'];
        $color =$_POST['warning'];

      
        // Formatear la fecha y hora actual
        $data_hora = getFormattedDateTime();
        $data_hora1 = getFormattedTime();
        $data_data = getFormattedData();

        // Archivo de registro
        $log_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\log.txt';

        // Escribir los datos de temperatura en el archivo de registro
        file_put_contents($log_file, "$data_hora;$temperatura" . PHP_EOL, FILE_APPEND);

        // Archivo de humedad
        $humeda_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Humedad\\valor.txt';
        file_put_contents($humeda_file, "$humedad" . PHP_EOL, FILE_APPEND);

         $energy_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Electricida\\valor.txt';
        file_put_contents($energy_file, "$electricidade" . PHP_EOL, FILE_APPEND);

        $aparcamento_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Aparcamento\\valor.txt';
        file_put_contents($aparcamento_file, "$aparcamentos" . PHP_EOL, FILE_APPEND);

        $visitas_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Visitas\\visitas.txt';
        file_put_contents($visitas_file, "$visitas" . PHP_EOL, FILE_APPEND);

         $vientos_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Vientos\\vientos.txt';
        file_put_contents($vientos_file, "$vientos" . PHP_EOL, FILE_APPEND);

         $warning_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Warning\\tipo.txt';
        file_put_contents($warning_file, "$color" . PHP_EOL, FILE_APPEND);

        // Actualizar el archivo de valor de temperatura
        $valor_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\valor.txt';
        file_put_contents($valor_file, "$temperatura" . PHP_EOL, FILE_APPEND);

        // Actualizar el archivo de hora
        $Hora_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\Hora.txt';
        file_put_contents($Hora_file, "$data_hora1" . PHP_EOL, FILE_APPEND);

        // Actualizar el archivo de fecha
        $data_file = 'C:\\UniServerZ\\www\\proyectoDef\\Api\\files\\Temperatura\\data.txt';
        file_put_contents($data_file, "$data_data" . PHP_EOL, FILE_APPEND);

        http_response_code(200); // OK
        echo "Valores escritos en el archivo de log y valor con éxito.";
    } else {
        http_response_code(400); // Bad Request
        echo "Los elementos necesarios no están presentes en la solicitud POST.";
        die(); // Terminar la ejecución del script
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "recibido un GET";
    http_response_code(200); // Define el código de estado HTTP para 200 OK
} else {
    http_response_code(400); // Define el código de estado HTTP para 400 Bad Request
    echo "Método no permitido";
    die(); // Terminar la ejecución del script
}
?>



