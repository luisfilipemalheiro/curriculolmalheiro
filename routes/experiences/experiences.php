<?php
require_once '../menu.php';
?>

<script>
    function openmodal() {
        $('#myModal').modal('show')
    }
    function newmodal() {
        $('#adicionarModal').modal('show')
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
                                <td><?php echo $language['descripton'];?></td>
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

<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Soft Skills</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="post" novalidate>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="contact">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" value="<?php echo $phone;?>" required>
                            <div class="invalid-feedback">
                                Please insert Image Path
                            </div>
                        </div>
                        <div class="col-md-8 mb-8">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Image Path" value="<?php echo $mail;?>" required>
                            <div class="invalid-feedback">
                                Please insert Image Path
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Soft Skill</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>
