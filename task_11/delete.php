<?php

include 'connection.php';

// delete selected data from database

$id = $_GET['id'];

$q = " DELETE FROM `users` WHERE id = $id ";

mysqli_query($conn, $q);

header('location:index.php');

?>