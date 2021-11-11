<?php
include "db_connection.php";
$query = "SELECT * FROM users ORDER BY ID DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pratical 15</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0-5/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0-5/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="task15.css">
</head>

<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-one">
                        <h2><b>User Details</b></h2>
                    </div>
                    <div class="col-two">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><span>Add User</span></a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">

                <table id="employee_data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Rights</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "  
                        <tr id='" . $row['id'] . "' data-Username='" . $row["username"] . "' data-Email='" . $row['useremail'] . "' data-Password='" . $row['userpassword'] . "' data-Rights='" . $row['userrights'] . "'>  
                        <td>" . $row['username'] . "</td>  
                        <td>" . $row['useremail'] . "</td>  
                        <td>" . $row['userpassword'] . "</td>  
                        <td>" . $row['userrights'] . "</td>
                        <td>
                            <div class='edit'>
                                <a href='#editEmployeeModal' class='edit' data-toggle='modal' onclick='edit(" . $row['id'] . ")'><i class='fas fa-edit' data-toggle='tooltip' title='Edit'></i></a>
                            </div>
                        </td>
                        <td>
                            <div class='delete'>
                                <a href='#deleteEmployeeModal' class='delete' data-toggle='modal' onclick='dele(" . $row['id'] . ")'><i class='far fa-trash-alt' data-toggle='tooltip' title='Delete'></i></a>
                            </div>
                        </td>    
                    </tr>  
                    ";
                    }
                    ?>
                </table>
            </div>
            <!-- Add Modal HTML -->
            <div id="addEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="insertdata.php">
                            <div class="modal-header">
                                <h4 class="modal-title">Add User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><b>Name</b></label><input type="text" class="form-control" name="username" placeholder="Enter name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label><input type="email" class="form-control" name="useremail" placeholder="Enter email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label><input type="text" class="form-control" name="userpassword" placeholder="Enter password" required>
                                </div>
                                <div class="form-group">
                                    <label>Rights</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check1" name="option[]" value="Dashboard List">
                                        <label class="form-check-label" for="check1">Dashboard List</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check2" name="option[]" value="Provider List">
                                        <label class="form-check-label" for="check2">Provider List</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check3" name="option[]" value="Customer List">
                                        <label class="form-check-label" for="check3">Customer List</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check4" name="option[]" value="Job List">
                                        <label class="form-check-label" for="check4">Job List</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-success" name="add" value="Add">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- Edit Modal HTML -->
            <div id="editEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="updatedata.php" method="POST">
                            <input type="hidden" id="uid" name="userid" value="">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit UserDetails</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="editusername" name="editusername" placeholder="Enter name" value="" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="edituseremail" name="edituseremail" placeholder="Enter email" value="" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" id="edituserpassword" name="edituserpassword" placeholder="Enter Password" value="" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="editcheck1" name="editoption[]" value="Dashboard List">
                                        <label class="form-check-label" for="check1">Dashboard List</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="editcheck2" name="editoption[]" value="Provider List">
                                        <label class="form-check-label" for="check2">Provider List</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="editcheck3" name="editoption[]" value="Customer List">
                                        <label class="form-check-label" for="check3">Customer List</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="editcheck4" name="editoption[]" value="Job List">
                                        <label class="form-check-label" for="check4">Job List</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-success" name="update" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Delete Modal HTML -->
            <div id="deleteEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="deletedata.php" method="POST">
                            <input type="hidden" id="delid" name="deleteid" value="">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete these User Details?</p>
                                <p class="text-danger">This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-danger" name="delete" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   <script src="main.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#employee_data').DataTable();
        });
    </script>
</body>

</html>