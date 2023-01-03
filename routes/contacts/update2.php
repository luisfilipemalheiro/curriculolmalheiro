<?php

require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This id not EXITS</div>"];
} elseif (empty($dados['telephone'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This telephone not EXITS</div>"];
}elseif (empty($dados['email'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This email not EXITS</div>"];
}
else {
    $query_usuer= "UPDATE contacts SET telephone=:telephone, email=:email WHERE id=:id";

    $query_usuer = $pdo->prepare($query_usuer);
    $query_usuer->bindParam(':telephone', $dados['telephone']);
    $query_usuer->bindParam(':email', $dados['email']);
    $query_usuer->bindParam(':id', $dados['id']);


    if ($query_usuer->execute()) {
        $data = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>SUCESS!!</div>"];
    } else {
        $data = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! Please insert valid contacts</div>"];
    }
}

echo json_encode($data);

?>