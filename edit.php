<?php

// Include database file
require_once('functions.php');

$userObj = new Functions();

// Edit user record
if (isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $user = $userObj->displyaRecordById($editId);
}

// Update Record in user table
if (isset($_POST['update'])) {
    $userObj->updateRecord($_POST);
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <title>OOPS CRUD
    </title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php require_once('common/header.php'); ?>
    <style>.error{ color:red !important;}</style>

</head>

<body>


    <div class="card text-center" style="padding:15px;">

        <h4>OOPS CRUD
        </h4>

    </div>
    <br>


    <div class="container">

        <div class="row">

            <div class="col-md-5 mx-auto">

                <div class="card">

                    <div class="card-header bg-primary">

                        <h4 class="text-white">Update Records
                        </h4>

                    </div>

                    <div class="card-body bg-light">

                        <form action="edit.php" method="POST" enctype="multipart/form-data">

                            <div class="form-group">

                                <label for="name">Name:
                                </label>

                                <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>">

                            </div>

                            <div class="form-group">

                                <label for="email">Email
                                </label>

                                <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>">

                            </div>

                            <div class="form-group">

                                <label for="address">Mobile number:
                                </label>

                                <input type="text" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57">

                            </div>
                            <div class="form-group">
                                <label for="email">Photo</label>
                                <input type="file" class="form-control" name="image" placeholder="Enter email">
                                <?php
                                if (isset($_SESSION['img_err'])) {
                                    echo "<div class='alert alert-danger alert-dismissible mt-1'>
                                    <button type='button' class='close' data-dismiss='alert'>×</button> <h6 class='text-center'>".$_SESSION['img_err']."</h6>
                                </div>";
                                }
                                unset($_SESSION['img_err']);
                                ?>
                            </div>
                            <div class="form-group">

                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                                <input type="submit" name="update" class="btn btn-primary" style="float:right;" value="Update">

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php require_once('common/footer.php'); ?>
    

</body>

</html>