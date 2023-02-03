<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'crud_oop');

class Functions
{
    private $con;
    public $error;
    // Database Connection
    public function __construct()
    {
        $this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($this->con->connect_error) {
            echo "<h3> Failed to connect to Database.</h3>";
        } else {
            return $this->con;
        }
    }

    // Insert user data into user table
    public function insertData($post)
    {
        $name       = $this->con->real_escape_string($_POST['name']);
        $email      = $this->con->real_escape_string($_POST['email']);
        $phone      = $this->con->real_escape_string($_POST['phone']);
        $password   = md5(rand(1000, 9999));
        $date       = date("Y-m-d h:i:s");


        if ($name == '' || $email == '' || $phone == '') {
            header('location: add.php?error=true');
            die;
        }

        $imagesName = '';
        if (!empty($_FILES['image']['name'])) {
            $folderName = "uploads";
            $imagesResults = $this->imageUploads($_FILES, $folderName);
            if ($imagesResults['status'] == false) {
                $_SESSION['img_err'] = $imagesResults['msg'];
                header("Location:add.php"); die;
            } else {
                $imagesName = $imagesResults['imageName'];
            }
        }

        $query = "INSERT INTO users(name, email, phone, password, images, created, updated) VALUES('" . $name . "', '" . $email . "', '" . $phone . "', '" . $password . "', '" . $imagesName . "', '" . $date . "', '" . $date . "' )";
        $sql        = $this->con->query($query);
        if ($sql == true) {
            header("Location:index.php?msg1=insert");
        } else {
            echo "Registration failed try again!";
        }
    }

    // Fetch user records for show listing
    public function displayData()
    {
        $query = "SELECT * FROM users ORDER BY id DESC";
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            echo "No found records";
        }
    }

    // Fetch single data for edit from user table
    public function displyaRecordById($id)
    {
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "Record not found";
        }
    }

    // Update user data into user table
    public function updateRecord($postData)
    {
        $name       = $this->con->real_escape_string($_POST['name']);
        $email      = $this->con->real_escape_string($_POST['email']);
        $phone      = $this->con->real_escape_string($_POST['phone']);
        $date       = date("Y-m-d h:i:s");
        $id = $this->con->real_escape_string($_POST['id']);
        if ($name == '' || $email == '' || $phone == '') {
            header('location: add.php?error=true');
            die;
        }

        $imagesName = '';
        $attr = '';
        if (!empty($_FILES['image']['name'])) {
            $folderName = "uploads";
            $imagesResults = $this->imageUploads($_FILES, $folderName);
            if ($imagesResults['status'] == false) {
                $_SESSION['img_err'] = $imagesResults['msg'];
                header("Location:add.php"); die;
            } else {
                $imagesName = $imagesResults['imageName'];
                $attr = "images = '".$imagesName."', ";
            }
        }

        if (!empty($id) && !empty($postData)) {

            $attr .= "name = '" . $name . "', email = '" . $email . "', phone = '" . $phone . "', updated = '" . $date . "'";
            $query = "UPDATE users SET $attr  WHERE id = '$id'";
            $sql = $this->con->query($query);
            if ($sql == true) {
                header("Location:index.php?msg2=update");
            } else {
                echo "Updated failed try again!";
            }
        }
    }

    // Delete user data from user table
    public function deleteRecord($id)
    {
        $query = "DELETE FROM users WHERE id = '$id'";
        $sql = $this->con->query($query);
        if ($sql == true) {
            header("Location:index.php?msg3=delete");
        } else {
            echo "Record does not delete try again";
        }
    }

    // Image uploads function
    public function imageUploads($imageData, $folderName)
    {
        $fileName = $imageData["image"]["name"];
        $fileSize = $imageData["image"]["size"];
        //$fileType = $imageData["image"]["type"];
        $fileTemp = $imageData["image"]["tmp_name"];
        $file_Ext = explode('.', strtolower($fileName));
        $file_Ext = end($file_Ext);
        $newFileName = date("Ymd") . time() . "." . $file_Ext;
        $extensions = array("jpeg", "jpg", "png");
        if (in_array($file_Ext, $extensions) === false) {
            return array("status" => false, "msg" => "Please choose a JPEG or PNG file.");
            die;
        } elseif ($fileSize > 2097152) {
            return array("status" => false, "msg" => "File size must be less or equal 2 MB");
            die;
        } else {
            move_uploaded_file($fileTemp, $folderName . "/" . $newFileName);
            return array("status" => true, "imageName" => $newFileName);
        }
    }
}
