<?php
require_once '../menu.php';
?>


<?php
require_once('../../connectionBD/connect.php');
$SLQ = $LIGACAO->query('SELECT numberusers from aboutme');
$SLQ->setFetchMode(PDO::FETCH_ASSOC);
$row = $SLQ->fetch()
?>
<script src="calculator.js"></script>
<section style="padding: 80px">
    <div class="row">
        <div class="col-1">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <div>
                <img src="../../images/smile.png" alt="Girl in a jacket" width="60" height="60">
                <h1 class="card-title" style="margin-top: -60px; margin-left: 185px"><?php echo $row['numberusers'];?></h1>
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
            <td><a href="delete.php?id=<?=$row['id']?>" class="trash"><i class="fa">&#xf014;</i></a></td>
        </tr>
        </tbody>
        <?php
    }
    ?>
    </table>
</section>

<section style="padding: 40px">

    <div class="card">
        <div class="card-header">
            Finance Simulator
        </div>
        <div class="card-body">
            <h5 class="card-title">Earned money</h5>
            <form class="needs-validation" method="post" id="form" novalidate>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="base_salary">Basic Salary</label>
                        <input type="number" class="form-control" id="base_salary" name="base_salary" placeholder="Insert Basic Salary" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="meal_allowance" class="label" >Type of Medal</label>
                        <select class="form-select" id="meal_allowance" name="meal_allowance">
                            <option value="0" selected>Select option(not required)</option>
                            <option value="1">Card</option>
                            <option value="2">Money</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="meal_allowance_amount">Meal allowance</label>
                        <input type="number" class="form-control" id="meal_allowance_amount" name="meal_allowance_amount" placeholder="Insert Medal Allowance" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="meal_days">Number days</label>
                        <input type="number" class="form-control" id="meal_days" name="meal_days" placeholder="Insert Number Days" required>
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <button type="button" id="calculate" class="btn btn-primary">Calculate</button>
            <button type="button" onclick="reset()" class="btn btn-danger">Reset</button>
            <p>Your gross salary is: <span id="gross_salary"></span></p>
            <p>The taxes you pay are: <span id="taxes"></span></p>
            <p>The ammout you receive as meal allowance: <span id="meal_allowance_value"></span></p>
            <p>Meal allowance that is taxed: <span id="meal_allowance_taxed"></span></p>
            <p>IRS tax: <span id="descontos_irs"></span></p>
            <p>SS tax: <span id="descontos_ss"></span></p>
            <p>Your net salary is: <span id="net_salary"></span></p>
        </div>
        </form>
        </div>
    </div>


</section>


<!--
<table>
    <tr>
        <td contenteditable>Column 1</td>
        <td contenteditable>Column 2</td>
        <td contenteditable>Column 3</td>
    </tr>
</table>
-->

<script src="index.js"></script>







