<?php
include 'db_connection.php';

$query = "SELECT item_id FROM states WHERE id = '" . $_POST['state_id'] . "'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result)) {
    $query = "SELECT * FROM item WHERE item_id IN (" . $row['item_id'] . ") ORDER BY item_order ASC";
  
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo '<li  id="' . $row["item_id"] . '" value="' . $row["item_title"] . '"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . $row["item_title"] . '</li>';
    }
}

if ($_POST['item_id_array'] != "") {
    for ($i = 0; $i < count($_POST["item_id_array"]); $i++) {
        
        $sql = "SELECT * FROM item WHERE item_id = '" . $_POST['item_id_array'][$i] . "'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) == 0) {
            //add item in item_selected
            $sql = "INSERT INTO item (item_id, item_title, item_order) VALUES ('" . $_POST['item_id_array'][$i] . "','" . $_POST['item_title'][$i] . "','" . $i . "')";
            mysqli_query($conn, $sql);
        }
        
        //update item table order
        $query = "UPDATE item SET item_order = '" . $i . "' WHERE item_id = '" . $_POST["item_id_array"][$i] . "'";
        mysqli_query($conn, $query);
    }

    //Delete item table item
    $sql = "DELETE FROM item where item_id NOT IN (" . implode(",", $_POST["item_id_array"]) . ")";
    mysqli_query($conn, $sql);
}
else
{
    $sql = "DELETE FROM item_selected";
    mysqli_query($conn, $sql);
}
?>