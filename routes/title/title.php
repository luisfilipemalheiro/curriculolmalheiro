<?php
require_once '../menu.php';
?>

<script>
    function openmodal() {
        $('#myModal').modal('show')
    }
</script>

<html>

<section style="padding: 40px">
    <div class="card" style="margin-bottom: 30px">
        <div class="card-header">
            <div class="title" style="font-family: Courier New, monospace; font-size: 20px">
                Title
            </div>
        </div>
    </div>

    <?php
    require_once('../../connectionBD/connect.php');
    # podemos utilizar diretamente o método ->query() uma vez que, ainda, não estamos a utilizar varíaveis na instrução SQL
    $INSTRUCAO = $LIGACAO->query('SELECT firstname, lastname, description, imagepath from aboutme');

    # definir o fetch mode
    $INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
    ?>


    <table class="table" style="padding: 60px">
        <thead class="table-dark">
        <tr>
            <td>First Name</td>
            <td>Last Name</td>
            <td>About me</td>
            <td>Photo Path</td>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row = $INSTRUCAO->fetch()) {
        ?>
        <tr ondblclick="openmodal()">
            <td><?php echo $row['firstname'];?></td>
            <td><?php echo $row['lastname'];?></td>
            <td><?php echo $row['description'];?></td>
            <td><?php echo $row['imagepath'];?></td>

        </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</section>


<?php
require_once('../../connectionBD/connect.php');
if (isset($_GET['id'])) {
    $dados = array($_GET['id']);
    echo $dados[0];
    $INSTRUCAO = $LIGACAO->prepare('SELECT firstname, lastname, description, imagepath FROM aboutme');
    $INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
    $INSTRUCAO->execute($dados);
    $rowLivro = $INSTRUCAO->fetch();
    $numero_registos = $INSTRUCAO->rowCount();
    $dados = array();
} else {
    $numero_registos = 0;
}
?>


<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                if ($numero_registos > 0) {
                ?>
                <form class="needs-validation" method="post" action="title_DB.php" novalidate>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $rowLivro['firstname']?>" required>
                            <div class="invalid-feedback">
                                Please insert First Name
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $rowLivro['lastname']?>" required>
                            <div class="invalid-feedback">
                                Please insert Last Name
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="imagepath">Image Path</label>
                            <input type="text" class="form-control" id="imagepath" name="imagepath" placeholder="Image Path" value="<?php echo $rowLivro['imagepath']?>" required>
                            <div class="invalid-feedback">
                                Please insert Image Path
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label for="description">About Luís Malheiro</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="About Luís Malheiro" value="<?php echo $rowLivro['description']?>" required>
                            <div class="invalid-feedback">
                                Please insert text about Luís Malheiro
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <?php
                } if($numero_registos != 0){
                    ?>
                    <button type="submit" class="btn btn-primary">Update Titles</button>
                    <?php
                }
                else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>ERROR! Not found</strong>
                    </div>
                    <?php
                }
                ?>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
          </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>