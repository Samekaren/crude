<?php
include 'crud/htmlheader.php';
session_start();
  if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $pic = $_FILES['pictures']['name'];

  $sql = "insert into `pract` (name,username,email,pictures)values('$name','$username','$email','$pic')";
  $result = mysqli_query($conn, $sql);
  if($result){
    move_uploaded_file($_FILES['pictures']['tmp_name'], 'picture/'.$_FILES['pictures']['name']);
    $_SESSION['status'] = "image upload succesfully";
    echo '<script>window.location.href="display.php?usercreat=created";</script>';

  }else{
    $_SESSION['status'] = "image not upload succesfully";
    
    header('Location:display.php');
  }
  }
?>
<div class="container">

  <div class="row">
    <div class="col-md-12">


    <form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="name" class="form-label lead">Name:</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
    <div id="nameHelp" class="form-text">We'll never share your Name with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="username" class="form-label lead">Username:</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
    <div id="usernameHelp" class="form-text">We'll never share your Username with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label lead">Email address:</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="pictures" class="form-label lead">Picture:</label>
    <input type="file" class="form-control" id="pictures" name="pictures" aria-describedby="picturesHelp">
    <div id="picturesHelp" class="form-text">We'll never share your Picture with anyone else.</div>
  </div>
  <button type="submit" value="upload" class="btn btn-primary" name="submit">Submit</button>
</form>


    </div>
  </div>
</div>

<?php include 'crud/htmlfooter.php'; ?>
