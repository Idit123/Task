<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pratical 18</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" integrity="sha512-urpIFwfLI9ZDL81s6eJjgBF7LpG+ROXjp1oNwTj4gSlCw00KiV1rWBrfszV3uf5r+v621fsAwqvy1wRJeeWT/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="task18.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js" integrity="sha256-xH4q8N0pEzrZMaRmd7gQVcTZiFei+HfRTBPJ1OGXC0k=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container box">
        <h2 style="text-align: center;">Item Draggable and Sortable</h2>
        <label for="text">State:</label>
        <select name="state" id="state">
            <option style="text-align: center;" value="0">--- Select Country ---</option>
            <?php
            include 'db_connection.php';
            $result = mysqli_query($conn, "SELECT * FROM states");
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
            <?php
            }
            ?>
        </select>
        <div class="row">
            <div class="col-one">
                <input type="hidden" id="state_id" name="state_id">
                <label for="text">Parties:</label>
            </div>
            <div class="col-two">
                <label for="text">Select Parties</label>
                <ul class="list-unstyled" id="item">

                </ul>
            </div>
            <div class="col-three">
                <label for="text">Selected Parties</label>
                <ul class="list-unstyled" id="item_selected">

                </ul>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#state").change(function() {
                var stateid = $(this).val();
                document.getElementById('state_id').value = stateid;
                $.ajax({
                    url: "showitem.php",
                    method: "POST",
                    data: {
                        stateid: stateid
                    },
                    success: function(data) {
                        document.getElementById('item').innerHTML = data;
                        //console.log('data :>> ', data);
                    }
                });
                $.ajax({
                    url: "showitemselected.php",
                    method: "POST",
                    data: {
                        stateid: stateid
                    },
                    success: function(data) {
                        document.getElementById('item_selected').innerHTML = data;
                        //console.log('data :>> ', data);
                    }
                });
            });
            $("ul").sortable({
                connectWith: "ul",
                start: function(event, ui) {
                    ui.item.toggleClass("highlight");
                },
                stop: function(event, ui) {
                    ui.item.toggleClass("highlight");
                },
                update: function(event, ui) {
                    var item_id_array = new Array();
                    var item_selected_id_array = new Array();

                    $('#item li').each(function() {
                        item_id_array.push($(this).attr("id"));
                    });
                    $('#item_selected li').each(function() {
                        item_selected_id_array.push($(this).attr("id"));
                    });
                    $.ajax({
                        url: "item_update.php",
                        method: "POST",
                        data: {
                            item_id_array: item_id_array,
                            item_selected_id_array: item_selected_id_array,
                            stateid: document.getElementById('state_id').value                       
                        },
                        success: function(data) {
                            //alert(data);
                            console.log('data :>> ', data);
                        }
                    });
                }
            });
        })
    </script>
</body>

</html>