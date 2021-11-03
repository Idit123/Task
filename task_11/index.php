<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        .search {

            display: flex;
            justify-content: flex-end;
            margin-right: 30px;

        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Document</title>

</head>

<body>

    <div class="container">
        <br>
        <div class="d-flex justify-content-end">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add Sub Admin
            </button>
        </div>
    </div>
    <div id="records_contant">
        <h2> All Admin Data</h2>
    </div>



    <!-- page length drop-down  -->

    <div class="dropdown">

        <form method="GET" action="">
            <div style="margin-left:25px">
                <button style="font-size: 12px;"> show</button>
                <select name="showrow" id="showrow" onchange="this.form.submit();">
                    <option disabled="disabled" selected="selected">Limit pre page</option>
                    <?php foreach ([5, 10, 15, 20] as  $num_per_page) : ?>
                        <option <?php if (isset($_REQUEST["showrow"]) && $_REQUEST["showrow"] ==  $num_per_page) echo "selected" ?> value="<?= $num_per_page; ?>"><?= $num_per_page; ?></option> entity
                    <?php endforeach; ?>

                </select>

            </div>
        </form>
    </div>

    <!-- search box -->

    <div class="search">
        <form action="" method="GET">
            <input id="myInput" type="search" placeholder="Search" name="searchbox" aria-label="Search" onchange="this.form.submit();">


        </form>
    </div>


    <br>

    <!--  add admin form -->


    <!-- The Modal -->

    <form action="savedata.php" class="was-validated" method="post">
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Sub Admin</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <lable>Name</lable>
                            <input type="text" name="name" placeholder="enter name" id="name" class="form-control">
                        </div>

                        <lable>Email</lable>
                        <input type="email" name="email" placeholder="enter email" id="email" class="form-control" required onkeyup='ValidateEmail();'>
                        <span id='emailvalidate'></span><br>

                        <lable>Password</lable>
                        <input type="password" name="password" placeholder="enter password" id="password" class="form-control" required onkeyup='checkpassword();'>

                        <br>
                        <lable>Confirm_Password</lable>
                        <input type="password" name="confirmpassword" placeholder="confirm password" id="confirmpassword" class="form-control" required onkeyup='check();'>
                        <span id='message'></span><br>


                        <table class="table">
                            <thead>Rights</thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="rights[]" class="right" value="dashbord list">dashbord list<br>
                                        <input type="checkbox" name="rights[]" class="right" value="provider list">provider list<br>
                                        <input type="checkbox" name="rights[]" class="right" value="coustmer list">coustmer list<br>
                                        <input type="checkbox" name="rights[]" class="right" value="job list">job list
                                        <br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="savedata">submit</button>
                        <button type="button" class="btn" data-dismiss="modal">Cancal</button>
                    </div>

                </div>
            </div>
        </div>

    </form>

    <!-- php code to show data stored data from database  -->

    <?php

    include "connection.php";




    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $num_per_page = isset($_REQUEST['showrow']) ? $_REQUEST['showrow'] : 5;
    $start_from = ($page - 1) * $num_per_page;
    $query = "SELECT * FROM users";


    if (isset($_GET['searchbox'])) {
        if ($_GET['searchbox']) {

            $search = $_GET['searchbox'];
            $query .= "and username like '%$search%'";
        } else {

            echo "<p>No Recored found </p>";
        }
    }



    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    } else {
        $order = 'username';
    }


    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    } else {
        $sort = 'ASC';
    }


    $query .= "  ORDER BY $order $sort";

    $query .= " limit $start_from,$num_per_page";

    $result = mysqli_query($conn, $query);



    if (mysqli_num_rows($result) > 0) {

        $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC ';

        echo " <br><table  id='mytable' class='table table-striped display' border=1px>
<tr>
<th><a href='?order=username&&sort=$sort'> Name<i class='fas fa-sort'></a></th>

<th><a href='?order=useremail&&sort=$sort'> Email<i class='fas fa-sort'></a></th>
<th>Right</th>
<th class='text-center' colspan='2'>Action</th>
</tr>";
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['useremail'] . "</td>";
            echo "<td>" . $row['userrights'] . "</td>";
            echo '<td><button class="btn-primary btn"> <a href="delete.php?id=' . $row['id'] . '" class="text-white"><i class="fa fa-trash"></i></a> </button>
<button type="button" class="btn-primary btn" id="myBtn"> <a href="edit.php?id=' . $row['id'] . '" class="text-white"> <i class="fa fa-edit"></i> </a> </button></td>';
            echo "</tr>";
        }
        echo "</table>";
    }



    $query_pr = "select * from users";
    $pr_result = mysqli_query($conn, $query_pr);
    $totralresult = mysqli_num_rows($pr_result);
    $totalpage = ceil($totralresult / $num_per_page);
    //echo $totalpage;

    // preview button 
    if ($page > 1) { ?>

        <a href="index.php?page=<?php echo $page - 1; ?>&showrow=<?php echo $num_per_page ?>" style="text-decoration:none" class="btn btn-secondary"><?php echo "preview"; ?> </a>

    <?php
    }

    for ($i = 1; $i <= $totalpage; $i++) { ?>

        <a href="index.php?page=<?php echo $i; ?>&showrow=<?php echo $num_per_page ?>" style="text-decoration:none" class="btn btn-secondary"><?php echo $i; ?> </a>

    <?php
    }
    // next button 
    if ($i - 1 > $page) { ?>

        <a href="index.php?page=<?php echo $page + 1; ?>&showrow=<?php echo $num_per_page ?>" style="text-decoration:none" class="btn btn-secondary"><?php echo "next"; ?> </a>


    <?php
    }

    ?>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
        var checkpassword = function() {

            if (document.getElementById('password').value ==
                document.getElementById('confirmpassword').value)

            {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'Password match';

            } else {

                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Password not matching';

            }
        }

        var ValidateEmail = function() {

            var validRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var inp = document.getElementById("email").value;

            if (inp.match(validRegex)) {

                document.getElementById('emailvalidate').style.color = 'green';
                document.getElementById('emailvalidate').innerHTML = 'Email is  valid';
                return true;

            } else {

                document.getElementById('emailvalidate').style.color = 'red';
                document.getElementById('emailvalidate').innerHTML = 'Email is not valid';
                return false;

            }
        }
    </script>


</body>

</html>