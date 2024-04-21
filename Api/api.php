<?php
header('Content-Type: text/html; charset=utf-8');

// Función para obtener la fecha y hora actual en el formato especificado
function getFormattedTime() {
    return date('H:i:s');
}
function getFormattedDate() {
    return date('Y-m-d');
}

// Comprueba si se ha recibido una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Recibido un POST";

    // Verificar si se han recibido los parámetros necesarios
    if(isset($_POST['hora']) && isset($_POST['nome']) && isset($_POST['valor'])) {
        // Obtener los valores del POST
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $hora = $_POST['hora'];
        $data = $_POST['data'];
        $tipo = $_POST['tipo'];
        $viento = $_POST['viento'];

        // Formatear la fecha y hora actual
        $data_hora = getFormattedTime();
        $data_fecha = getFormattedDate();

        // Archivos de valores
        $resultado = file_put_contents('files/' . $nome . '/valor.txt', $valor. PHP_EOL, FILE_APPEND);
        $resultado_nome = file_put_contents('files/' . $nome . '/nome.txt', "$nome". PHP_EOL, FILE_APPEND);
        $resultado_hora = file_put_contents('files/' . $nome . '/hora.txt', "$data_hora". PHP_EOL, FILE_APPEND);
        $resultado_data = file_put_contents('files/' . $nome . '/data.txt', "$data_fecha". PHP_EOL, FILE_APPEND);
        $resultado_tipo = file_put_contents('files/' . $nome . '/tipo.txt', "$tipo". PHP_EOL, FILE_APPEND);
        $resultado_viento = file_put_contents('files/' . $nome . '/viento.txt', "$viento". PHP_EOL, FILE_APPEND);

        if ($resultado !== false && $resultado_hora !== false) {
          $resultado_log = file_put_contents('files/' . $nome . '/log.txt', "$nome - $hora - $data -$valor". PHP_EOL, FILE_APPEND);
        }

        http_response_code(200); // OK
        echo "Valores escritos en los archivos con éxito.";
    } else {
        http_response_code(400); // Bad Request
        echo "Faltan elementos necesarios en la solicitud POST.";
        die(); // Terminar la ejecución del script
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "Recibido un GET";
    http_response_code(200); // OK
} else {
    http_response_code(400); // Bad Request
    echo "Método no permitido";
    die(); // Terminar la ejecución del script
}
?>

