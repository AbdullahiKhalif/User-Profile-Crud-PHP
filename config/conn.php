<?php
$conn = new mysqli("localhost","root","", "img_upload");
if($conn->connect_error){
    echo $conn->error;
}
?>