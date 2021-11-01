<?php
include 'db_connection.php';

if (isset($_POST['submit'])) {

    $test = $_POST['deleted_id'];
    $array = explode(" ", $test);
    $delarray = $array;

    $name = $_POST["name"];
    $percentage = $_POST["percentage"];
    $id = $_POST["id"];
    $data = array();
    $arrlength = count($name);

    for ($x = 0; $x < $arrlength; $x++) {
        $name1 = $name[$x];
        $percentage1 = $percentage[$x];
        $ids = $id[$x];
        if ($ids != '') {
            // update query
            $sql = "UPDATE `members` SET `name` = '$name1', `percentage` = '$percentage1' WHERE `members`.`id` = '$id[$x]';";
            $query = mysqli_query($conn, $sql);
            $data[] = $id[$x];
        } else {
            // Insert sql query
            if ($name1 != '' && $percentage1 != '') {
                $sql = "INSERT INTO `members` (`name`, `percentage`) VALUES ('$name1', '$percentage1');";
                $query = mysqli_query($conn, $sql);
                $last_id = mysqli_insert_id($conn);
                $data = $last_id;
            }
        }
    }
    //Delete Query
    if (isset($_POST['deleted_id']) && $_POST['deleted_id'] != "") {
        $dele = "DELETE FROM `members` where `id` IN (" . implode(",", $array) . ")";
        $done = mysqli_query($conn, $dele);
    }
    header("Location: http://localhost/idit/Pratical10/index.php");
}
?>