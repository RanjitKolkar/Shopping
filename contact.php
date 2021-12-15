
<?php 
  session_start(); //starting the session, to use and store data in session variable

  //if the session variable is empty, this means the user is yet to login
  //user will be sent to 'login.php' page to allow the user to login
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
  }

  // logout button will destroy the session, and will unset the session variables
  //user will be headed to 'login.php' after loggin out
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Shopping</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">



</head>
<body >
<div class="container-fluid">


<div class="p-4 bg-primary text-white text-center">

    <h1>Shopping</h1>

    <!-- creating notification when the user logs in -->
    <!-- accessible only to the users that have logged in already -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- information of the user logged in -->
    <!-- welcome message for the logged in user -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <div>Hi, <strong> <?php echo $_SESSION['username']; ?> &nbsp; &nbsp;</strong>
    <a class="btn btn-danger" href="index.php?logout='1'"> logout</a> </div>
    <?php endif ?>

</div>

<nav class="navbar navbar-expand-sm shadow p-3 mb-5 bg-white rounded" >

  <a class="navbar-brand" href="index.php" >
    <img src="banner_images/banner_1.jpeg" width="30" height="30" class="d-inline-block align-top" alt="">
    Shopping
  </a>
<nav class="nav nav-pills nav-justified ">
  <a class="nav-link " href="index.php">Home</a>
  <a class="nav-link active" href="contact.php">Contact</a>
  <a class="nav-link " href="cart.php">Cart</a>
</nav>  
</nav>

<div class="container mt-2">

  <div class="row">

	
<!-- Header -->

  <h1>Contact Us</h1>
  <p>Contact Details</p>


</div>
</div>


</div>
</body>
</html>