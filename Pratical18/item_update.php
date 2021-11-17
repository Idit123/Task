<?php
include 'db_connection.php';

$state_id = $_POST['stateid'];
if($_POST['item_selected_id_array'] != '')
{
 $item_id = implode(",", $_POST['item_selected_id_array']);
 
 $sql = "UPDATE states SET item_id = '$item_id' WHERE id = '$state_id'";
 mysqli_query($conn, $sql);
 echo $sql;
 
}
else{
    //Delete item table item
    $sql = "UPDATE states set item_id = NULL WHERE id = $state_id";
    mysqli_query($conn, $sql);
echo $sql;
}
?>