<?php
include 'db_connection.php';

if (isset($_POST['search'])) {
    $search_param = mysqli_real_escape_string($conn, $_POST['search']);
    if ($search_param != '') {
        $sql = "SELECT * FROM users WHERE username LIKE '%$search_param%'";
    } else {
        $sql = "SELECT * FROM users";
    }
}else {
    $sql = "SELECT * FROM users";
}
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
?>
            <tr id="<?php echo $row["id"]; ?>" data-Username="<?php echo $row["username"]; ?>" data-Email="<?php echo $row["useremail"]; ?>" data-Password="<?php echo $row["userpassword"]; ?>" data-Rights="<?php echo $row['userrights']; ?>">
                <td>
                    <span class="custom-checkbox">
                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                        <label for="checkbox1"></label>
                    </span>
                </td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["useremail"]; ?></td>
                <td><?php echo $row["userpassword"]; ?></td>
                <td><?php echo $row["userrights"]; ?></td>
                <td>
                    <a href="#editEmployeeModal" class="edit" data-toggle="modal" onclick="edit(<?php echo $row['id']; ?>)"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                </td>
                <td>
                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" onclick="dele(<?php echo $row['id']; ?>)"><i class="far fa-trash-alt" data-toggle="tooltip" title="Delete"></i></a>
                </td>
            </tr>
<?php
        }
    }
?>