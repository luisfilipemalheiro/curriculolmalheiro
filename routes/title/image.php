<?php

require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
echo empty($_POST);
if (!empty($_POST)) {


    $target_dir = "../../../curriculolmalheiro/images";
    $target_file = $target_dir . basename($_FILES["filename"]["name"]);

    if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
        #$stmt = $pdo->prepare('INSERT INTO teste (nome) VALUES (:filename)');
        $stmt = $pdo->prepare('UPDATE aboutme SET imagepath = :filename WHERE id=1');
        $stmt->bindParam(":filename", $target_file, PDO::PARAM_STR);
        $stmt->execute();
        $msg = 'Created Successfully!';
        header('Location: title.php');
    }

}
?>