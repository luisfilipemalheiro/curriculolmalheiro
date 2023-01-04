<?php
require_once '../menu.php';
?>

<script src="update.js"></script>
<script>
    function newmodal() {
        $('#adicionarModal').modal('show')
    }
</script>

<html>

<div id="toast" aria-live="polite" aria-atomic="true" style="position: relative; display: block">
    <div class="toast bg-success" style="position: absolute; top: 0; right: 0;">
        <div class="toast-header">
            <strong class="me-auto">SUCCESS!</strong>
            <small class="text-muted">Just Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            You edit soft skill with success
        </div>
    </div>
</div>

<section style="padding: 40px">
    <div class="card" style="margin-bottom: 30px; position: static">
        <div class="card-header">
            <div class="title" style="font-family: Courier New, monospace; font-size: 20px">
                Soft Skills
            </div>
        </div>
    </div>

    <?php
    require_once('../../connectionBD/connect.php');
    $INSTRUCAO = $LIGACAO->query('SELECT * from softskills');
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
            <?php
        }
        ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</section>


<div class="modal" id="adicionarModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insert Soft Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                require_once('../../connectionBD/connect.php');
                $pdo = pdo_connect_mysql();
                $msg = '';


                if (!empty($_POST)) {


                    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';

                    $stmt = $pdo->prepare('INSERT INTO softskills (idaboutme, descricao) VALUES (?, ?)');
                    $stmt->execute([1, $descricao]);
                    $msg = 'Created Successfully!';

                }
                ?>
                <form class="needs-validation" method="post" action="softskills.php" novalidate>
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
                <button type="submit" class="btn btn-primary">Insert Soft Skill</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Soft Skills</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="needs-validation" method="post" id="editform" novalidate>
                    <input type="hidden" name="id" id="idskill">
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label for="descricaosf">Description</label>
                            <input type="text" class="form-control" id="descricaosf" name="descricaosf" placeholder="Update Description" required>
                            <div class="invalid-feedback">
                                Please update description with valid text
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Soft Skill</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <p class="card-text" id="send"></p>
            </div>
            </form>
        </div>
    </div>
</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>