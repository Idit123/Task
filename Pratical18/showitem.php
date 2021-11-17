<?php
include 'db_connection.php';

$query = "SELECT item_id FROM states WHERE id = '" . $_POST['stateid'] . "'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result)) {
    if ($row['item_id'] != '') {
        $query = "SELECT * FROM item WHERE item_id NOT IN (" . $row['item_id'] . ") ORDER BY item_order ASC";
        $result = mysqli_query($conn, $query);
    } else {
        $query = "SELECT * FROM item ORDER BY item_order ASC";
        $result = mysqli_query($conn, $query);
    }

    while ($row = mysqli_fetch_array($result)) {
        echo '<li  id="' . $row["item_id"] . '" value="' . $row["item_title"] . '"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . $row["item_title"] . '</li>';
    }
}
?>