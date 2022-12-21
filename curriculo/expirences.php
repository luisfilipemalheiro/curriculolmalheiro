<h2>Experiências</h2>

<?php
require_once('connectionBD/connect.php');

$pdo = pdo_connect_mysql();

$SQL = $LIGACAO->query('SELECT id, title, descripton from experience');
$SQL->setFetchMode(PDO::FETCH_ASSOC);



while($row = $SQL->fetch()) {

$stmt = $pdo->prepare('SELECT * FROM tasks WHERE idexpirence = ?');
$stmt->execute([$row['id']]);
// Fetch the records so we can display them in our template.
$languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h3><?php echo $row['title'];?></h3>
<p>
    <?php echo $row['descripton'];?>
</p>

    <?php

    foreach ($languages as $language):
        ?>
<ul>
   <li><?php echo $language['nametask'];?></li>
</ul>
    <?php endforeach; ?>
    <?php

    }
    ?>


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