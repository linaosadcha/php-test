<?php
session_start();
$db = new PDO("sqlite:./db.qslite2");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt =  $db->prepare("select * from 'users'");
$stmt->execute();
$users = $stmt->fetchAll();

ob_start();
?>

<?php if(array_key_exists("session_error", $_SESSION)){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION["session_error"] ?>
        <?php unset($_SESSION["session_error"]) ?>
    </div>
<?php } ?>

<?php if(array_key_exists("session_success", $_SESSION)){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION["session_success"] ?>
        <?php unset($_SESSION["session_success"]) ?>
    </div>
<?php } ?>

<?php foreach($users as $user){ ?>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div><?= $user["full_name"] ?></div>
                <a href="/edit.php?user_id=<?= $user['id'] ?>" class="btn btn-warning">Редагувати</a>
            </div>
        </div>
        <div class="card-body">
        <div class="mb-4">
                <div class="small">
                    Ім'я
                </div>
                <div class="fw-bold">
                    <?= $user["full_name"] ?>
                </div>
            </div>
            <div>
                <div class="small">
                    Email
                </div>
                <div class="fw-bold">
                    <?= $user["email"] ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php

$title = $user["full_name"];
$content = ob_get_contents();

ob_end_clean();

require ('layout.php');
