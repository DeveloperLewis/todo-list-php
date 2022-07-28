<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <div class="row m-4">
        <div class="col-md-4">

        </div>

        <div class="col-md-4">
            <div class="card container-fluid">
                <table class="table">
                    <thead class="thead-dark m-4">
                        <tr>
                        <th scope="col" style="display: inline-block;">#</th>
                        <th scope="col" style="display: inline-block;">To-do</th>
                        </tr>
                    </thead>
                
                    <tbody style="overflow-y: auto; height:400px; display: block;">
                        <?php if (is_array($todos)) { $i = 1;?>
                        <?php foreach ($todos as $k => $v) {?>
                            <tr>
                            <th scope="row"><?php echo $i++?></th>

                            <?php
                                if ($v['status'] == "completed") {
                                    echo '<td style="width: 100%;" ><strike>' . $v['message'] . '</strike></td>';
                                }
                                else if ($v['status'] == "in progress") {
                                    echo '<td style="width: 100%;">' . $v['message'] . '</td>';
                                }
                            ?>
                        
                            <form action="/todo/status" method="post">
                                <input type="hidden" value="<?php print_r($v['message_id']); ?>" name="messageid">
                                <td><button class="btn btn-success" type="submit" style="float:right;">
                                <?php if ($v['status'] == "completed") { echo '<i class="fa-solid fa-x"></i>'; } else if ($v['status'] == "in progress") { echo '<i class="fa-solid fa-check"></i>'; } ?>
                                </button></td>
                            </form>

                            <form action="/todo/delete" method="post">
                                <input type="hidden" value="<?php print_r($v['message_id']); ?>" name="messageid">
                                <td><button class="btn btn-danger" type="submit" style="float:right;"><i class="fa-solid fa-eraser"></i></button></td>
                            </form>
                            </tr>
                        <?php } }?>
                    </tbody>
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

                    <div class="m-4">
                        <form action="/todo/add" method="POST">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="float: right">Add</button>
                            <div style="overflow: hidden; padding-right: .5em;">
                                <input type="text" class="form-control" name="message" id="message" style="width: 100%;">
                            </div>
                            </div>
                        </form>
                    </div>    
            </div>

            <div class="col-md-4">


            </div>
        </div>
    </div>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>