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
      <div>Hi, <strong> <?php echo $_SESSION['username']; ?> </strong>
    <a class="btn btn-danger" href="index.php?logout='1'"> logout</a> </div>
    <?php endif ?>

</div>

<nav class="navbar navbar-expand-sm shadow p-3 mb-5 bg-white rounded" >

  <a class="navbar-brand" href="#" >
    <img src="banner_images/banner_1.jpeg" width="30" height="30" class="d-inline-block align-top" alt="">
    Shopping
  </a>
<nav class="nav nav-pills nav-justified">
  <a class="nav-link active" href="index.php">Home</a>
  <a class="nav-link " href="contact.php">Contact</a>
  <a class="nav-link" href="#">Cart</a>
</nav>  
</nav>

<style type="text/css">
  .carousel .carousel-item {
  height: 500px;
}

.carousel-item img {
    
    object-fit:cover;
    top: 0;
    left: 0;
}
.carousel .carousel-indicators button {background-color: blue;}
.carousel .carousel-indicators button.active {background-color: brown;}

</style>
<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner ">
    <div class="carousel-item active">
      <img src="banner_images/banner_1.jpeg" alt="Los Angeles" class="d-block" style="width:100%">
      <div class="carousel-caption text-primary">
        <h3>Los Angeles</h3>
        <p>We had such a great time in LA!</p>
      </div>
    </div>
    <div class="carousel-item ">
      <img src="banner_images/banner_1.jpeg" alt="Chicago" class="d-block" style="width:100%">
      <div class="carousel-caption text-primary">
        <h3>Chicago</h3>
        <p>Thank you, Chicago!</p>
      </div> 
    </div>
    <div class="carousel-item">
      <img src="banner_images/banner_1.jpeg" alt="New York" class="d-block" style="width:100%">
      <div class="carousel-caption text-primary">
        <h3>New York</h3>
        <p>We love the Big Apple!</p>
      </div>  
    </div>
  </div>
  
  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev bg-primary" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon "></span>
  </button>
  <button class="carousel-control-next bg-primary" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>



<div class="container mt-5">
<!-- Photo Grid -->
<div class="row"> 

<?php 
$rows = file("csv_files/Clusters.csv");
$len = count($rows);
$rand = [];

$directory = "images_folder";
$images = glob($directory . "/*.jpg");

foreach($images as $image)
{
  $image_from_folder= substr($image,14,);



while (count($rand) < 60) {
    $r = rand(0, $len);
    if (!in_array($r, $rand)) {
        $rand[] = $r;
    }
}
foreach ($rand as $r) {
    $csv = $rows[$r];
    $data = str_getcsv($csv);
    if($image_from_folder==$data[0])
    {
    ?>


     <div class="column ">
    <a href="product_view.php?id1=<?php echo $data[0]; ?>&id2=<?php echo $data[1]; ?>"><img src="images_folder/<?php echo $data[0]; ?>" alt="images_folder/<?php echo $data[0]; ?>" /></a>
            <!-- <p> <?php echo $data[0].", ".$data[1]; ?></p> -->
             <p> <?php echo "Image ".$r; ?></p> 
            </div> 
            <?php
}}
}
?>


  
  
</div>





<style>


.header {
  text-align: center;
  padding: 32px;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  padding: 10px;
  border-radius: 10px;
  background-color: #ddd;
}

/* Create four equal columns that sits next to each other */
.column {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;
}

.column img {
  margin-top: 4px;
   border: 2px solid #e8e8e8;
   border-radius: 20px;
   float: left;
    width:  300px;
    height: 300px;
    background-size: cover;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .column {
    -ms-flex: 50%;
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    -ms-flex: 100%;
    flex: 100%;
    max-width: 100%;
  }
}
</style>

		
</body>
</html>