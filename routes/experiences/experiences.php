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
                Expirences
            </div>
        </div>
    </div>

    <?php
    require_once('../../connectionBD/connect.php');
    # podemos utilizar diretamente o método ->query() uma vez que, ainda, não estamos a utilizar varíaveis na instrução SQL
    $INSTRUCAO = $LIGACAO->query('SELECT id, idaboutme, title, descripton from experience');

    # definir o fetch mode
    $INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
    ?>

    <table class="table" style="padding: 60px">
        <caption>
            <button type="button" onclick="openmodal()" class="btn btn-secondary"><i class="fa">&#xf067;</i>Add</button>
        </caption>
        <thead class="table-dark">
        <tr>
            <td></td>
            <td>Title</td>
            <td>Description</td>
            <td style="width: 40px"></td>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row = $INSTRUCAO->fetch()) {
            ?>
            <tr ondblclick="openmodal()">
                <td>
                    <details>
                        <?php
                        require_once('../../connectionBD/connect.php');
                        $pdo = pdo_connect_mysql();
                        $stmt = $pdo->prepare('SELECT * FROM tasks WHERE idexpirence = ?');
                        $stmt->execute([$row['id']]);
                        $languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <summary></summary>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Description</th>
                                <td style="width: 40px"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($languages as $language):
                                ?>
                            <tr>
                                <th scope="row"><?php echo $language['id'];?></th>
                                <td><?php echo $language['nametask'];?></td>
                                <td><button type="button" class="btn btn-danger"><i class="fa">&#xf014;</i></button></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                    </details>
                </td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['descripton'];?></td>
                <td><button type="button" class="btn btn-danger"><i class="fa">&#xf014;</i></button></td>
            </tr>
        </tbody>
        <?php
        }
        ?>
    </table>
</section>

<?php
require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $descripton = isset($_POST['descripton']) ? $_POST['descripton'] : '';

    $stmt = $pdo->prepare('INSERT INTO experience (idaboutme, title, descripton) VALUES (?, ?, ?)');
    $stmt->execute([1, $title, $descripton]);
    $error = 'ERROR!! Please insert data';


    $dados = array();
    $INSTRUCAO = $LIGACAO->prepare("SELECT id, title, descripton FROM experience WHERE title = '$title'");
    $INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
    $INSTRUCAO->execute($dados);
}
?>

<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insert new Expirence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" action="experiences.php" novalidate id="myForm">
                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Insert Title" required>
                            <div class="invalid-feedback">
                                Please update description with valid text
                            </div>
                        </div>

                        <div class="col-md-6 mb-6">
                            <label for="descripton">Descripton</label>
                            <input type="text" class="form-control" id="descripton" name="descripton" placeholder="Insert Description" required>
                            <div class="invalid-feedback">
                                Please update description with valid text
                            </div>
                        </div>


                        <div class="col-md-12 mb-12" style="margin-top: 10px">
                            <button type="button" onclick="addRow()" name="newtask" class="btn btn-warning"><i class="fa">&#xf067;</i>New Task</button>
                        </div>


                        <div class="col-md-12 mb-12" id="myTable">
                            <label for="nametask">Tasks</label>
                            <input type="text" class="form-control" id="nametask" name="nametask" placeholder="Insert Task" required>
                            <div class="invalid-feedback">
                                Please update description with valid text
                            </div>
                        </div>
                        <div class="col-md-12 mb-12" id="myTable">
                            <label for="nametask">Tasks</label>
                            <input type="text" class="form-control" id="nametask" name="nametask" placeholder="Insert Task" required>
                            <div class="invalid-feedback">
                                Please update description with valid text
                            </div>
                        </div>

                            <?php
                            while ($row = $INSTRUCAO->fetch()) {
                                $nametask = isset($_POST['nametask']) ? $_POST['nametask'] : '';
                                $stmt = $pdo->prepare('INSERT INTO tasks (nametask, idexpirence) VALUES (?, ?)');
                                $stmt->execute([$nametask, $row['id']]);
                                $error = 'ERROR!! Please insert data';
                            }
                        ?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Insert Expirence</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="expirences.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>
