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
                  <h4 class="card-title">Add Client opinion about me</h4>
                </div>
                <div class="card-body">

<form action="" method="POST" enctype="multipart/form-data">
    <label>Name</label>
    <input autocomplete="off"  type="text" class="form-control" name="Name" required>
    <label>Subject</label>
    <input autocomplete="off"  type="text" class="form-control" name="Subject" required>
    <label>Image</label>
    <input autocomplete="off"  type="file" class="form-control" name="image" required>
   
    <div class="mt-5">
        <button type="submit" name="add_contact" value="save" class="btn btn-primary">Save changes</button>
        <a href="client.php" class="btn btn-danger">Cancel</a>
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

    $Name= $_POST['Name'];
    $Subject= $_POST['Subject'];

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
            $sql="INSERT into client (name, description, image) VALUES ('$Name','$Subject','$imgContent')";
            $insert = mysqli_query($conn, $sql);

            echo "<script> alert('Add new client section.') </script>";
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
        echo "<script> alert('Please select an image file to upload.') </script>";
    } 
           
    

}

?>




<?php include "footer.php" ?>