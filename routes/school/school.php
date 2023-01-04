<?php
require_once '../menu.php';
?>


<script src="update.js"></script>

<html>

<section style="padding: 40px">
    <div class="card" style="margin-bottom: 30px">
        <div class="card-header">
            <div class="title" style="font-family: Courier New, monospace; font-size: 20px">
                School
            </div>
        </div>
    </div>

    <?php
    require_once('../../connectionBD/connect.php');
    $INSTRUCAO = $LIGACAO->query('SELECT id, description, startyear, endyear from scholl');
    $INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
    ?>


    <table class="table" style="padding: 60px">
        <thead class="table-dark">
        <tr>
            <td>Description</td>
            <td>Start year</td>
            <td>End year</td>
            <td style="width: 40px"></td>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row = $INSTRUCAO->fetch()) {
            ?>
            <tr ondblclick="editar(<?php echo $row['id']?>)">
                <td><?php echo $row['description'];?></td>
                <td><?php echo $row['startyear'];?></td>
                <td><?php echo $row['endyear'];?></td>
                <td class="actions">
                    <a href="delete.php?id=<?=$row['id']?>" class="trash"><i class="fa">&#xf014;</i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</section>



<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Scholl</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="needs-validation" method="post" id="editform" novalidate>
                    <input type="hidden" name="id" id="idschool">
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Update Description" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label for="startyear">Start Year</label>
                            <input type="text" class="form-control" id="startyear" name="startyear" placeholder="Update Start year" required>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="endyear">End year</label>
                            <input type="text" class="form-control" id="endyear" name="endyear" placeholder="Update End Year" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update School</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <p class="card-text" id="send"></p>
            </div>
            </form>
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>