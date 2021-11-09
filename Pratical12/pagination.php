<?php
include "db_connection.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$num_per_page = isset($_REQUEST['showrow']) ? $_REQUEST['showrow'] : 5;
$start_from = ($page - 1) * $num_per_page;
$query = "SELECT * FROM users";

if (isset($_GET['searchbox'])) {
	if ($_GET['searchbox']) {

		$search = $_GET['searchbox'];
		$query .= " WHERE username LIKE '%$search%'";
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

$filterquery = $query . " limit $start_from,$num_per_page";
//print_r($filterquery);
$result = mysqli_query($conn, $filterquery);

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
				<th>Password</th>
				<th><a href='?order=userrights&&sort=$sort'>Rights<i class='fas fa-sort'></a></th>
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
						<input type='checkbox' id='checkbox1' name='options[]' onchange='check(this)' value='" . $row['id'] . "'>
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


$pr_result = mysqli_query($conn, $query);
$totralresult = mysqli_num_rows($pr_result);
$totalpage = ceil($totralresult / $num_per_page);
//echo $totalpage;

// preview button 
if ($page > 1) { ?>
	<a href="?page=<?php echo $page - 1; ?>&showrow=<?php echo $num_per_page ?>" class="btn btn-dark"><?php echo "Preview"; ?> </a>
<?php
}

for ($i = 1; $i <= $totalpage; $i++) { ?>
	<a href="?page=<?php echo $i; ?>&showrow=<?php echo $num_per_page ?>" class="btn btn-dark"><?php echo $i; ?> </a>
<?php
}
// next button 
if ($i - 1 > $page) { ?>
	<a href="?page=<?php echo $page + 1; ?>&showrow=<?php echo $num_per_page ?>" class="btn btn-dark"><?php echo "Next"; ?> </a>
<?php
}
echo "</div>
			</div>";
?>