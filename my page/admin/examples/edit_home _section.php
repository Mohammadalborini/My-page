<?php 
include("db_config.php");
session_start();

include "header.php";
?>
<?php 
if (isset($_POST['id'])){
  $id = $_POST['id'];
  $_SESSION['id'] = $id;
  $result = $conn->query("SELECT * FROM home WHERE id='$id' ") or die($conn->error);
    while ($row = $result->fetch_assoc()){
    $_SESSION['name'] = $row['name'];
    $_SESSION['jop'] = $row['jop'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['phone'] = $row['phone'];

    $_SESSION['image'] =   base64_encode($row['image']);

     
  }}?>




 <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
             
                  <div class="card">
                <div class="card-header card-header-primary" style="background:#6610f2;">
                  <h4 class="card-title">Edit</h4>
                </div>
                <div class="card-body">
<form action="" method="POST" enctype="multipart/form-data">
    <label>Name</label>
    <input autocomplete="off" type="text" class="form-control" name="name" value="<?php echo $_SESSION['name']; ?>" >
    <label>Jop</label>
    <input autocomplete="off" type="text" class="form-control" name="jop" value="<?php echo $_SESSION['jop']; ?>" >
    <label>Email</label>
    <input autocomplete="off" type="email" class="form-control" name="email" value="<?php echo $_SESSION['email']; ?>" >
    <label>Phone</label>
    <input autocomplete="off" type="text" class="form-control" name="phone" value="<?php echo $_SESSION['phone']; ?>" >
    <label>Picture</label><br>
    <img src="data:image/jpg;charset=utf8;base64,<?php echo $_SESSION['image']; ?>" width="100px" height="100px" alt="#"/>
    <input name="image" type="file" class="form-control">
    <div class="mt-5">
        <button type="submit" name="edit_slide" value="save" class="btn btn-primary">Save changes</button>
        <a href="home _section.php" class="btn btn-danger">Cancel</a>
    </div>
    
  
</form>

</div>
</div>
</div>
</div>
</div>
</div>
<?php include "footer.php" ?>

<?php

if (isset($_POST['edit_slide'])){

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
            $jop= $_POST['jop'];
            $email= $_POST['email'];
            $phone= $_POST['phone'];
    
            $img_id = $_SESSION['id'];
            //Now run update query
            $query = $conn->query("UPDATE home SET name='$name', jop='$jop', email='$email', phone='$phone', image = '$img_content'  WHERE id = $img_id");
            echo "<script> alert('Home Section edited.') </script>";
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








