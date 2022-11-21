<html>

<head>
    <title>Login - Back Office</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/login.css">
</head>

<body>

<?php
require_once './routes/headers.php';
?>

<section>
    <div class="card mx-auto" style="width: 30%; margin-top: 3rem; border: 0px">
        <img class="card-img-top" src="images/nature.png" alt="Luís Filipe Malheiro">
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label class="label" for="name">Username</label>
                    <input type="text" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label class="label" for="name">Password</label>
                    <input type="password" class="form-control" placeholder="Password" required>
                </div>
                <div>
                    <button class="button_login">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>