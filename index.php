<?php

// Include database file
require_once('functions.php');
$userObj = new Functions();
// Delete record from table
if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $userObj->deleteRecord($deleteId);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>OPPS CRUD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once('common/header.php'); ?>
    
</head>

<body>

    <div class="card text-center" style="padding:15px;">
        <h4>OPPS CRUD</h4>
    </div><br><br>

    <div class="container">
        <?php
        if (isset($_GET['msg1']) == "insert") {
            echo "<div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert'>×</button> <h6 class='text-center'>Record added successfully</h6>
                </div>";
        }
        if (isset($_GET['msg2']) == "update") {
            echo "<div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert'>×</button> Record updated successfully
                </div>";
        }
        
        ?>
        <h2>View Records
            <a href="add.php" style="float:right;"><button class="btn btn-success"><i class="fa fa-plus"></i></button></a>
        </h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile no.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = $userObj->displayData();
                $i = 1;
                if($users != ''){
                foreach ($users as $user) {
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><img src="uploads/<?php echo $user['images'] ?>" width="50"></td>
                        <td><?php echo $user['name'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['phone'] ?></td>
                        <td class="remove">
                            <button class="btn btn-primary mr-2"><a href="edit.php?editId=<?php echo $user['id'] ?>">
                                    <i class="fa fa-pencil text-white" aria-hidden="true"></i></a></button>
                            <button class="btn btn-danger" type="button" onclick="return archiveFunction(<?php echo $user['id'] ?>)">
                                    <i class="fa fa-trash text-white" aria-hidden="true"></i>
                                </button>
                        </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
    <?php require_once('common/footer.php'); ?>
    
</body>

</html>