<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: routes/home/home.php");
    exit;
}
require_once './connectionBD/connect.php';
$pdo = pdo_connect_mysql();

$username = $password = "";
$username_err = $password_err = $login_err = "";

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
        $sql = "SELECT id, username, password FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            //redirect

                            header("location: curriculolmalheiro/routes/home/home.php");
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
                    <input type="text" class="form-control" placeholder="username" required>
                </div>
                <div class="form-group">
                    <label class="label" for="name">Password</label>
                    <input type="password" class="form-control" placeholder="password" required>
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