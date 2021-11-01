<?php
include 'db_connection.php';

$sql = "SELECT * FROM `members`";
$result = mysqli_query($conn, $sql);

//  Find the number of recors returned
$num = mysqli_num_rows($result);

//  Display the rows returned by the sql query
if ($num > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div id="clone" class="duplicate"><input type="hidden" name="id[]" value="<?php echo $row['id']; ?>"><label for="members">Number Of Members</label><input type="text" name="name[]" value="<?php echo $row['name']; ?>"><label for="percentage">Percentage</label><input type="text" name="percentage[]" value="<?php echo $row['percentage']; ?>"><button class="btnremove" name="remove" value="<?php echo $row['id']; ?>" onclick="remove(this)">Remove</button></div>
      <?php
    }
}
?>