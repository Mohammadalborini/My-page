<?php 
session_start();
$_SESSION['msg'] = '';
$_SESSION['state'] = '';

if (isset($_POST['cancel'])) {
    header("Location: attended.php");
}

if (isset($_POST['save'])) {
    $curl = curl_init();
    $data = array(
        'user_id' => $_POST['user_id'],
        'event_id' => $_POST['event_id']
        );
    $payload = json_encode(array("event" => $data));
    
    // Attach encoded JSON string to the POST fields
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($curl, CURLOPT_URL, "http://localhost/task23/admin/api/attended_events/create.php");
    $ret_val = json_decode(curl_exec($curl), true)['message'];
    curl_close($curl);
    $_SESSION['state'] = $ret_val == 'Created.' ? 'success' : 'warning';
    $_SESSION['msg'] = $ret_val == 'Created.' ? 'Successfully created' : 'Error occurred';
    
    
}

   
$curl = curl_init("http://localhost/task23/admin/api/users/read.php");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$users = json_decode(curl_exec($curl), true)['data'];

$curl = curl_init("http://localhost/task23/admin/api/latest_events/read.php");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$events = json_decode(curl_exec($curl), true)['data'];

curl_close($curl);


include "header.php";
?>
 <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
              <?php if($_SESSION['msg'] && $_SESSION['state']) echo "<div class='alert alert-{$_SESSION['state']}' > {$_SESSION['msg']} </div>" ?>
                  <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Feedback</h4>
                </div>
                <div class="card-body">

<form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
    <label>User</label>
    <select name="user_id" class="form-control">
        <option disabled selected></option>
        <?php for ($i=0; $i < count($users); $i++) : ?>
            <option value="<?php echo $users[$i]['id'] ?>"><?php echo $users[$i]['full_name'].' - id('.$users[$i]['id'].')'; ?></option>
        <?php endfor; ?>
    </select>
    <label>Event</label>
    <select name="event_id" class="form-control">
        <option disabled selected></option>
        <?php for ($i=0; $i < count($events); $i++) : ?>
            <option value="<?php echo $events[$i]['id'] ?>"><?php echo $events[$i]['title'].' - id('.$events[$i]['id'].')'; ?></option>
        <?php endfor; ?>
    </select>

    </textarea>
    <div class="mt-5">
        <button type="submit" name="save" value="save" class="btn btn-primary">Save changes</button>
        <button type="submit" name="cancel" value="cancel" class="btn btn-danger">Cancel</button>
    </div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>





<?php include "footer.php" ?>