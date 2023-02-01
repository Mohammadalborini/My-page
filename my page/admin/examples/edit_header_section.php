<?php 
 include("db_config.php");
 session_start();

include "header.php";
?>

<?php 
if (isset($_POST['edit_btn'])){
  $id = $_POST['id'];
  $_SESSION['id'] = $id;
  $result = $conn->query("SELECT * FROM header WHERE id='$id' ") or die($conn->error);
    while ($row = $result->fetch_assoc()){
        $_SESSION['icon'] =  base64_encode($row['icon']);
     
  }}?>
 <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
              
                  <div class="card">
                <div class="card-header card-header-primary" style="background:#6610f2;">
                  <h4 class="card-title">Edit Feedback</h4>
                </div>
                <div class="card-body">

<form action="" method="POST" enctype="multipart/form-data">
    <label>Icon</label><br>
    <img src="data:image/jpg;charset=utf8;base64,<?php echo $_SESSION['icon']; ?>" width="100px" height="100px" alt="#"/>
    <input name="image" type="file" class="form-control">
    <div class="mt-5">
        <button type="submit" name="edit_footer" value="save" class="btn btn-primary">Save changes</button>
        <a href="header_section.php" class="btn btn-danger">Cancel</a>
    </div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>

<?php
if (isset($_POST['edit_footer'])){


        $error = false;
        $status = "";
        
        //check if file is not empty
        if(!empty($_FILES["image"]["name"])) { 
        
            //file info 
            $file_name = basename($_FILES["image"]["name"]); 
            $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
        
            //make an array of allowed file extension
            $allowed_file_types = array('jpg','jpeg','png','gif');
        
        
            //check if upload file is an image
            if( in_array($file_type, $allowed_file_types) ){ 
        
                $tmp_image = $_FILES['image']['tmp_name']; 
                $img_content = addslashes(file_get_contents($tmp_image));      
        
                $img_id = $_SESSION['id'];
                //Now run update query
                $query = $conn->query("UPDATE header SET icon='$img_content'  WHERE id = $img_id");
                echo "<script> alert('Icon edited.') </script>";
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
          echo "<script> alert('Pleace add icon.') </script>";
        }
   
}


?>



<?php include "footer.php" ?>