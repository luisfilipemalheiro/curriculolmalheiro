<?php

function pdo(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'curriculoluis';

    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME. ';charset=utf8',
            $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception){
        exit('Failed to connect to database');
    }
}
$msg = '';


$pdo = pdo();

if (!empty($_POST)) {


    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    $stmt = $pdo->prepare('INSERT INTO messages (name, idaboutme, email, message) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, 1, $email, $message]);

    $msg = 'Created Successfully!';
    echo $msg;
}
?>