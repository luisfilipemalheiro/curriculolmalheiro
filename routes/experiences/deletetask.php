
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<?php

require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$task) {
        exit('Task doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the Task!';
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
                        Delete Task
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Are you sure you want to delete Task #<?=$task['id']?>?</h5>
                        <p class="card-text"></p>
                        <a href="deletetask.php?id=<?=$task['id']?>&confirm=yes" style="width: 80px" class="btn btn-danger">Yes</a>
                        <a href="deletetask.php?id=<?=$task['id']?>&confirm=no" style="width: 80px" class="btn btn-secondary">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>



