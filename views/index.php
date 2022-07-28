<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
            <p>
            <?php
                if(isset($_SESSION['uid'])) {
                    $name = classes\models\user\User::getName($_SESSION['uid']);
                    $date = classes\models\user\User::getCreatedAt($_SESSION['uid']);

                    echo "Welcome back " . $name['first_name'] . ", your account was created at: " . $date['created_at'];
                } else {
                    echo "Welcome to the todo list app, please either create an account or login to use the todo list.";
                }

            ?>
            </p>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>