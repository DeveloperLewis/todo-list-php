<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
        <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Todos</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <?php if (is_array($todos)) { $i = 1;?>
        <?php foreach ($todos as $k => $v) {?>
        <tbody>
            <tr>
            <th scope="row"><?php echo $i++?></th>
            <td><?php print_r($v['message']); ?></td>
            <form action="/todo/delete" method="post">
            <input type="hidden" value="<?php print_r($v['message_id']); ?>" name="messageid">
            <td><button class="btn btn-danger" type="submit">X</button></td>
            </form>
            </tr>
        </tbody>
        <?php } }?>
        </table>

            <?php 
                if (isset($_SESSION['error'])) {
                    
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $_SESSION['error'];
                    echo '</div>';

                    unset($_SESSION['error']);
                }

                if (isset($_SESSION['errors'])) {
                    
                    foreach ($_SESSION['errors'] as $k => $v) {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo $v;
                        echo '</div>';
                    }
                    unset($_SESSION['errors']);
                }
            ?>
            <form action="/todo/add" method="POST">
                <div class="form-group">
                    <label for="todo">Add new todo message</label>
                    <input type="text" class="form-control" name="message" id="message">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            
        </div>
    </div>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>