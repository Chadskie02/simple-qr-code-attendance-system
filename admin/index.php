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
            <div class="col-lg-5 mx-auto">
                <div class="card card-body p-5 rounded shadow border bg-white">
                <h1 class="mb-4 text-center">Welcome <?php echo $row["user_name"]; ?></h1>
                </div>
            </div>
        </div>
    </div>



    <?php include("footer.php"); ?>