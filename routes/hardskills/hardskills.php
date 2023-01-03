<?php
require_once '../menu.php';
?>
<script src="update.js"></script>

<script>
    function newmodal() {
        $('#adicionarModal').modal('show')
    }
    function eliminar() {
        $('#eliminar').modal('show')
    }

</script>

<html>

<section style="padding: 40px">
    <div class="card" style="margin-bottom: 30px">
        <div class="card-header">
            <div class="title" style="font-family: Courier New, monospace; font-size: 20px">
                Hard Skills
            </div>
        </div>
    </div>

    <?php
    require_once('../../connectionBD/connect.php');
    $INSTRUCAO = $LIGACAO->query('SELECT * from hardskills');
    $INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
    ?>


    <table class="table" style="padding: 60px">
        <caption>
            <button type="button" onclick="newmodal()" class="btn btn-secondary"><i class="fa">&#xf067;</i>Add</button>
        </caption>
        <thead class="table-dark">
        <tr>
            <td style="text-align: center">Description</td>
            <td style="width: 40px"></td>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row = $INSTRUCAO->fetch()) {
            ?>
            <tr ondblclick="editar(<?php echo $row['id']?>)">
                <td><?php echo $row['descricao'];?></td>
                <td class="actions">
                    <a href="delete.php?id=<?=$row['id']?>" class="trash"><i class="fa">&#xf014;</i></a>
                </td>
            </tr>

            <div class="modal" id="eliminar">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Hard Skills</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <?php
        }
        ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</section>




<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Hard Skills</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="needs-validation" method="post" id="editform" novalidate>
                    <input type="hidden" name="id" id="idskill">
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label for="descricao">Description</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Update Description" required>
                            <div class="invalid-feedback">
                                Please update description with valid text
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Hard Skill</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="adicionarModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insert Hard Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                require_once('../../connectionBD/connect.php');
                $pdo = pdo_connect_mysql();
                $msg = '';


                if (!empty($_POST)) {


                    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';

                    $stmt = $pdo->prepare('INSERT INTO hardskills (idaboutme, descricao) VALUES (?, ?)');
                    $stmt->execute([1, $descricao]);

                    $msg = 'Created Successfully!';
                }
                ?>
                <form class="needs-validation" method="post" action="hardskills.php" novalidate>
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label for="descricao">Description</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Insert Description" required>
                            <div class="invalid-feedback">
                                Please insert description with valid text
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Insert Hard Skill</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>