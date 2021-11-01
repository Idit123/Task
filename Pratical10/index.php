<!DOCTYPE html>
<html>

<head>
    <title>Pratical 10</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="task.css">
</head>

<body>
    <div class="buttondiv">
        <button class="btnadd" id="add" onclick="clonediv()">Add</button>
    </div>

    <form action="submit.php" method="POST">
        <div id="clone" class="duplicate">
            <!-- <input type="hidden" name="id[]" value=""><label for="members">Number Of Members</label><input type="text" name="name[]"><label for="percentage">Percentage</label><input type="text" name="percentage[]"><button class="btnremove" name="remove" onclick="remove(this)">Remove</button> -->
        </div>
        <?php include 'showdata.php'; ?>
        <div id="new"></div>
        <div class="buttondiv">
            <input type="hidden" name="deleted_id" id="deleted_id">
            <button type="submit" class="btnsubmit" name="submit" onclick="submit()">Submit</button>
            <button type="reset" class="btncancel" onclick="reload()">Cancel</button>
        </div>
    </form>
    <script>
        function clonediv() {
            var clone = document.createElement("div");
            var newdiv = clone.cloneNode(true);
            newdiv.innerHTML = '<div id="clone" class="duplicate"><input  type="hidden"  name="id[]" value=""><label for="members">Number Of Members</label><input type="text" name="name[]"><label for="percentage">Percentage</label><input type="text" name="percentage[]"><button type="button" class="btnremove" name="remove" value="" onclick="remove(this)">Remove</button></div>';
            document.getElementById("new").append(newdiv);
        }
        let data = [];
        function remove(e) {
            var x = e.value;
            data.push(x);
            data.join();
            console.log(data.join());
            document.getElementById('deleted_id').value = data.join();

            let removediv = e.parentElement;
            removediv.remove();
        }

        function reload() {
            window.location = "index.php";
        }
    </script>
</body>

</html>