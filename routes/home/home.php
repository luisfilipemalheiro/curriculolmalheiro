<?php
require_once '../menu.php';
?>

<section style="padding: 80px">
    <div class="row">
        <div class="col-1">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <div>
                <img src="../../images/smile.png" alt="Girl in a jacket" width="60" height="60">
                <h1 class="card-title" style="margin-top: -60px; margin-left: 185px">5</h1>
            </div>
            <p style="margin-top: 20px" class="card-text">Number visitores in your website</p>
        </div>
    </div>
        </div>
    </div>
</section>



<section style="padding: 40px">
    <div class="card" style="margin-bottom: 30px">
        <div class="card-header">
            <div class="title" style="font-family: Courier New, monospace; font-size: 20px">
                Messages
            </div>
        </div>
    </div>

    <?php
    require_once('../../connectionBD/connect.php');
    $INSTRUCAO = $LIGACAO->query('SELECT id, name, email, message from messages');
    $INSTRUCAO->setFetchMode(PDO::FETCH_ASSOC);
    ?>

    <table class="table" style="padding: 60px">
        <thead class="table-dark">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Email</td>
            <td style="width: 40px"></td>
        </tr>
        </thead>
        <tbody>
    <?php
    while($row = $INSTRUCAO->fetch()) {
        ?>
        <tr>
            <td>
                <details>
                    <summary><?php echo $row['id'];?></summary>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th><?php echo $row['message'];?></th>
                            </tr>
                        </tbody>
                    </table>

                </details>
            </td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><button type="button" class="btn btn-danger"><i class="fa">&#xf014;</i></button></td>
        </tr>
        </tbody>
        <?php
    }
    ?>
    </table>
</section>


<table>
    <tr>
        <td contenteditable>Column 1</td>
        <td contenteditable>Column 2</td>
        <td contenteditable>Column 3</td>
    </tr>
</table>





<script src="index.js"></script>

