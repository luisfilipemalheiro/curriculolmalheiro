<!doctype html>
<html class="no-js" lang="pt">

<head>
    <title>Curriculo Luís Malheiro</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<section>
    <div class="row">
        <div class="col-12 col-lg-6">
            <img class="imagem" src="./images/fotoperfil.jpeg" alt="foto de perfil Luís Malheiro">
        </div>
        <div class="col-12 col-lg-6">
            <h1>Luís Malheiro</h1>
            <div class="descricao">
                <h5>Luís Filipe Correia Malheiro, 20 anos (15/09/2001), natural de Refóios do Lima - Ponte de Lima.</h5>
            </div>
        </div>
    </div>
</section>
<section>
    <hr class="linha">
    <div class="row">
        <div class="col-12 .col-sm-12 col-lg-4">
            <?php
            require('./curriculo/skills.php');
            ?>
        </div>
        <div class="col-12 .col-sm-12 col-lg-8">
            <div class = "vertical">
                <?php
                require('./curriculo/expirences.php');
                ?>
            </div>
        </div>
    </div>
</section>
<h4>Contactar</h4>
<div class="row">
    <div class="col-12"> <!-- col-md-12 col-lg-6 -->
        <?php
        require('./curriculo/contactme.php');
        ?>
    </div>
</div>
<section>
</section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
