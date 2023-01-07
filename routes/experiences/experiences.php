<?php
require_once '../menu.php';
$repet = false;
if (isset($_POST['title'])) {
    if ($_SESSION['teste'] == $_POST['title']) {
        $repet = true;
    }
}
?>
<script src="updateexp.js"></script>
<script src="expirences.js"></script>

<div id="toast" aria-live="polite" aria-atomic="true" style="position: relative; display: block">
    <div class="toast bg-success" style="position: absolute; top: 0; right: 0;">
        <div class="toast-header">
            <strong class="me-auto">SUCCESS!</strong>
            <small class="text-muted">Just Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            You edit experiences with success
        </div>
    </div>
</div>

<script>
    let count = 0;
    function openmodal() {
        $('#myModal').modal('show')
    }

    function addtask() {
        $('#adicionartask').modal('show')
    }


    function addRow2() {
        const form = document.getElementById("myForm");
        const newRow = document.createElement("input");
        count++;
        console.log(count)

        //newRow.innerHTML = "Name:";

        newRow.style = "margin-top: 10px";
        newRow.type = "text";
        newRow.className = "form-control";
        newRow.id = "nametask" + count;
        console.log("nametask" + count);
        newRow.name = "nametask" + count;
        newRow.placeholder = "Insert Task";


        form.appendChild(newRow);

    }
</script>

<html>

<section style="padding: 40px">
    <div class="card" style="margin-bottom: 30px; position: static">
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


    $SQL = $LIGACAO->query('SELECT * from tasks');
    $SQL->setFetchMode(PDO::FETCH_ASSOC);

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
        <tr ondblclick="updateexp(<?php echo $row['id']?>)">
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
                                <th scope="row"><?php echo $language['id'] ;?></th>
                                <td><?php echo $language['nametask'];?></td>
                                <td><a href="deletetask.php?id=<?=$language['id']?>" class="trash"><i class="fa">&#xf014;</i></a></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                </details>
            </td>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['descripton'];?></td>
            <td><a href="deletexperience.php?id=<?=$row['id']?>" class="trash"><i class="fa">&#xf014;</i></a></td>
        </tr>
        </tbody>
        <?php
        $titleP = $row['title'];
        $descriptonP = $row['descripton'];
        }
        ?>
    </table>
</section>

<?php
require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
if (!$repet) {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $descripton = isset($_POST['descripton']) ? $_POST['descripton'] : '';

    $stmt = $pdo->prepare('INSERT INTO experience (idaboutme, title, descripton) VALUES (?, ?, ?)');
    $stmt->execute([1, $title, $descripton]);
    $error = 'ERROR!! Please insert data';


    $dados = array();
    $INSTRUCAO = $LIGACAO->prepare("SELECT id, title, descripton FROM experience WHERE title = '$title'");
    $INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
    $INSTRUCAO->execute($dados);
    $_SESSION['teste'] = $_POST['title'];
}
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
                            <button type="button" onclick="addRow2()" id="newtask" name="newtask" class="btn btn-warning"><i class="fa">&#xf067;</i>New Task</button>
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
                            $nametask1 = isset($_POST['nametask1']) ? $_POST['nametask1'] : '';
                            $nametask2= isset($_POST['nametask2']) ? $_POST['nametask2'] : '';
                            $nametask3 = isset($_POST['nametask3']) ? $_POST['nametask3'] : '';
                            $nametask4 = isset($_POST['nametask4']) ? $_POST['nametask4'] : '';
                            $nametask5 = isset($_POST['nametask5']) ? $_POST['nametask5'] : '';
                            $nametask6 = isset($_POST['nametask6']) ? $_POST['nametask6'] : '';
                            $stmt = $pdo->prepare('INSERT INTO tasks (nametask, idexpirence) VALUES (?, ?)');
                            $stmt->execute([$nametask, $row['id']]);
                            $stmt->execute([$nametask1, $row['id']]);
                            $stmt->execute([$nametask2, $row['id']]);
                            $stmt->execute([$nametask3, $row['id']]);
                            $stmt->execute([$nametask4, $row['id']]);
                            $stmt->execute([$nametask5, $row['id']]);
                            $stmt->execute([$nametask6, $row['id']]);
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


<div class="modal" id="updateexpirence">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


                <form class="needs-validation" method="post" id="editexp" novalidate>
                    <div class="modal-body">
                    <input type="hidden" name="id" id="idexp">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-6 mb-6">
                                <label for="titleexp">Title</label>
                                <input type="text" class="form-control" id="titleexp" name="titleexp" placeholder="Update Title" required>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="descriptonexp">Description</label>
                                <input type="text" class="form-control" id="descriptonexp" name="descriptonexp" placeholder="Update Description" required>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-primary">Update Description</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <p class="card-text" id="send"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <script src="expirences.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>