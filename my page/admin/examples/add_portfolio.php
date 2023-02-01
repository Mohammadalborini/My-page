<?php
session_start();
include("db_config.php");
include "header.php";
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header card-header-primary" style="background:#6610f2;">
                        <h4 class="card-title">Add Business summary</h4>
                    </div>
                    <div class="card-body">

                        <form action="" method="POST" enctype="multipart/form-data">
                            <label>Title</label>
                            <input autocomplete="off" type="text" class="form-control" name="Title" required>
                            <label>Sub title</label>
                            <input autocomplete="off" type="text" class="form-control" name="Sub_title" required>
                            <label>Image</label>
                            <input autocomplete="off" type="file" class="form-control" name="image" required>

                            <div style="margin-top:40px;">
                                <label style="font-size:17px; color:black;" for="pro">Projects</label>
                                <input type="radio" name="check[]" value="1" id="pro" required style="margin-right:20px;">


                                <label style="font-size:17px; color:black;" for="my">Mysql Database </label>
                                <input type="radio" name="check[]" value="2" id="my" required style="margin-right:20px;">


                                <label style="font-size:17px; color:black;" for="code">Code</label>
                                <input type="radio" name="check[]" value="3" id="code" required style="margin-right:20px;">


                                <label style="font-size:17px; color:black;" for="de">Design</label>
                                <input type="radio" name="check[]" value="4" id="de" required>
                            </div>

                            <div class="mt-5">
                                <button type="submit" name="add_contact" value="save" class="btn btn-primary">Save changes</button>
                                <a href="portfolio.php" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['add_contact'])) {

    $title =  $_POST['Title'];
    $Sub_title = $_POST['Sub_title'];


    $check = $_POST['check'];

    foreach ($check as $check2) {
    }
    $status = 'error';
    if (!empty($_FILES["image"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'svg');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

            // Insert image content into database 
            $sql = "INSERT INTO `portfolio`(`title`, `sub_title`, `image`, `filter`) VALUES ('$title','$Sub_title','$imgContent','$check2')";
            mysqli_query($conn, $sql);

            echo "<script> alert('Add new portfolio section.') </script>";
        }
    } else {
        echo "<script> alert('Please select an image file to upload.') </script>";
    }
}

?>




<?php include "footer.php" ?>