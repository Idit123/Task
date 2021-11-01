<?php include 'connection.php'; ?>
<html>
<head>
    <title> Add, Edit, Delete User With Pagination </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
        <!-- Add Data Popup -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form action="query.php" method="POST">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <input type="text" name="uname" required placeholder="Enter Username" />
                <input type="text" name="uemail" required placeholder="Enter Email"/>
                <input type="text" name="umno" maxlength="10" required placeholder="Enter Mobile No."/>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addData" class="btn btn-primary">Submit</button>
            </div>
            </div>
            </form>
        </div>
        </div>

        <!-- Edit Data Popup -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form action="query.php" method="POST">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <input type="hidden" id="editid" name="editid" />
                <input type="text" id="uname" name="upname" required placeholder="Enter Username" />
                <input type="text" id="uemail" name="upemail" required placeholder="Enter Email"/>
                <input type="text" id="umno" name="upmno" maxlength="10" required placeholder="Enter Mobile No."/>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="editData" class="btn btn-primary">Submit</button>
            </div>
            </div>
            </form>
        </div>
        </div>

        <!-- Delete Data Popup -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form action="query.php" method="POST">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="delid" name="delid" />
                <p> Are you sure to delete these data? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="delData" class="btn btn-danger">Delete</button>
            </div>
            </div>
            </form>
        </div>
        </div>


    <div class="container"> 
        <div class="container-fluid" style="text-align:center; margin: 10px;">
            <button data-toggle="modal" data-target="#addModal" class="btn btn-success"> Add New User </button>
        </div>
        
        
        <div class="container-fluid" style="text-align:center; margin: 10px;">
            <form action="" method="GET">
                <label> Show Rows : </label>
                <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : 1 ?>" />
                <select name="selectLimit" onchange="this.form.submit();">
                    <?php
                        foreach([5,10,25,50] as $selected)
                        {
                            ?>
                                <option <?php if(isset($_REQUEST['selectLimit']) && $_REQUEST['selectLimit'] ==  $selected) echo "selected"?>  value="<?php echo $selected ?>"> <?php echo $selected ?> </option>
                            <?php
                        }
                        
                    ?>
                </select>
            </form>
        </div>
        <div class="container-fluid" >
            <form action="" method="GET" style="display:flex">
                <input type="text" name="search" />
                <input type="submit" value="Search" style="width: 100px;"/>
            </form>
        </div>
        <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $selected = isset($_REQUEST['selectLimit']) ? $_REQUEST['selectLimit'] : 5;
            
            $start = ($page - 1) * $selected;

            $q = "select * from task11 where 1=1";

            $search = $_GET['search'];

            $q .= " AND id LIKE '%".$search."%' OR username LIKE '%".$search."%' OR email LIKE '%".$search."%' OR mno LIKE '%".$search."%'";


            if(isset($_GET['column']))
            {
                $column = $_GET['column'];
            }
            else
            {
                $column = "id";
            }

            if(isset($_GET['order']))
            {
                $order = $_GET['order'];
            }
            else
            {
                $order = "ASC";
            }
            // echo $column;
            // echo $order;

            $q .= " ORDER BY $column $order";

            $q .= " limit $start,$selected";
            // echo $q;
            $result = mysqli_query($con,$q);

            $order == "DESC" ? $order = "ASC" : $order = "DESC";
        ?>
        <table class="table table-striped" >
        <thead>
            <tr>
            <th scope="col"><a style="text-decoration:none; color:black" href="?column=id&order=<?php echo $order ?>"> ID <i class="fa fa-sort"></i> </a></th>
            <th scope="col"><a style="text-decoration:none; color:black" href="?column=username&order=<?php echo $order ?>"> User Name <i class="fa fa-sort"></i> </a></th>
            <th scope="col"><a style="text-decoration:none; color:black" href="?column=email&order=<?php echo $order ?>"> Email <i class="fa fa-sort"></i> </a></th>
            <th scope="col"><a style="text-decoration:none; color:black" href="?column=mno&order=<?php echo $order ?>"> Mobile No. <i class="fa fa-sort"></i> </a></th>
            <th scope="col" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($row = mysqli_fetch_array($result))
            {
            ?>
            <tr>
                <td scope="row"><?php echo $row['id'] ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['mno'] ?></td>
                <td><a data-toggle="modal" id="editBtn" data-target="#editModal"><i class="fa fa-pencil-square-o" id="edit" aria-hidden="true"></i></a></td>
                <td><a data-toggle="modal" id="deleteBtn" data-target="#deleteModal"><i class="fa fa-trash-o" id="delete" aria-hidden="true"></i></a></td>
            </tr> 
            <?php
                }
            ?>
        </tbody>
        </table>
        <div class="container-fluid" style="text-align:center; margin: 10px;">
            <?php
                $q = mysqli_query($con,"select * from users");
                $total = mysqli_num_rows($q);
                $t_page = ceil($total/$selected);
                // echo $t_page;

                if($page>1)
                {
                ?>
                    <a href="task11.php?page=<?php echo $page-1; ?>&selectLimit=<?php echo $selected ?>"  style="text-decoration:none" class="btn btn-secondary"> Previous </a>
                <?php
                }

                for($i=1;$i<=$t_page;$i++)
                {
                ?>
                    <a href="task11.php?page=<?php echo $i; ?>&selectLimit=<?php echo $selected ?>"  style="text-decoration:none" class="btn btn-secondary"> <?php echo $i; ?> </a>
                <?php    
                }

                if($i-1>$page)
                {
                ?>
                    <a href="task11.php?page=<?php echo $page+1; ?>&selectLimit=<?php echo $selected ?>"  style="text-decoration:none" class="btn btn-secondary"> Next </a>
                <?php
                }
            ?>
        </div>
    </div>
    <script>
        edit = document.querySelectorAll('#editBtn');
        // console.log(edit);
        for(var i=0;i<edit.length;i++)
        {
            // console.log(i);

            edit[i].addEventListener("click",function(){
                $td = this.parentElement;
                $tr = $td.parentElement;
                $row = $tr.querySelectorAll('td');
                
                $arr = Array.from($row);

                $data = $arr.map(function(item){
                    return item.innerText;
                })
                
                var s1= document.getElementById("editid").value = $data[0];
                var s2= document.getElementById("uname").value = $data[1];
                var s3=document.getElementById("uemail").value = $data[2];
                var s4=document.getElementById("umno").value = $data[3];

                // console.log(s1);
                // console.log(s2);
                // console.log(s3);
                // console.log(s4);

            })
        }

        del = document.querySelectorAll('#deleteBtn');
        for(var i=0;i<=del.length;i++)
        {
            del[i].addEventListener("click",function(){
                $td = this.parentElement;
                $tr = $td.parentElement;
                $row = $tr.querySelectorAll('td');
                console.log($row);
                
                $arr = Array.from($row);

                $data = $arr.map(function(item){
                    return item.innerText;
                })
                
                var s1= document.getElementById("delid").value = $data[0];
                console.log(s1);

            })
        }
    </script>
<body>
</html>