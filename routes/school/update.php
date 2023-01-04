<?php
require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query = "SELECT id, description, startyear, endyear FROM scholl WHERE id =:id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id);
    $result->execute();

    $update = $result->fetch(PDO::FETCH_ASSOC);

    $data = ['error' => false, 'school' => $update];
} else {
    $data = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! School not exists</div>"];
}

echo json_encode($data);