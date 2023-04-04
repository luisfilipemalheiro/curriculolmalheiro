<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'si';
$DATABASE_PASS = 'si';
$DATABASE_NAME = 'SI';
# ligação à base de dados
try {
    $LIGACAO = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME;charset=utf8", $DATABASE_USER, $DATABASE_PASS); // new PDO(tipo da base de dados:string de conexão específica do tipo definido)
    $LIGACAO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    echo "Ocorreu um erro na ligação à base de dados";
    echo $e->getMessage();
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    exit();
}

function pdo_connect_mysql(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'curriculoluis';

    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME. ';charset=utf8',
            $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception){
        exit($exception->getMessage());
    }
}

$pdo = pdo_connect_mysql();


?>
