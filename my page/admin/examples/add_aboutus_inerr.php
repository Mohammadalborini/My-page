<?php 
include("db_config.php");
session_start();

include "header.php";

$numrow = $_SESSION['numrow'];
?>
 <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
           
                  <div class="card">
                <div class="card-header card-header-primary" style="background:#6610f2;">
                  <h4 class="card-title" >Add</h4>
                </div>
                <div class="card-body">

<form action="" method="POST" enctype="multipart/form-data">
    <label>Icon</label>
          <input name="image" type="file" class="form-control" required>
    <div class="mt-5">
        <button type="submit" name="add_slide" value="save" class="btn btn-primary">Save changes</button>
        <a href="aboutus_inerr.php" class="btn btn-danger">Cancel</a>
    </div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>

<?php 

if (isset($_POST['add_slide'])) {

    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','svg'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
            // Insert image content into database 
            $sql="INSERT into aboutus_inerr (icons) VALUES ('$imgContent')";
            $insert = mysqli_query($conn, $sql);

            echo "<script> alert('Add new About us icon.') </script>";
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 

}
?>



<?php include "footer.php" ?>