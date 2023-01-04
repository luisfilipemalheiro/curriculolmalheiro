<?php

require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This id not EXITS</div>"];
} elseif (empty($dados['description'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This description not EXITS</div>"];
} elseif (empty($dados['startyear'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This year not EXITS</div>"];
} elseif (empty($dados['endyear'])) {
    $data = ['ERROR' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! This year not EXITS</div>"];
}
else {
    $query_usuer= "UPDATE scholl SET description=:description, startyear=:startyear, endyear=:endyear WHERE id=:id";

    $query_usuer = $pdo->prepare($query_usuer);
    $query_usuer->bindParam(':description', $dados['description']);
    $query_usuer->bindParam(':startyear', $dados['startyear']);
    $query_usuer->bindParam(':endyear', $dados['endyear']);
    $query_usuer->bindParam(':id', $dados['id']);


    if ($query_usuer->execute()) {
        $data = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>SUCESS!!</div>"];
    } else {
        $data = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>ERROR! Please insert valid data</div>"];
    }
}

echo json_encode($data);

?>