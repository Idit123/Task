<?php

include "connection.php";

// save data in database1

if (isset($_POST['savedata'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $right = $_POST['rights'];
    $rr = implode(",",$right);
  
    print_r($rr);

    $sql = "INSERT INTO `users`(`username`, `useremail`, `userpassword`, `userrights`) VALUES ('$name','$email','$password','$rr')";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die("could not enter data");
    }
   }
   header('location:index.php');
?>