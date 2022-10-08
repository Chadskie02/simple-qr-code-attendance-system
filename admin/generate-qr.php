    <?php

    if(isset($_POST["submit"])){
        $data = $_POST["data"];
        
        if($_POST["width"] != ""){
            $width = $_POST["width"];
        } else {
            $width = "250";
        }

        if($_POST["height"] != ""){
            $height = $_POST["height"];
        } else {
            $height = "250";
        }

        $url = "https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$data}";
        $output["img"] =  $url;

    }

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
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 col-12 shadow bg-white mx-auto p-4">
                <h2 class="text-center fw-bold mb-3">QR Code Generator</h2>
                <?php
                    if(isset($data)){
                ?>
                <div class="mb-3">
                    <img src="<?php echo $output["img"]; ?>" alt="QR Code" width="100%" height="100%">
                    <a class="btn btn-primary mt-3" href="<?php echo $output["img"]; ?>" download="QR Code" target="_blank">Download</a>
                </div>
                <?php } ?>
                <form action="" method="post">
                    <div class="form-group mb-3">
                        <label for="data" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="data" name="data" placeholder="Ex. John Doe" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="width" class="form-label">Width</label>
                                <input type="number" class="form-control" id="width" name="width" placeholder="Ex. 250px">
                            </div>
                            <div class="col-6">
                                <label for="height" class="form-label">Height</label>
                                <input type="number" class="form-control" id="height" name="height" placeholder="Ex. 250px">  
                            </div>
                            <div class="m-3">
                                <button type="submit" name="submit" class="btn btn-dark">Generate QR Code</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>