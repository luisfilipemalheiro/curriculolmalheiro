<?php

function pdo(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'curriculoluis';

    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME. ';charset=utf8',
            $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception){
        exit('Failed to connect to database');
    }
}
$msg = '';
$pdo = pdo();

if (!empty($_POST)) {


    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    $stmt = $pdo->prepare('INSERT INTO messages (name, idaboutme, email, message) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, 1, $email, $message]);

    $to_email = "lmalheiro@ipvc.pt";
    $subject = "Test email to send from XAMPP";
    $body = "Hi, You have a new message in your page ";
    $headers = 'From: lmalheiro@ipvc.pt' . "\r\n" .
        'Reply-To: lmalheiro@ipvc.pt' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();


    if (mail($to_email, $subject, $body, $headers))

    {
        echo "Email successfully sent to $to_email...";
    }

    else{
        echo "Email sending failed!";
    }

    header("Location: ".$_SERVER['HTTP_REFERER']."");
}
?>

<script>
    function opentoast() {
        var toastLiveExample = document.getElementById('liveToast');
        toastLiveExample.show();
    }
</script>






<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast-header">
            <img src="..." class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>



