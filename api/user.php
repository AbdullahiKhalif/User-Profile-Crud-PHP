<?php
//import/include conncection file
include '../config/conn.php';

//read All user Data
function readAllUsers($conn){
    $query = "SELECT * FROM users";
    $result = $conn->query($query);
    $data = array();
    $message = array();

    if($result) {
        while($row = $result->fetch_assoc()) {
            $data [] = $row;
        }
        $message = array("status" => true, "data" => $data);
    }else{
        $message = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($message);
}

// read specific user
function readSpecificUser($conn){
    extract($_POST);
    $query = "SELECT * FROM users WHERE id = '$id' ";;
    $result = $conn->query($query);
    
    $data = array();
    $message = array();

    if($result){
        while($row = $result->fetch_assoc()){
            $data [] = $row;
        }
        $message = array("status" => true, "data" => $data);
    }else{
        $message = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($message);
}

// regiser user
function registerUser($conn){
    extract($_POST);
    $data = array();
    $error_message = array();

    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $new_id = generateUserId($conn);
    $saved_name = $new_id. ".png";

    $allowedImage = ["image/png", "image/jpeg", "image/jpg"];

    if(in_array($file_type, $allowedImage)){

        $max_size = 5 * 1024 * 1024;
        if($file_size > $max_size){
            $error_message [] = $file_size/1024/1024 . " MB File Size exceeds allowed image size ". $max_size/1024/1024;
        }
    }else{
        $error_message [] = "This File Is Not Allowed ". $file_type;
    }
    
    if(count($error_message) <= 0){
        $query = "CALL registerUser('$new_id', '$username', '$type', '$email', '$password', '$phone', '$saved_name')";
        $result = $conn->query($query);

        if($result){
            $row = $result->fetch_assoc();
            if($row['Message'] == "Deny"){
                $data = array("status" => false, "data" => "Sorry!. This Username Is Already Taken! ❌");
            }else if($row['Message'] == "Registered"){
                move_uploaded_file($file_tmp, "../assets/uploads/".$saved_name);
                $data = array("status" => true, "data" => "Successfully Registered✔😃");
            }
        }else{
            $data = array("status" => false, "data" => $conn->error);
        }

    }else{
        $data = array("status" => false, "data" => $error_message);
    }


    echo json_encode($data);
}

//update user 
function updateUser($conn){
    extract($_POST);
    $data = array();
    $error_message  = array();

    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $allowedImage = ["image/png", "image/jpg", "image/jpeg"];
    $saved_name = $updatedId.".png";

    if(!empty($file_tmp)){
        if(in_array($file_type, $allowedImage)){
            $max_size = 5 * 1024 * 1024;

            if($file_size > $max_size){
                $error_message [] = $file_size/1024/1024 . " MB File Size exceeds allowed size ". $max_size/1024/1024;
            }
        }else{
            $error_message [] = "This file is not allowed ". $file_type;
        }

        if(count($error_message) <= 0){
            $query = "UPDATE users SET name = '$username', type = '$type', email = '$email', password = '$password', phone = '$phone', image ='$saved_name' WHERE id = '$updatedId'";
        $reult = $conn->query($query);

        if($reult){
            move_uploaded_file($file_tmp, "../assets/uploads/". $saved_name);
            $data = array("status" =>true, "data" => "Successfully updated ✔✔");
        }else{
            $data = array("status" =>false, "data" => $conn->error);
        }
        }else{
            $data = array("status" => false, "data" => $error_message);
        }

    }else{
        $query = "UPDATE users SET name = '$username', type = '$type', email = '$email', password = '$password', phone = '$phone' WHERE id = '$updatedId'";
        $reult = $conn->query($query);

        if($reult){
            $data = array("status" =>true, "data" => "Successfully updated ✔");
        }else{
            $data = array("status" =>false, "data" => $conn->error);
        }
    }


    echo json_encode($data);
}

//delete user 
function deleteUser($conn){
    extract($_POST);
    $query = "DELETE FROM users WHERE id = '$id'";
    $result = $conn->query($query);
    $data = array();

    if($result){
        unlink("../assets/uploads/".$id.".png");
        $data = array("status" => true, "data" => "Successfully Deleted ✔😃");
    }else{
        $data = array("status" => false, "data" => $conn-error);
    }
    echo json_encode($data);
}


//genarate user id
function generateUserId($conn){
    $new_id = '';
    $query = "SELECT * FROM USERS ORDER BY id DESC LIMIT 1";
    $result = $conn->query($query);
    $data = array();
    
    if($result){
        $num_rows = $result->num_rows;
        if($num_rows > 0){
            $row = $result->fetch_assoc();
            $new_id = ++$row['id'];
        }else{
            $new_id = "USR001";
        }

        return $new_id;
    }
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "Action Is Required❌"));
}
?>