<?php
require_once '../menu.php';
?>


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
            <tr ondblclick="openmodal(<?php echo $row['id'];?>)">
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</html>