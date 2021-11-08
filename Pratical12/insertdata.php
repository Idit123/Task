<?php
include 'db_connection.php';
$success  = "";
if (isset($_POST['add'])) {
    $username  = $_POST['username'];
    $useremail = $_POST['useremail'];
    $password   = $_POST['userpassword'];
    $checkvalue = $_POST['option'];
    $option = implode(",", $checkvalue);

    
    $sql = "INSERT INTO users (username,useremail,userpassword,	userrights)
        VALUES ('$username','$useremail','$password','$option')";
    if (mysqli_query($conn, $sql)) {
        $success    =   "New record created successfully !";
        header("Location: http://localhost/Task/Pratical12/index.php");
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }
    $result = mysqli_close($conn);
}
?>