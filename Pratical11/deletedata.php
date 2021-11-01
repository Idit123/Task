<?php
include 'db_connection.php';
$success  = "";
if (isset($_POST['delete'])) {
    $userid = $_POST['deleteid'];
    
    $sql = "DELETE FROM users where users.id = '$userid'";
    if (mysqli_query($conn, $sql)) {
        $success  =   "Delete record successfully !";
        header("Location: http://localhost/idit/Pratical11/index.php");
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>