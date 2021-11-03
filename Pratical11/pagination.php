<?php
include 'db_connection.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$selected = isset($_REQUEST['selectLimit']) ? $_REQUEST['selectLimit'] : 5;

$start = ($page - 1) * $selected;

$q = "select * from task11 where 1=1";

$search = $_GET['search'];

$q .= " AND id LIKE '%" . $search . "%' OR username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' OR mno LIKE '%" . $search . "%'";


if (isset($_GET['column'])) {
    $column = $_GET['column'];
} else {
    $column = "id";
}

if (isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = "ASC";
}
// echo $column;
// echo $order;

$q .= " ORDER BY $column $order";

$q .= " limit $start,$selected";
// echo $q;
$result = mysqli_query($con, $q);

$order == "DESC" ? $order = "ASC" : $order = "DESC";
?>
