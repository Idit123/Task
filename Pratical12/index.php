<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pratical 11</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0-5/css/all.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
	<link rel="stylesheet" href="task11.css">
</head>

<body>
	<h3 class="text-center text-success" id="message"></h3>
	<div class="container">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-one">
						<h2><b>User Details</b></h2>
					</div>
					<!-- page length drop-down  -->
					<div class="col-two">
						<div class="dropdown">
							<form method="GET" action="">
								<label class="showrowlabel">Show Rows : </label>
								<select name="showrow" id="showrow" onchange="this.form.submit();">
									<?php foreach ([5, 10, 15, 20] as  $num_per_page) : ?>
										<option <?php if (isset($_REQUEST["showrow"]) && $_REQUEST["showrow"] ==  $num_per_page) echo "selected" ?> value="<?= $num_per_page; ?>"><?= $num_per_page; ?></option> entity
									<?php endforeach; ?>
								</select>
							</form>
						</div>
					</div>
					<div class="col-three">
						<!-- <input id="myInput" type="search" placeholder="Search" name="searchbox" aria-label="Search" onchange="this.form.submit();"> -->
						<input type="text" id="search" name="search" class='form-control' placeholder="Search By Name" onchange="this.form.submit();">
						<input type="hidden" name="deleted_id" id="deleted_id">
						<button  type="delete" id="maindelete" name="maindelete" class="btn btn-danger" data-toggle="modal" data-target="#deleteEmployeeModal">Delete</button>
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><span>Add User</span></a>
					</div>
				</div>
			</div>

			<?php
			include "db_connection.php";

			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$num_per_page = isset($_REQUEST['showrow']) ? $_REQUEST['showrow'] : 5;
			$start_from = ($page - 1) * $num_per_page;
			$query = "SELECT * FROM users";

			if (isset($_GET['search'])) {
				if ($_GET['search']) {

					$search = $_GET['search'];
					print_r($search);
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

				echo "
		<table class='table table-striped table-hover'>
			<thead>
				<tr>
				<th>
					<span class='custom-checkbox'>
						<input type='checkbox' id='selectAll' onclick='checkmain()'>
						<label for='selectAll'></label>
					</span>
				</th>
				<th><a href='?order=username&&sort=$sort'> Name<i class='fas fa-sort'></a></th>
				<th><a href='?order=useremail&&sort=$sort'> Email<i class='fas fa-sort'></a></th>
				<th><a href='?order=userpassword&&sort=$sort'> Password<i class='fas fa-sort'></a></th>
				<th>Rights</th>
				<th>Edit</th>
				<th>Delete</th>
				</tr>
			</thead>
			<tbody>";

				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					echo "
		
			<tr id='" . $row['id'] . "' data-Username='" . $row["username"] . "' data-Email='" . $row['useremail'] . "' data-Password='" . $row['userpassword'] . "' data-Rights='" . $row['userrights'] . "'>
				<td>
					<span class='custom-checkbox'>
						<input type='checkbox' id='checkbox1' value='' name='options[]' onclick='check(".$row['id'].")'>
						<label for='checkbox1'></label>
					</span>
				</td>
				<td>" . $row['username'] . "</td>											
				<td>" . $row['useremail'] . "</td>
				<td>" . $row['userpassword'] . "</td>
				<td>" . $row['userrights'] . "</td>
				<td>
					<a href='#editEmployeeModal' class='edit' data-toggle='modal' onclick='edit(" . $row['id'] . ")'><i class='fas fa-edit' data-toggle='tooltip' title='Edit'></i></a>
				</td>
				<td>
					<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' onclick='dele(" . $row['id'] . ")'><i class='far fa-trash-alt' data-toggle='tooltip' title='Delete'></i></a>
				</td>
			</tr>";
				}
				echo "</tbody></table>";
			}

			$query_pr = "select * from users";
			$pr_result = mysqli_query($conn, $query_pr);
			$totralresult = mysqli_num_rows($pr_result);
			$totalpage = ceil($totralresult / $num_per_page);
			//echo $totalpage;

			// preview button 
			if ($page > 1) { ?>
				<a href="index.php?page=<?php echo $page - 1; ?>&showrow=<?php echo $num_per_page ?>" class="btn btn-primary"><?php echo "preview"; ?> </a>
			<?php
			}

			for ($i = 1; $i <= $totalpage; $i++) { ?>
				<a href="index.php?page=<?php echo $i; ?>&showrow=<?php echo $num_per_page ?>" class="btn btn-primary"><?php echo $i; ?> </a>
			<?php
			}
			// next button 
			if ($i - 1 > $page) { ?>
				<a href="index.php?page=<?php echo $page + 1; ?>&showrow=<?php echo $num_per_page ?>" class="btn btn-primary"><?php echo "next"; ?> </a>
			<?php
			}
			echo "</div>
			</div>";
			?>
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

			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
			<script src="main.js"></script>
</body>

</html>