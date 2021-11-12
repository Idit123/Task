<?php
include 'db_connection.php';

for($i=0; $i<count($_POST["page_id_array"]); $i++)
{
 $query = "
 UPDATE item 
 SET item_order = '".$i."' 
 WHERE item_id = '".$_POST["page_id_array"][$i]."'";
 mysqli_query($conn, $query);
}
echo 'Page Order has been updated'; 

?>