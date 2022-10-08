    <?php 
        $date = date('l, F j, Y'); 
        $time_in = date("h:i:sa");
        $time_out = date("h:i:sa", strtotime('+8 hour'));
        $date_created = date("Y-m-d");
    ?>

    <?php include("header.php"); ?>
    <?php
        session_start();
        require 'dbcon.php';
        $id = $_SESSION["id"];

        $sql=mysqli_query($con,"SELECT * FROM admin WHERE id='$id'");
        $row  = mysqli_fetch_array($sql);

        if($row["user_name"] == NULL){
            header("Location: login.php"); 
        }
    ?>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="completename">Name</label>
                    <input type="text" class="form-control" id="completename" autocomplete="off" placeholder="Enter Your Name">
                </div>
                <div class="form-group">
                    <label for="completetime_in">Time In</label>
                    <input type="text" class="form-control" value="<?php echo $time_in; ?>" id="completetime_in" autocomplete="off" placeholder="Enter Your Time In">
                </div>
                <div class="form-group">
                    <label for="completetime_out">Time Out</label>
                    <input type="" class="form-control" value="<?php echo $time_out; ?>" id="completetime_out" autocomplete="off" placeholder="Enter Your Time Out">
                </div>
                <div class="form-group">
                    <label for="completedate">Date</label>
                    <input type="text" class="form-control" value="<?php echo $date; ?>" id="completedate" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="completedate_created">Date Created</label>
                    <input type="text" class="form-control" value="<?php echo $date_created; ?>" id="completedate_created" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" onclick="addUser()">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Users</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="updatename">Name</label>
                <input type="text" class="form-control" id="updatename" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="updatetime_in">Time IN</label>
                <input type="email" class="form-control" id="updatetime_in" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="updatetime_out">Time OUT</label>
                <input type="text" class="form-control" id="updatetime_out" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="updatedate">Date</label>
                <input type="text" class="form-control" id="updatedate" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="updatedate_created">Date Created</label>
                <input type="text" class="form-control" id="updatedate_created" autocomplete="off">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" onclick="updateUser()">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="hidden" id="hiddendata">
        </div>
        </div>
    </div>
    </div>    

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <h1 class="text-center">Manage Data</h1>
                <button type="button" class="btn btn-dark my-4" data-toggle="modal" data-target="#addModal">Add Data</button>
                <div id="displayStatus"></div>
                <div id="displayDataTable"></div>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>