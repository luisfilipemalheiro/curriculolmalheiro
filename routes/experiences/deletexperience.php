
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<?php

require_once('../../connectionBD/connect.php');
$INSTRUCAO = $LIGACAO->query('SELECT idexpirence from tasks');
$INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);

$pdo = pdo_connect_mysql();
$msg = '';
$row = $INSTRUCAO->fetch();




if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM experience WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $experience = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$experience) {
        exit('Experience doesn\'t exist with that ID!');
    }


    while($row = $INSTRUCAO->fetch()) {
    if ($experience['id'] == $row['idexpirence']){
        ?>
        <section class="vh-100" style="background-color: #00000057;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-7">
                        <div class="card">
                            <div class="card-header">
                                Delete Experience
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Not possible remove experience because exists tasks</h5>
                                <p class="card-text"></p>

                                <a href="experiences.php" style="width: 80px" class="btn btn-primary">Close</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
        //break;
    }
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM experience WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the Experience!';
            header('Location: experiences.php');
        } else {
            header('Location: experiences.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<section class="vh-100" style="background-color: #00000057;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-7">
                <div class="card">
                    <div class="card-header">
                        Delete Experience
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Are you sure you want to delete Experience #<?=$experience['id']?>?</h5>
                        <p class="card-text"></p>
                        <a href="deletexperience.php?id=<?=$experience['id']?>&confirm=yes" style="width: 80px" class="btn btn-danger">Yes</a>
                        <a href="deletexperience.php?id=<?=$experience['id']?>&confirm=no" style="width: 80px" class="btn btn-secondary">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



