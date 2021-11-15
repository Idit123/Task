<?php
include 'db_connection.php';

if ($_POST['item_selected_id_array'] != "") {
    for ($i = 0; $i < count($_POST["item_selected_id_array"]); $i++) {

      $sql = "SELECT item_id FROM states WHERE id = '". $_POST['stateid'] ."'";
      echo $sql;


        $sql = "SELECT * FROM item_selected WHERE item_id = '" . $_POST['item_selected_id_array'][$i] . "'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            //add item in item_selected
            $sql = "INSERT INTO item_selected (item_id, item_title, item_order) VALUES ('" . $_POST['item_selected_id_array'][$i] . "','" . $_POST['item_selected_title'][$i] . "','" . $i . "')";
            mysqli_query($conn, $sql);
        }

        //update item table order
        $query = "UPDATE item_selected SET item_order = '" . $i . "' WHERE item_id = '" . $_POST["item_selected_id_array"][$i] . "'";
        mysqli_query($conn, $query);
    }

    //Delete item table item
    $sql = "DELETE FROM item_selected where item_id  NOT IN (" . implode(",", $_POST["item_selected_id_array"]) . ")";
    mysqli_query($conn, $sql);
} else {
    $sql = "DELETE FROM item_selected";
    mysqli_query($conn, $sql);
}
