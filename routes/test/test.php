<?php

require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {


    $target_dir = "../../images/";
    $target_file = $target_dir . basename($_FILES["filename"]["name"]);

    if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
        $stmt = $pdo->prepare('INSERT INTO teste (nome,descricao) VALUES (:filename, :description)');
        $stmt->bindParam(":filename", $target_file, PDO::PARAM_STR);
        $stmt->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
        $stmt->execute();
        // Output message
        $msg = 'Created Successfully!';
    }

}
?>

<div class="content update">
    <h2>Create Hobbie</h2>
    <form action="test.php" method="post" enctype="multipart/form-data">
        <label for="filename">Filename</label>
        <input type="file" name="filename" placeholder="c://" id="filename" required>

        <label for="description">Description</label>
        <input type="text" name="description" placeholder="hello!" id="description">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php endif; ?>
</div>