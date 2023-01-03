<?php

require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This id not EXITS</div>"];
} elseif (empty($dados['descricaosf'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This description not EXITS</div>"];
}
else {
    $query_usuer= "UPDATE softskills SET descricao=:descricao WHERE id=:id";

    $query_usuer = $pdo->prepare($query_usuer);
    $query_usuer->bindParam(':descricao', $dados['descricaosf']);
    $query_usuer->bindParam(':id', $dados['id']);


    if ($query_usuer->execute()) {
        $data = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>SUCESS!!</div>"];
    } else {
        $data = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! Please insert valid description</div>"];
    }
}

echo json_encode($data);

?>