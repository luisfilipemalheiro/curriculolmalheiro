<h2>Contactos</h2>


<?php
require_once('connectionBD/connect.php');
$CONTACTOS = $LIGACAO->query('SELECT id, telephone, email from contacts');
$CONTACTOS->setFetchMode(PDO::FETCH_ASSOC);

$SOFTSKILLS = $LIGACAO->query('SELECT id, descricao from softskills');
$SOFTSKILLS->setFetchMode(PDO::FETCH_ASSOC);

$HARDSKILLS = $LIGACAO->query('SELECT id, descricao from hardskills');
$HARDSKILLS->setFetchMode(PDO::FETCH_ASSOC);

?>

<?php
while($row = $CONTACTOS->fetch()) {
?>
<div class="icons">
    <i class="fa">&#xf0e0; <a href="mailto:ismalheiro1@gmail.com">  <?php echo $row['email'];?></a></i>
    <div>
        <i class="fa">&#xf095; <a href="tel:00351925998153"> <?php echo $row['telephone'];?></a></i>
    </div>
</div>
    <?php
}
?>



<h2>Soft Skills</h2>
<div>
    <?php
    while($row = $SOFTSKILLS->fetch()) {
    ?>
    <p><b><?php echo $row['descricao'];?></b></p>
        <?php
    }
    ?>
</div>


<h2>Hard Skills</h2>
<div>
    <?php
    while($row = $HARDSKILLS->fetch()) {
        ?>
        <p><b><?php echo $row['descricao'];?></b></p>
        <?php
    }
    ?>
</div>