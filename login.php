
<?php

include 'partial/_dbconnect.php';

$login = false;
$showError = false;

if(isset($_POST['submit']))
{
  

  $uname=$_POST["uname"];
  $pass= $_POST["pass"];
  
  
  
    $sql="select * from users where username='$uname' ";

    $result=mysqli_query($conn,$sql);
 
    $num=mysqli_num_rows($result);

    if($num == 1){
      while($row=mysqli_fetch_assoc($result))
      {
        if(password_verify($pass,$row['password']))
        {
          $login=true;

          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['uname']=$uname;
    
    
          header("location:welcome.php");

        }
        else{
          $showError="Password do not Match";
        } 
      }
      
    }
    else{
      $showError="Password do not Match";
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
  
  if($login){
    echo '<div class="alert alert-success" role="alert">
    <strong>Success</strong>You are logged in
  </div>';
  }


  if($showError){
    echo '<div class="alert alert-danger" role="alert">
    <strong>Error!</strong>'. $showError.'
  </div>';
  }

  ?>

  

  <div class="conatainer">
    <h1 class="text-center">Login to our website</h1>
  
  
    <form action="/login/login.php" method="post">
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
      
      <button type="submit" name="submit" class="btn btn-primary ">SignUp</button>
    </form>

  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>