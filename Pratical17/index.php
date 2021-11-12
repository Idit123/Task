<?php
include 'db_connection.php';
$query = "SELECT * FROM item ORDER BY item_order ASC";
$result = mysqli_query($conn, $query);
?>
<html>

<head>
    <title>Pratical 17</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js" integrity="sha256-xH4q8N0pEzrZMaRmd7gQVcTZiFei+HfRTBPJ1OGXC0k=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="task17.css">
</head>

<body>
    <div class="container box">
        <h2 style="text-align: center;">Item Draggable and Sortable</h2>
        <ul class="list-unstyled" id="page_list">
            <?php
            include 'db_connection.php';
            $query = "SELECT * FROM item ORDER BY item_order ASC";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                echo '<li  id="' . $row["item_id"] . '"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . $row["item_title"] . '</li>';
            }
            ?>
        </ul>
    </div>
    <script>
        $(document).ready(function() {
            $("#page_list").sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    var page_id_array = new Array();
                    $('#page_list li').each(function() {
                        page_id_array.push($(this).attr("id"));
                    });
                    $.ajax({
                        url: "update.php",
                        method: "POST",
                        data: {
                            page_id_array: page_id_array
                        },
                        success: function(data) {
                            // alert(data);
                        }
                    });
                }
            });

        });
    </script>
</body>

</html>