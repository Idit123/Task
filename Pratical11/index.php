<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pratical 11</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0-5/css/all.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="task11.css">
</head>

<body>
	<br>
	<br>
	<h3 class="text-center text-success" id="message"></h3>
	<div class="container">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<!-- <div class="title">
						<h2> <b>User Details</b></h2>
					</div>
					<div class="btnsearch">
						<input type="text" id="search" class='form-control' onload="setFocusToSearchBox()" placeholder="Search By Name">
					</div>
					<div class="btndelete">
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><span>Delete</span></a>
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><span>Add User</span></a>
					</div> -->
					<div class="col-one">
						<h2><b>User Details</b></h2>
					</div>
					<div class="col-two">
						<input type="text" id="search" class='form-control' onload="setFocusToSearchBox()" placeholder="Search By Name">
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><span>Delete</span></a>
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><span>Add User</span></a>
					</div>

				</div>
			</div>

			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Name</th>
						<th>Email</th>
						<th>Password</th>
						<th>Rights</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody id="data">
					<?php
					include 'searchdata.php';
					while ($row = mysqli_fetch_array($result)) {
					?>
						<tr id="<?php echo $row["id"]; ?>" data-Username="<?php echo $row["username"]; ?>" data-Email="<?php echo $row["useremail"]; ?>" data-Password="<?php echo $row["userpassword"]; ?>" data-Rights="<?php echo $row['userrights']; ?>">
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<td><?php echo $row["username"]; ?></td>
							<td><?php echo $row["useremail"]; ?></td>
							<td><?php echo $row["userpassword"]; ?></td>
							<td><?php echo $row["userrights"]; ?></td>
							<td>
								<a href="#editEmployeeModal" class="edit" data-toggle="modal" onclick="edit(<?php echo $row['id']; ?>)"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
							</td>
							<td>
								<a href="#deleteEmployeeModal" class="delete" data-toggle="modal" onclick="dele(<?php echo $row['id']; ?>)"><i class="far fa-trash-alt" data-toggle="tooltip" title="Delete"></i></a>
							</td>
						</tr>
					<?php
					}
					?>
					<?php
					// close connection database
					mysqli_close($conn);
					?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>5</b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item active"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div>
		</div>
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
							<label>Name</label><input type="text" class="form-control" name="username" placeholder="Enter name" required>
						</div>
						<div class="form-group">
							<label>Email</label><input type="email" class="form-control" name="useremail" placeholder="Enter email" required>
						</div>
						<div class="form-group">
							<label>Password</label><input type="text" class="form-control" name="userpassword" placeholder="Enter password" required>
						</div>
						<div class="form-group">
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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="main.js"></script>
</body>

</html>