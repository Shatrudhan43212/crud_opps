<?php

// Include database file
require_once('functions.php');

$userObj   = new Functions();

// Insert Record in user table
if (isset($_POST['submit'])) {
    $userObj->insertData($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>OOPS CURD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once('common/header.php'); ?>
    <style>
        .error {
            color: red !important;
        }
    </style>
</head>

<body>

    <div class="card text-center" style="padding:15px;">
        <h4>OOPS CURD</h4>
    </div><br>

    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4>Insert Data</h4>
                    </div>
                    <?php
                    if (isset($_GET['error']) == "true") {
                        echo "<div class='alert alert-danger alert-dismissible mt-1'>
                                <button type='button' class='close' data-dismiss='alert'>×</button> <h6 class='text-center'>All fields are required.</h6>
                            </div>";
                    }
                    ?>
                    <div class="card-body bg-light">
                        <form action="" method="POST" name="myForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email*</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="address">Mobile no*</label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter Mobile number" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                            <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="ADD">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('common/footer.php'); ?>

</body>

</html>