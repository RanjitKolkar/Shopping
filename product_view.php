<?php
session_start(); //starting the session, to use and store data in session variable
//if the session variable is empty, this means the user is yet to login
//user will be sent to 'login.php' page to allow the user to login
if (!isset($_SESSION['username']))
{
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

// logout button will destroy the session, and will unset the session variables
//user will be headed to 'login.php' after loggin out
if (isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}

function getCluster($image_input)
{
    $rows = file("csv_files/Clusters.csv");
    $len = count($rows);
    $rand = [];
    $cluster_out = 'Not found';

    $r = 1;
    while (count($rand) < 10000)
    {
        $r++;
        if (!in_array($r, $rand))
        {
            $rand[] = $r;
        }
    }
    foreach ($rand as $r)
    {
        $csv = $rows[$r];
        $data = str_getcsv($csv);

        if ($data[0] == $image_input)
        {
            $cluster_out = $data[1];
            $image_out = $data[0];
            break;
        }
    }

    return $cluster_out;
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
    <?php if (isset($_SESSION['success'])): ?>
      <div class="error success" >
        <h3>
          <?php
    echo $_SESSION['success'];
    unset($_SESSION['success']);
?>
        </h3>
      </div>
    <?php
endif ?>

    <!-- information of the user logged in -->
    <!-- welcome message for the logged in user -->
    <?php if (isset($_SESSION['username'])): ?>
      <div>Hi, <strong> <?php echo $_SESSION['username']; ?> &nbsp; &nbsp;</strong>
    <a class="btn btn-danger" href="index.php?logout='1'"> logout</a> </div>
    <?php
endif ?>

</div>

<nav class="navbar navbar-expand-sm shadow p-3 mb-5 bg-white rounded" >

  <a class="navbar-brand" href="index.php" >
    <img src="banner_images/banner_1.jpeg" width="30" height="30" class="d-inline-block align-top" alt="">
    Shopping
  </a>
        <nav class="nav nav-pills nav-justified">
  <a class="nav-link active" href="index.php">Home</a>
  <a class="nav-link " href="contact.php">Contact</a>
  <a class="nav-link " href="cart.php">Cart</a>
</nav> 
</nav>

<div class="container mt-5">
 
  <div class="row">
  <div class="container">
    <div class="card">
      <div class="container-fliud">
        <div class="wrapper row">
          <div class="preview col-md-6">
            
            <div class="preview-pic tab-content">
              <?php $image_received = $_GET['image_to_send'];
$cluster_received = $_GET['cluster_to_send'];
// echo "Image received: ".$image_received;
// echo "getCluster: ".getCluster($image_received);

?>


              <div class="tab-pane active" id="pic-1">

                <img src="images_folder/<?php echo $image_received; ?>" alt="images_folder/<?php echo $image_received; ?>"  />
                <!-- <p> <?php echo $image_received; ?></p> -->
              </div>
      
            </div>
          <!--   <ul class="preview-thumbnail nav nav-tabs">
              <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
              <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
              <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
              <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
              <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
            </ul> -->
            
          </div>

          <?php 
          $image_rcvd = $image_received;
          $_SESSION['varname'] = $image_rcvd; 

          ?>
         
          <div class="details col-md-6">
            <h3 class="product-title"><?php echo substr($image_received, 0, -10); ?></h3>

            <div class="rating">
              <div class="stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
              <!-- <span class="review-no">0000 reviews</span> -->
            </div>
            <p class="product-description">Description Goes here</p>
            <!-- <h4 class="price">current price: <span>$</span></h4> -->
<!--            
         <h5 class="sizes">sizes:
              <span class="size" data-toggle="tooltip" title="small">s</span>
              <span class="size" data-toggle="tooltip" title="medium">m</span>
              <span class="size" data-toggle="tooltip" title="large">l</span>
              <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
             </h5> -->
          
           



           <form action="cart.php" method="POST">
            <label>Rate the Item: </label>
            <select id="rating_id" name="myRatingsOption" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
   
            <div class="action">
            <button class="add-to-cart btn btn-default" type="submit">Add to Cart</button>
           </div>
            </form>
                  
          </div>
        </div>




      </div>

    </div>
  </div>

<div class="card">
  <div class="row">
    <!-- <p>Images from cluster:  <?php echo $cluster_received ?> </p> -->
    

    <?php
$rows = file("csv_files/Clusters.csv");
$len = count($rows);
$rand = [];
$count = 0;

while (count($rand) < 1000)
{
    $r = rand(0, $len);
    if (!in_array($r, $rand))
    {
        $rand[] = $r;
    }
}

foreach ($rand as $r)
{
    $csv = $rows[$r];
    $data = str_getcsv($csv);
    // echo $data[1];
    if ($data[1] == $cluster_received && $count < 3)
    {
        $count++;

?>
                       
                      <div class="col-md-3">
                      <a href="product_view.php?image_to_send=<?php echo $data[0]; ?>&cluster_to_send=<?php echo $data[1]; ?>">
                      <img src="images_folder/<?php echo $data[0]; ?>" alt="images_folder/<?php echo $data[0]; ?>"  /></a>
                      <!-- <p> <?php echo $data[0]; ?></p> -->

                      
                                      <div class="rating">
            <form action="cart.php" method="POST">
              
            <label>Rate the Item: </label>
            <select id="rating_id" name="myRatingsOption<?php echo $count; ?>" >
                <option value="<?php echo $count."1"; ?>">1</option>
                  <option value="<?php echo $count."2"; ?>">2</option>
                      <option value="<?php echo $count."3"; ?>">3</option>
                          <option value="<?php echo $count."4"; ?>">4</option>
                              <option value="<?php echo $count."5"; ?>">5</option>
            </select>
            
        <?php

        // echo "----".$count." ".$data[0];

          if($count==1)
                $_SESSION['img1']=$data[0];
          if($count==2)
                $_SESSION['img2']=$data[0];
          if($count==3)
                $_SESSION['img3']=$data[0];

                ?>
             
              <!-- <span class="review-no">0000 reviews</span> -->
            </div>
          </div>
                      <?php
    }
}

?>

    
</div>
  <div class="row">
<hr>
    <?php
$row = 1;
$found = 0;
if (($handle = fopen("csv_files/Content_recomendation.csv", "r")) !== false)
{
    // $i=0;
    // $data = fgetcsv($handle, 100, ",");
    while (($data = fgetcsv($handle, 100, ",")) !== false)
    {
        // shuffle($data);
        $num = count($data);

        // 0456830197, B00020J0ZO, B0002UT2N4, B0000WVVLU
        $image_rec = substr($image_received, 0, -4);

        if ($data[0] == $image_rec)
        {
            $found = 1;
            $image1 = $data[1] . ".jpg";
            $image2 = $data[2] . ".jpg";
            $image3 = $data[3] . ".jpg";

            //Remove spaces
            $image1 = str_replace(' ', '', $image1);
            $image2 = str_replace(' ', '', $image2);
            $image3 = str_replace(' ', '', $image3);
?>
              <!-- <p>Images recommended for:  <?php echo $data[0] ?> </p> -->

              <?php
            $cl1 = getCluster($image1);
            $cl2 = getCluster($image2);
            $cl3 = getCluster($image3);
?>
              <div class="col-md-3">
               <a href="product_view.php?image_to_send=<?php echo $image1; ?>&cluster_to_send=<?php echo $cl1; ?>">
                <img src="images_folder/<?php echo $image1; ?>" alt="images_folder/<?php echo $image1; ?>" /></a>
                                       <div class="rating">

                                        <?php $_SESSION['img4'] = $image1;?>
              <label>Rate the Item: </label>
            <select id="rating_id" name="myRatingsOption4" >
                <option value="41">1</option>
                <option value="42">2</option>
                <option value="43">3</option>
                <option value="44">4</option>
                <option value="45">5</option>
            </select>
              <!-- <span class="review-no">0000 reviews</span> -->
            </div>
              </div>
              <div class="col-md-3">
                <a href="product_view.php?image_to_send=<?php echo $image2; ?>&cluster_to_send=<?php echo $cl2; ?>">
                <img src="images_folder/<?php echo $image2; ?>" alt="images_folder/<?php echo $image2; ?>" /></a>
                                       <div class="rating">
                                        <?php $_SESSION['img5'] = $image2;?>
              <label>Rate the Item: </label>
            <select id="rating_id" name="myRatingsOption5" >
                <option value="51">1</option>
                <option value="52">2</option>
                <option value="53">3</option>
                <option value="54">4</option>
                <option value="55">5</option>
            </select>
              <!-- <span class="review-no">0000 reviews</span> -->
            </div>
              </div>
              <div class="col-md-3">
                <a href="product_view.php?image_to_send=<?php echo $image3; ?>&cluster_to_send=<?php echo $cl3; ?>">
                <img src="images_folder/<?php echo $image3; ?>" alt="images_folder/<?php echo $image3; ?>" /></a>
                                       <div class="rating">
                                        <?php $_SESSION['img6'] = $image3;?>
              <label>Rate the Item: </label>
            <select id="rating_id" name="myRatingsOption6" >
                <option value="61">1</option>
                <option value="62">2</option>
                <option value="63">3</option>
                <option value="64">4</option>
                <option value="65">5</option>
            </select>
              <!-- <s
                pan class="review-no">0000 reviews</span> -->
            </div>

            <div class="action">
            <button class="add-to-cart btn btn-default" type="submit">Submit Ratings</button>
           </div>
           
              </div>
            </form>
              <?php break;

        }
        else $found = 0;
    }
    if ($found == 0) echo "No results ";

    fclose($handle);
}
?>


</div></div>


  </div>
</div>

<style type="text/css">
  

/*****************globals*************/
body {
  font-family: 'open sans';
  overflow-x: hidden; }

.row img {

  box-shadow: 5px 10px #F8F8F6;
  margin-top: 4px;
   border: 2px solid #0275d8;
   border-radius: 10px;
   float: left;
    width:  300px;
    height: 300px;
    background-size: cover;

   }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 20px;
  background: #eee;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

/*# sourceMappingURL=style.css.map */


.product_wrapper {
  float:left;
  padding: 10px;
  text-align: center;
  }
.product_wrapper:hover {
  box-shadow: 0 0 0 2px #e5e5e5;
  cursor:pointer;
  }
.product_wrapper .name {
  font-weight:bold;
  }
.product_wrapper .buy {
  text-transform: uppercase;
    background: #F68B1E;
    border: 1px solid #F68B1E;
    cursor: pointer;
    color: #fff;
    padding: 8px 40px;
    margin-top: 10px;
}
.product_wrapper .buy:hover {
  background: #f17e0a;
    border-color: #f17e0a;
}
.message_box .box{
  margin: 10px 0px;
    border: 1px solid #2b772e;
    text-align: center;
    font-weight: bold;
    color: #2b772e;
  }
.table td {
  border-bottom: #F0F0F0 1px solid;
  padding: 10px;
  }
.cart_div {
  float:right;
  font-weight:bold;
  position:relative;
  }
.cart_div a {
  color:#000;
  } 
.cart_div span {
  font-size: 12px;
    line-height: 14px;
    background: #F68B1E;
    padding: 2px;
    border: 2px solid #fff;
    border-radius: 50%;
    position: absolute;
    top: -1px;
    left: 13px;
    color: #fff;
    width: 14px;
    height: 13px;
    text-align: center;
  }
.cart .remove {
    background: none;
    border: none;
    color: #0067ab;
    cursor: pointer;
    padding: 0px;
  }
.cart .remove:hover {
  text-decoration:underline;
  }

</style>



</body>
</html>
