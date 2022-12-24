<?php

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: routes/home/home.php");
    exit;
}
require_once './connectionBD/connect.php';
$pdo = pdo_connect_mysql();

$username = $password = "";
$username_err = $password_err = $login_err = "";
$typeuser = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please fill username.";
    }
    else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please fill password.";
    }
    else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password, typeuser FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $typeuser = $row["typeuser"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["typeuser"] = $typeuser;

                            echo '<script type="text/javascript">jsFunction();</script>';
                            header("location: ../curriculolmalheiro/routes/home/home.php");
                        }
                        else{
                            $login_err = "Username or password wrong!";
                        }
                    }
                }
                else{
                    $login_err = "Username or password wrong!";
                }
            }
            else{
                echo "Ups! Try again please.";
            }

            unset($stmt);
        }
    }
    unset($pdo);
}
?>

<script>
    function jsFunction() {
        $('#myModal').modal('show')
    }
</script>


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

<?php
if(!empty($login_err)){
    echo '<div class="alert alert-danger">' . $login_err . '</div>';
}
?>

<section>
    <div class="card mx-auto" style="width: 30%; margin-top: 3rem; border: 0px">
        <img class="card-img-top" src="images/nature.png" alt="Luís Filipe Malheiro">
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label class="label" for="name">Username</label>
                    <input type="text" name="username" placeholder="Username" required class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label class="label" for="name">Password</label>
                    <input type="password" name="password" placeholder="Password" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div>
                    <button type="submit" class="button_login">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>
</body>


<div aria-live="polite" id="myModal" aria-atomic="true" style="position: relative; min-height: 200px;">
    <div class="toast" style="position: absolute; top: 0; right: 0;">
        <div class="toast-header">
            <img src="..." class="rounded mr-2" alt="...">
            <strong class="mr-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>