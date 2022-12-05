<?php
require_once('connectionBD/connect.php');

// AUTORES: Extração da base de dados de todos os autores
// Para preenchimento do "select" do formulário
$dados = array();
# preparar a query
$INSTRUCAO = $LIGACAO->prepare('SELECT id, description FROM rolesuser');
# definir o fetch mode
$INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
# executar instrução
$INSTRUCAO->execute($dados);
?>
<html>
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
            <form action="register_db.php">
                <div class="form-group">
                    <label class="label" for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="username" class="label" for="name">Username</label>
                    <input type="text" class="form-control" id="username" name="username"  placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label class="label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
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
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>