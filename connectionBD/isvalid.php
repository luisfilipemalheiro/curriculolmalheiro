<?php

function pdo_connect_mysql(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'curriculoluis';

    try{
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME. ';charset=utf8',
        $DATABASE_USER, $DATABASE_PASS);

        echo "connected";
    } catch (PDOException $exception){
        echo "failed";
        exit('Failed to connect to database');
    }
}

$pdo = pdo_connect_mysql();

?>