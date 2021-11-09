<?php
include 'db_connection.php';
$success  = "";
if (isset($_POST['delete'])) {
    $userid = $_POST['deleteid'];
       
    $sql = "DELETE FROM users where users.id = '$userid'";
    if (mysqli_query($conn, $sql)) {
        $success  =   "Delete record successfully !";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }
    header("Location: http://localhost/Task/Pratical12/index.php");
    mysqli_close($conn);
}
if (isset($_POST['maindelete'])) {
    $test = $_POST['maindelete'];
    $array = explode(" ", $test);
    
    if ($_POST['maindelete'] != "") {
        $sql = "DELETE FROM `users` where `id` IN (" . implode(",", $array) . ")";
        if (mysqli_query($conn, $sql)) {
            $success  =   "Delete record successfully !";
        } else {
            echo "Error: " . $sql . " " . mysqli_error($conn);
        }
    }
    header("Location: http://localhost/Task/Pratical12/index.php");
    mysqli_close($conn);
}
?>