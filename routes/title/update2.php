<?php

require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This id not EXITS</div>"];
} elseif (empty($dados['firstname'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This name not EXITS</div>"];
} elseif (empty($dados['lastname'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This last name not EXITS</div>"];
} elseif (empty($dados['imagepath'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This image path not EXITS</div>"];
} elseif (empty($dados['description'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This description not EXITS</div>"];
}
else {
    $query= "UPDATE aboutme SET firstname=:firstname, lastname=:lastname, imagepath=:imagepath, description=:description WHERE id=:id";

    $query = $pdo->prepare($query);
    $query->bindParam(':firstname', $dados['firstname']);
    $query->bindParam(':lastname', $dados['lastname']);
    $query->bindParam(':imagepath', $dados['imagepath']);
    $query->bindParam(':description', $dados['description']);
    $query->bindParam(':id', $dados['id']);


    if ($query->execute()) {
        $data = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>SUCESS!!</div>"];
    } else {
        $data = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! Please insert valid data</div>"];
    }
}

echo json_encode($data);

?>