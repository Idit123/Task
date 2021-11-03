<?php

include 'connection.php';

$id = $_GET['id'];
$sql = "SELECT `username`,`useremail` FROM `users` WHERE id = '$id'";
$res = mysqli_query($conn, $sql);
while ($row = $res->fetch_assoc()) {
    $name = $row['username'];
    $email = $row['useremail'];
}


$lastsqlRes = "SELECT id, username, userrights FROM users WHERE id = $id";
$result2 = mysqli_query($conn, $lastsqlRes);

while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    $var = explode(",", $row['userrights']);
}

// update in database
if (isset($_POST['done'])) {

    $id = $_GET['id'];
    $eml = $_POST['email'];
    $nam = $_POST['name'];
    $right = $_POST['rights'];
    $rr =implode(",",$right);    

    $sql = "UPDATE `users` SET `id`='$id ',`username`='$nam',`useremail`='$eml',`userrights`='$rr' WHERE `id`='$id'";

    $query = mysqli_query($conn, $sql);
    header('location:index.php');
}



?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Document</title>
</head>


<body>
    <form action="" method="POST">



        <!-- update Modal body -->
        <div class="modal-body">
            <div class="form-group">
                <lable>Update_Name</lable>
                <input type="text" name="name" value="<?php echo $name; ?>" id="upadate_name" class="form-control">
            </div>
            <div class="form-group">
                <lable>Update_Email</lable>
                <input type="email" name="email" value="<?php echo $email; ?>" id="upadate_email" class="form-control">
            </div>

            <table class="table">
                <thead>Rights</thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" <?php echo (in_array("dashbord list", $var) ? 'checked' : ''); ?> name="rights[]" value="dashbord list">dashbord list<br>
                            <input type="checkbox" <?php echo (in_array("provider list", $var) ? 'checked' : ''); ?> name="rights[]" value="provider list">provider list<br>
                            <input type="checkbox" <?php echo (in_array("coustmer list", $var) ? 'checked' : ''); ?> name="rights[]" value="coustmer list">coustmer list<br>
                            <input type="checkbox" <?php echo (in_array("job list", $var) ? 'checked' : ''); ?> name="rights[]" value="job list">job list <br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!--  update Modal footer -->
        <div class="modal-footer">
            <button class="btn btn-success" type="submit" name="done"> update </button><br>
            <button type="button" class="btn" data-dismiss="modal" onclick="back()">Cancal</button>

        </div>


    </form>

    <script>
        function back() {
            window.history.go(-1);
        }
    </script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>