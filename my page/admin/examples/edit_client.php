<?php 
session_start();
include("db_config.php");
include "header.php";
?>
<?php 
if (isset($_POST['id'])){
  $id = $_POST['id'];
  $_SESSION['id'] = $id;
  $result = $conn->query("SELECT * FROM client WHERE id='$id' ") or die($conn->error);
    while ($row = $result->fetch_assoc()){
    $_SESSION['name'] = $row['name'];
    $_SESSION['description'] = $row['description'];
    $_SESSION['image'] =  base64_encode($row['image']);
  }}?>	

 <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                <div class="card-header card-header-primary" style="background:#6610f2;">
                  <h4 class="card-title">Edit Contact Us</h4>
                </div>
                <div class="card-body">

<form action="" method="post" enctype="multipart/form-data">
    <label>Name</label>
    <input autocomplete="off"  type="text" class="form-control" value="<?php echo $_SESSION['name']; ?>" name="name" required>
    <label>Sub Title</label>
    <input autocomplete="off"  type="text" class="form-control" value="<?php echo $_SESSION['description']; ?>" name="description" required>
    <label>Image</label> <br>
    <img src="data:image/jpg;charset=utf8;base64,<?php echo $_SESSION['image']; ?>" width="100px" height="100px"  alt="">
    <input autocomplete="off"  type="file" class="form-control"  name="image" required>
    <div class="mt-5">
        <button type="submit" name="save" value="save" class="btn btn-primary">Save changes</button>
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

if (isset($_POST['save'])){

  
    $error = false;
    $status = "";
    //check if file is not empty
    if(!empty($_FILES["image"]["name"])) { 
    
        //file info 
        $file_name = basename($_FILES["image"]["name"]); 
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
    
        //make an array of allowed file extension
        $allowed_file_types = array('jpg','jpeg','png');
    
    
        //check if upload file is an image
        if( in_array($file_type, $allowed_file_types) ){ 
    
            $tmp_image = $_FILES['image']['tmp_name']; 
            $img_content = addslashes(file_get_contents($tmp_image)); 

            $name= $_POST['name'];
            $description= $_POST['description'];
    
            $img_id = $_SESSION['id'];
            //Now run update query
            $query = $conn->query("UPDATE client SET name='$name', description='$description', image = '$img_content'  WHERE id = $img_id");
            echo "<script> alert('client Section edited.') </script>";
             //check if successfully inserted
            if($query){ 
                $status = "Image has been successfully updated."; 
            }else{ 
                $error = true;
                $status = "Something went wrong when updating image!!!"; 
            }  
        }else{ 
            $error = true;
            $status = 'Only support jpg, jpeg, png, gif format'; 
        } 
    
    }else {
        echo "<script> alert('Please select an image file to upload.') </script>";
    }
           
}
?>




<?php include "footer.php" ?>