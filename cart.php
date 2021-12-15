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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Shopping
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
  </head>
  <body >
    <div class="container-fluid">
      <div class="p-4 bg-primary text-white text-center">
        <h1>Shopping
        </h1>
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
endif
?>
        <!-- information of the user logged in -->
        <!-- welcome message for the logged in user -->
        <?php if (isset($_SESSION['username'])): ?>
        <div>Hi, 
          <strong> 
            <?php echo $_SESSION['username']; ?> &nbsp; &nbsp;
          </strong>
          <a class="btn btn-danger" href="index.php?logout='1'"> logout
          </a> 
        </div>
        <?php
endif
?>
      </div>
      <nav class="navbar navbar-expand-sm shadow p-3 mb-5 bg-white rounded" >
        <a class="navbar-brand" href="index.php" >
          <img src="banner_images/banner_1.jpeg" width="30" height="30" class="d-inline-block align-top" alt="">
          Shopping
        </a>
        <nav class="nav nav-pills nav-justified">
  <a class="nav-link " href="index.php">Home</a>
  <a class="nav-link " href="contact.php">Contact</a>
  <a class="nav-link active" href="cart.php">Cart</a>
</nav> 
      </nav>
      <div class="container mt-5">
        <?php
if (isset($_POST))
{
    //Process Form Here
    $rating = $_POST['myRatingsOption'];
    $session_name = $_SESSION['username'];
    $image_name = $_SESSION['varname'];
    $image_name = substr($image_name, 0, -4);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Shopping";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT product, rating FROM product_rating where session_name = '$session_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while ($row = $result->fetch_assoc())
        {
            if ($row["product"] != $image_name)
            {
                $sql = "INSERT INTO product_rating (product, rating, algorithm,rated_from,session_name)
                        VALUES ('$image_name', $rating, 2,1,'$session_name')";
                if ($conn->query($sql) === true)
                {
                    // echo "New record created successfully";
                    
                }
           
                break;
            }
            else
            {
                echo "<h1>Item already added</h1>";
                break;
            }

        
        }
    }
    else
    {
        echo "0 results";
        $sql = "INSERT INTO product_rating (product, rating, algorithm,rated_from,session_name)
        VALUES ('$image_name', $rating, 2,1,'$session_name')";
        if ($conn->query($sql) === true)
        {
            // echo "New record created successfully";
            
        }
  
        
    }




      $sql = "SELECT product, rating FROM product_rating where session_name = '$session_name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            // output data of each row
            while ($row = $result->fetch_assoc())
            {
                
                          // echo "<br> product: " . $row["product"] . " " . $row["rating"] . "<br>"; 
                          $im = $row["product"].".jpg"; 

                           ?>
          <h1>Your Cart       </h1>
          <div class="card">
            <div class="row">
              <div class="col-md-4">

                <img src="images_folder/<?php echo $im; ?>" alt="images_folder/<?php echo $im; ?>" >
              </div>
              <div class="col-md-4">
                <h4>
                  <?php echo "Rating: " . $row["rating"]; ?>
                </h4>
              </div>
            </div>
          </div>
          <?php


            }
          }






        $conn->close();
}
?>
        </div>
        </body>
      </html>
