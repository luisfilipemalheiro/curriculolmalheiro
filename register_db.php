<?php


require_once('connectionBD/connect.php');

// Verificação da existência de POST de informação, proveniente do formulário
$existemDadosPOST = false;
if (isset($_POST) && !empty($_POST)) {
    $existemDadosPOST = true;
    extract($_POST);
    // com o extract são criadas variáveis com todas as entradas do array, no caso $_POST
    // os dados enviados pelo formulário são (ver atributo "name" nos campos dos formulários):
    //  - nomelivro
    //  - numpaginas
    //  - anolancamento
    //  - id_autor
    // Preparação de um array com os dados a inserir
    $dados = array($name, $username, $password);
    # preparar a query
    $INSTRUCAO = $LIGACAO->prepare('INSERT INTO users (id, typeuser, idaboutme, username, password, name) values (3, 1, 1, ?, ?, ?)');

    // Alternativamente poderia ser feito desta forma
    // atribuir variáveis a cada um dos place holders (?)
    // $INSTRUCAO->bindParam(1, $nomelivro);
    // $INSTRUCAO->bindParam(2, $numpaginas);
    // $INSTRUCAO->bindParam(3, $anolancamento);
    // $INSTRUCAO->bindParam(4, $id_autor);

    # executar instrução
    $INSTRUCAO->execute($dados);
}

require_once("register.php");
?>

