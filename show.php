<?php
session_start();
$db = new PDO("sqlite:./db.qslite2");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt =  $db->prepare("select * from 'users' where 'id' = ?");
$stmt->execute([$_GET["user_id"]]);
$user = $stmt->fetch();

if($user == false){
    header("HTTP/1.1 404 Not Found");
    die;
}
ob_start();
?>

<?php if(array_key_exists("session_error", $_SESSION)){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION["session_error"] ?>
        <?php unset($_SESSION["session_error"]) ?>
    </div>
<?php } ?>

<div class="card">
    <div class="card-header">
        <?= $user["full_name"] ?>
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

<?php

$title = $user["full_name"];
$edit = $user['id'];
$delete = $user['id'];
$content = ob_get_contents();

ob_end_clean();

require ('layout.php');
