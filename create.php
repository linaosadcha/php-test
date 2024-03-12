<?php
session_start();
ob_start();
?>

<?php if(array_key_exists("form_error", $_SESSION)){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION["form_error"] ?>
        <?php unset($_SESSION["form_error"]) ?>
    </div>
<?php } ?>

<div class="card">
    <div class="card-header">
        Новий користувач
    </div>
    <form action="/store.php" method="post">
        <div class="card-body">
            <div class="input-group mb-3">
                <span class="input-group-text">Ім'я</span>
                <input type="text" name="full_name" class="form-control" placeholder="Іван Петров" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Email</span>
                <input type="text" name="email" class="form-control" placeholder="example@example.com" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Password</span>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>
        <div class="card-footer">
            <input class="btn btn-success" type="submit" value="Створити">
        </div>
    </form>
</div>

<?php

$title = "Створюємо нового користувача!";
$content = ob_get_contents();

ob_end_clean();

require ('layout.php');

