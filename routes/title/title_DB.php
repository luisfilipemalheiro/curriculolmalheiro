<?php
require_once('../../connectionBD/connect.php');

// Verificação da existência de POST de informação, proveniente do formulário
$existemDadosPOST = false;
if (isset($_POST) && !empty($_POST)) {
    $existemDadosPOST = true;
    extract($_POST);
    $dados = array($firstaname, $lastname, $description, $imagepath);
    $INSTRUCAO = $LIGACAO->prepare('UPDATE aboutme SET firstname = ?, lastname = ?, description = ?, imagepath = ? WHERE id = ?');
    $INSTRUCAO->execute($dados);
}



if ($existemDadosPOST) {
    ?>
    <div class="alert alert-success" role="alert">
        <strong>Livro alterado com sucesso.</strong>
    </div>
    <a class="btn btn-primary float-end mt-5" href="atualizar_livro.php" role="button">Atualizar outro livro</a>
    <?php
} else {
    ?>
    <div class="alert alert-danger" role="alert">
        <strong>Acesso indevido a esta página.</strong>
    </div>
    <a class="btn btn-primary float-end mt-5" href="atualizar_livro.php" role="button">Atualizar livro</a>
    <?php
}
?>

?>
