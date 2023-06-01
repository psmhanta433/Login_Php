
<?php

include 'partial/_dbconnect.php';

$showAlert = false;
$showError = false;

if(isset($_POST['submit']))
{
  

  $uname=$_POST["uname"];
  $pass= $_POST["pass"];
  $cpass=$_POST["cpass"];

  $exists= false;
  $existsql="SELECT * FROM `users` WHERE username='$uname'";

  $result=mysqli_query($conn,$existsql);

  $numExistRow=mysqli_num_rows($result);

  if($numExistRow > 0){
    $exists=true;

    $showError="Username already Exist";
  }
  else{
    

    if(($pass==$cpass) && ($exists==false))
    {

      $hash=password_hash($pass, PASSWORD_DEFAULT);

      $sql="INSERT INTO `users`(`username`, `password`, `date`) VALUES ('$uname','$hash',current_timestamp())";

      $result=mysqli_query($conn,$sql);

      if($result){
        $showAlert=true;
      }
    }
    else{
      $showError="Password do not Match ";
    }
  }

}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
  
    
  <?php require 'partial/_nav.php' ?>


  <?php 
  
  if($showAlert){
    echo '<div class="alert alert-success" role="alert">
    <strong>Success</strong>Your account is now created and You can Login
  </div>';
  }


  if($showError){
    echo '<div class="alert alert-danger" role="alert">
    <strong>Error!</strong>'. $showError.'
  </div>';
  }

  ?>

  

  <div class="conatainer">
    <h1 class="text-center">Signup to our website</h1>
  
  
    <form action="/login/signup.php" method="post">
      <div class="form-group ">
        <label for="username" class="form-label">User Name</label>
        <input type="text" class="form-control" name="uname" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <br>
      <div class="form-group ">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
      </div>
      <br>
      <div class="form-group ">
        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="cpass" id="exampleInputPassword1">
        <small id="emailHelp" class="form-text form-muted">Make Sure to type same Password.</small>
      </div>
      <br>
      <button type="submit" name="submit" class="btn btn-primary ">SignUp</button>
    </form>

  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>