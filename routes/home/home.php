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
<script> function reset(){
    console.log("entrei");
    window.location.reload();
    }</script>
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
        <div class="row">
        <div class="col-md-3 mb-3">
            <label for="base_salary">Base Salary</label>
            <input type="number" class="form-control" id="base_salary" placeholder="Enter Base Salary" required/>
        </div>
            <div class="col-md-3 mb-3">
                <label class="label" for="meal_allowance">Meal Allowance</label>
                <select class="form-select" name="meal_allowance" id="meal_allowance" required>
                    <option value="no_allowance">No meal allowance</option>
                    <option value="card">Meal Card</option>
                    <option value="money">Money</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="meal_allowance_amount">Meal Allowance Amount</label>
                <input required class="form-control" type="number" id="meal_allowance_amount" placeholder="Enter Meal Allowance Amount" value="0" disabled />
            </div>
            <div class="col-md-3">
                <label for="meal_days">How many days did you work?</label>
                <input required type="number" class="form-control" id="meal_days" placeholder="Enter Meal Days" value="0" disabled/>
            </div>
        </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Your gross salary is: <span id="gross_salary"></span></li>
                <li class="list-group-item">The taxes you pay are: <span id="taxes"></span></li>
                <li class="list-group-item">The ammout you receive as meal allowance: <span id="meal_allowance_value"></span></li>
                <li class="list-group-item">Meal allowance that is taxed: <span id="meal_allowance_taxed"></span></li>
                <li class="list-group-item">IRS tax: <span id="descontos_irs"></span></li>
                <li class="list-group-item">SS tax: <span id="descontos_ss"></span></li>
                <li class="list-group-item">Your net salary is: <span id="net_salary"></span></li>
            </ul>
            <div class="card-footer">
                <button id="calculate" class="btn btn-primary">Calculate</button>
                <button onclick="reset()" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </div>
</section>

<script src="index.js"></script>







