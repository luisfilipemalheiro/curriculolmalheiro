<?php
require_once '../menu.php';
?>


<html>
<script src="update.js"></script>


<div id="toast" aria-live="polite" aria-atomic="true" style="position: relative; display: block">
    <div class="toast bg-success" style="position: absolute; top: 0; right: 0;">
        <div class="toast-header">
            <strong class="me-auto">SUCCESS!</strong>
            <small class="text-muted">Just Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            You edit title with success
        </div>
    </div>
</div>



<section style="padding: 40px">
    <div class="card" style="margin-bottom: 30px; position: static">
        <div class="card-header">
            <div class="title" style="font-family: Courier New, monospace; font-size: 20px">
                Title
            </div>
        </div>
    </div>

    <?php
    require_once('../../connectionBD/connect.php');
    # podemos utilizar diretamente o método ->query() uma vez que, ainda, não estamos a utilizar varíaveis na instrução SQL
    $INSTRUCAO = $LIGACAO->query('SELECT id, firstname, lastname, description, imagepath from aboutme');

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
            <tr ondblclick="editar(<?php echo $row['id']?>)">
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
    <div class="content update">
        <form action="image.php" method="post" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-6">
            <label for="filename">Filename</label>
            <input type="file" class="form-control" name="filename" placeholder="c://" id="filename" required>
            </div>

            <div class="col-md-4">
            <label for="description">How long do you intend to keep the photo?</label>
            <input type="date" class="form-control" name="description" placeholder="hello!" id="description">
            </div>
                <div class="col-md-2">
                    <button type="submit" value="Create" style="margin-top:23px" class="btn btn-warning"><i class="fa">&#xf093;</i> upload</button>
                    <!--<input type="submit" value="Create">-->
                </div>
            </div>

        </form>
    </div>
</section>



<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Contacts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="needs-validation" method="post" id="editform" novalidate>
                    <input type="hidden" name="id" id="idtitle">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="imagepath">Photo Path</label>
                            <input type="text" class="form-control" id="imagepath" name="imagepath" placeholder="Photo Path" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label for="description">About Luís Malheiro</label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="About Luis Malheiro" required></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Contacts</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>