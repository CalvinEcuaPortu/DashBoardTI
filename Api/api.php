<?php 

header('Content-Type: text/html; charset=utf-8');

echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "recebi um POST";
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "recebi um GET";
} else {
    echo "metodo nao permitido";
}

print_r($_POST);

if(isset($_POST['valor'])) {
    // Obtenha o valor da temperatura
    $temperatura = $_POST['valor'];

    // Escreva o valor no arquivo valor.txt na pasta temperatura
    $bytes_escritos = file_put_contents('C:\\UniServerZ\\www\\ti\\Api\\files\\Temperatura\\valor.txt', $temperatura);
    
    if ($bytes_escritos === false) {
        die('Error al escribir en el archivo');
    } else {
        echo("A temperatura atual é ".$temperatura);
    }
}

if(isset($_POST['hora'])) {
    // Obtenha o valor da temperatura
    $hora = $_POST['hora'];

    // Escreva o valor no arquivo valor.txt na pasta temperatura
    $bytes_escritos = file_put_contents('C:\\UniServerZ\\www\\ti\\Api\\files\\Temperatura\\Hora.txt', $hora);
    
    if ($bytes_escritos === false) {
        die('Error al escribir en el archivo');
    } else {
        echo("A temperatura atual é ".$hora);
    }
}


if(isset($_POST['hora']) && isset($_POST['nome']) && isset($_POST['valor'])) {
    // Obtenha o valor da temperatura
    $log = array($_POST['hora'], $_POST['nome'], $_POST['valor']);


    // Escreva o valor no arquivo Log.txt na pasta temperatura
    $bytes_escritos = file_put_contents('C:\\UniServerZ\\www\\ti\\Api\\files\\Temperatura\\Log.txt', $log);
    
    if ($bytes_escritos === false) {
        die('Error al escribir en el archivo');
    } else {
        echo("El log actual es ".$log);
    }
} else {
    echo "Los elementos necesarios no están presentes en la solicitud POST.";
}

?>
