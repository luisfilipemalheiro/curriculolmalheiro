<?php
require_once '../menu.php';
?>

<script>

    function openmodal() {
        $('#myModal').modal('show')
    }
    $(document).ready(function(){
        // Open modal on page load
        $("#myModal").modal('show');

        // Close modal on button click
        $(".btn").click(function(){
            $("#myModal").modal('hide');
        });
    });

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




<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>