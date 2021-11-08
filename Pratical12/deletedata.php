<?php
include 'db_connection.php';
$success  = "";
if (isset($_POST['delete'])) {
    $userid = $_POST['deleteid'];
    
    $mainid = $_POST['deleted_id'];
    $array = explode(" ", $mainid);

    
    $sql = "DELETE FROM users where users.id = '$userid'";
    if (mysqli_query($conn, $sql)) {
        $success  =   "Delete record successfully !";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }
    
    if (isset($_POST['maindelete'])) {
        if($mainid != ''){
            $dele = "DELETE FROM users where users.id IN (" . implode(",", $array) . ")";
            $done = mysqli_query($conn, $dele);
        }
    }
    header("Location: http://localhost/Task/Pratical12/index.php");
    mysqli_close($conn);
}
?>