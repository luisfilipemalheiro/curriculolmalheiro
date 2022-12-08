<?php

require "connectionBD/connect.php";
$pdo = pdo_connect_mysql();

$username = $typeuser = $name = $password = $confirm_password = "";
$username_err = $name_err = $typeuser_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please fill username.";
    }
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Wrong username pattern!";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Username already exists!";
                }
                else{
                    $username = trim($_POST["username"]);
                }
            }
            else{
                echo "Ups! Try again please.";
            }

            unset($stmt);
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please fill password.";
    }
    elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password need to be at least 6 chareters.";
    }
    else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["name"]))){
        $name_err = "Please fill name.";
    }
    elseif(strlen(trim($_POST["name"])) < 2){
        $name_err = "Password need to be at least 2 chareters.";
    }
    else{
        $name = trim($_POST["name"]);
    }

    if(empty(trim($_POST["typeuser"]))){
        $typeuser_err = "Please select typeuser.";
    }
    else{
        $typeuser = trim($_POST["typeuser"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please fill confirm password.";
    }
    else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords missmatch!";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($typeuser_err)){

        $sql = "INSERT INTO users(typeuser, idaboutme, username, password, nameuser) VALUES (:typeuser, 1, :username, :password, :name)";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":typeuser", $param_typeuser, PDO::PARAM_STR);


            $param_username = $username;
            $param_typeuser= $typeuser;
            $param_name = $name;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash


            if($stmt->execute()){

                header("location: login.php");
            }
            else{
                echo "Ups! Try again please.";
            }

            unset($stmt);
        }
    }

    unset($pdo);
}

$dados = array();
$INSTRUCAO = $LIGACAO->prepare('SELECT id, description FROM rolesuser');
$INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
$INSTRUCAO->execute($dados);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <title>Register - Back Office</title>
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

        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label class="label" for="name">Name</label>
                    <input type="text" name="name" placeholder="Name" required class="form-control" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label for="username" class="label" for="name">Username</label>
                    <input type="text" name="username"  placeholder="Username" required class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label class="label" for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <label class="label" for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="typeuser" class="label" >Type User</label>
                    <select class="form-select" id="typeuser" name="typeuser">
                        <option value="">Select User Type</option>
                        <?php
                        while($row = $INSTRUCAO->fetch()) {
                            ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['description'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <button class="button_login" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

</body>
</html>