<h2>Experiências</h2>

<?php
require_once('connectionBD/connect.php');
$SQL = $LIGACAO->query('SELECT id, title, descripton from experience');
$SQL->setFetchMode(PDO::FETCH_ASSOC);

while($row = $SQL->fetch()) {

 ?>

<h3><?php echo $row['title'];?></h3>
<p>
    <?php echo $row['descripton'];?>
</p>
<ul>
    <?php
    $pdo = pdo_connect_mysql();
    $array = array();
    ?>
    <!--
    <li>Comunicação entre colegas de equipa;</li>
    <li>Comunicação entre cliente;</li>
    <li>Redes de computadores;</li>
    <li>Hardware de multiplos dispositivos;</li>
    <li>Resolucação de avarias de hardware e software;</li>
    -->
    <?php
    }
    ?>
</ul>
    <!--
<div class="divparamargem">
    <h3>XpertGO | 2022 - Atualmente</h3>
    <p>
        Habilidades desenvolvidas:
    </p>
    <ul>
        <li>Angular;</li>
        <li>Cypress;</li>
        <li>NodeJS;</li>
        <li>TypeScript;</li>
        <li>Metodologias ageis;</li>
    </ul>
</div>
-->

<h2>Escolaridade</h2>
<?php
    $SQL = $LIGACAO->query('SELECT description, startyear, endyear from scholl');
    $SQL->setFetchMode(PDO::FETCH_ASSOC);

    while($row = $SQL->fetch()) {
?>
<p>
    <?php echo $row['description'];?> |  <?php echo $row['startyear'];?> -  <?php echo $row['endyear'];?>
</p>
<?php
    }
?>