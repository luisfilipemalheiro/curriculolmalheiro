<!doctype html>
<html class="no-js" lang="pt">
<head>
    <title>Curriculo Luís Malheiro</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../curriculolmalheiro/styles/index.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php
require_once('connectionBD/connect.php');
$SQL = $LIGACAO->query('SELECT firstname, lastname, imagepath, description FROM aboutme');
$SQL->setFetchMode(PDO::FETCH_ASSOC);

while($row = $SQL->fetch()) {



?>
<section>
    <div class="row">
        <div class="col-12 col-lg-6">
            <img class="imagem" src="<?php echo $row['imagepath'];?>" alt="foto de perfil Luís Malheiro">
        </div>
        <div class="col-12 col-lg-6">
            <h1><?php echo $row['firstname'];?> <?php echo $row['lastname'];?></h1>
            <div class="descricao">
                <h5><?php echo $row['description'];?></h5>
            </div>
        </div>
    </div>
</section>

<?php
}
?>
<section>
    <hr class="linha">
    <div class="row">
        <div class="col-12 .col-sm-12 col-lg-4">
            <?php
            require_once 'skills.php';
            ?>
        </div>
        <div class="col-12 .col-sm-12 col-lg-8">
            <div class = "vertical">
                <?php
                require_once 'expirences.php';
                ?>
            </div>
        </div>
    </div>
</section>

<h4>Contactar</h4>

<div class="row">
    <div class="col-12">
        <form class="formulario">
            <div class="label">
                <input type="text" class="form-control" placeholder="Nome:">
                <input type="text" class="form-control" placeholder="Email:">
            </div>
            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Message:" rows="3"></textarea>
            <button class="button">Submit</button>
        </form>
    </div>
</div>

<div class="col-12">
    <?php
    require_once 'footer.php';
    ?>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
