<?php

require_once('../../connectionBD/connect.php');
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM softskills WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $education = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$education) {
        exit('Education doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM softskills WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the education!';
            header('Location: softskills.php');
        } else {
            header('Location: softskills.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<div class="content delete">
    <h2>Delete education #<?=$education['id']?></h2>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php else: ?>
        <p>Are you sure you want to delete education #<?=$education['id']?>?</p>
        <div class="yesno">
            <a href="delete.php?id=<?=$education['id']?>&confirm=yes">Yes</a>
            <a href="delete.php?id=<?=$education['id']?>&confirm=no">No</a>
        </div>
    <?php endif;?>

</div>


