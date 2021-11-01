<?php 
    include 'connection.php'; 

    $name = $_POST['uname'];
    $email = $_POST['uemail'];
    $no = $_POST['umno'];

    if(isset($_POST['addData']))
    {
        mysqli_query($con,"INSERT INTO users(username,email,mno) VALUES('".$name."','".$email."','".$no."')");
    }

    if(isset($_POST['editData']))
    {
        $id = $_POST['editid'];
        $name = $_POST['upname'];
        $email = $_POST['upemail'];
        $no = $_POST['upmno'];
        mysqli_query($con,"UPDATE users SET username='".$name."',email='".$email."',mno='".$no."' WHERE id='".$id."'");
    }

    if(isset($_POST['delData']))
    {
        $id = $_POST['delid'];
        mysqli_query($con,"DELETE FROM users WHERE id='".$id."'");
    }

    header("location:task11.php");
?>
