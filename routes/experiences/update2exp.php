<?php

require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This id not EXITS</div>"];
} elseif (empty($dados['titleexp'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This title not EXITS</div>"];
} elseif (empty($dados['descriptonexp'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This descripton not EXITS</div>"];
}
else {
    $query_exp= "UPDATE experience SET descripton=:descripton, title=:title WHERE id=:id";

    $query_exp = $pdo->prepare($query_exp);
    $query_exp->bindParam(':descripton', $dados['descriptonexp']);
    $query_exp->bindParam(':title', $dados['titleexp']);
    $query_exp->bindParam(':id', $dados['id']);


    if ($query_exp->execute()) {
        $data = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>SUCESS!!</div>"];
    } else {
        $data = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! Please insert valid data</div>"];
    }
}

echo json_encode($data);

?>
