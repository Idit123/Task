<?php
include 'db_connection.php';
$success  = "";
if (isset($_POST['update'])) {
    $userid = $_POST['userid'];
    $username  = $_POST['editusername'];
    $useremail = $_POST['edituseremail'];
    $password   = $_POST['edituserpassword'];
    $checkvalue = $_POST['editoption'];
    $updatecheck = implode(",", $checkvalue);

    
    $sql = "UPDATE users SET username = '$username', useremail = '$useremail', userpassword = '$password', userrights = '$updatecheck'  WHERE users.id = '$userid'";
    if (mysqli_query($conn, $sql)) {
        $success    =   "New record updated successfully !";
        header("Location: http://localhost/Task/Pratical11/index.php");
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>