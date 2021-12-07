<?php include('header.php') ?>

<div class="container mt-5">
  <div class="row">
  <div class="container">
    <div class="card">
      <div class="container-fliud">
        <div class="wrapper row">
          <div class="preview col-md-6">
            
            <div class="preview-pic tab-content">
              <?php $id=$_GET['id1']; $id1=$_GET['id2']; 
// echo "cluster: ".$id1;echo " image name: ".$id;
?>


              <div class="tab-pane active" id="pic-1">
                <img src="images_folder/<?php echo $id;?>" alt="images_folder/<?php echo $id;?>"  />
                <!-- <p> <?php echo $id; ?></p> -->
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
          <div class="details col-md-6">
            <h3 class="product-title"><?php echo substr($id,0,-10); ?></h3>
            <div class="rating">
              <div class="stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
              <span class="review-no">0000 reviews</span>
            </div>
            <p class="product-description">Description Goes here</p>
            <h4 class="price">current price: <span>$000</span></h4>
<!--            
         <h5 class="sizes">sizes:
              <span class="size" data-toggle="tooltip" title="small">s</span>
              <span class="size" data-toggle="tooltip" title="medium">m</span>
              <span class="size" data-toggle="tooltip" title="large">l</span>
              <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
            </h5>
            <h5 class="colors">colors:
              <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
              <span class="color green"></span>
              <span class="color blue"></span>
            </h5> -->
            <div class="action">
              <button class="add-to-cart btn btn-default" type="button">add to cart</button>
              <!-- <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button> -->
            </div> 
          </div>
        </div>



      </div>

    </div>
  </div>

<div class="card">
  <div class="row">
    <p>Images from cluster:  <php? echo $id1?> </p>
    <?php
      $row = 1;
      $counter=1;
    if (($handle = fopen("csv_files/Clusters.csv", "r")) !== FALSE) {
        // $i=0;
        // $data = fgetcsv($handle, 100, ",");

        while (($data= fgetcsv($handle, 100, ",")) !== FALSE AND $counter<=3) {
             // shuffle($data);
            $num = count($data);

            
            $row++;
       
            ?>
               <?php
      
      if($data[1]==$id1){
     
      $counter++; ?>
       
      <div class="col-md-4"><img src="images_folder/<?php echo $data[0];?>" alt="images_folder/<?php echo $data[0];?>"  />
      <!-- <p> <?php echo $data[0]; ?></p> -->
      </div>

   <?php
}
     }
     

        fclose($handle);
    }
    ?>

    
</div>
  <div class="row">
<hr>
    <?php
    $row = 1;
    $found=0;
    if (($handle = fopen("csv_files/Content_recomendation.csv", "r")) !== FALSE) {
        // $i=0;
        // $data = fgetcsv($handle, 100, ",");

        while (($data= fgetcsv($handle, 100, ",")) !== FALSE ) {
             // shuffle($data);
            $num = count($data);

            // 0456830197, B00020J0ZO, B0002UT2N4, B0000WVVLU
            $image_rec = substr($id,0,-4);
         
            if($data[0]==$image_rec){
              $found=1;
              $image1= $data[1].".jpg";
              $image2= $data[1].".jpg";
              $image3= $data[1].".jpg";

              //Remove spaces
              $image1 = str_replace(' ','',$image1); 
              $image2 = str_replace(' ','',$image2); 
              $image3 = str_replace(' ','',$image3); 
              
               echo "<p>Recommneded images </p>";?>
              <div class="col-md-4"><img src="images_folder/<?php echo $image1;?>" alt="images_folder/<?php echo $image1;?>" />
            
              </div>
              <div class="col-md-4"><img src="images_folder/<?php echo $image2;?>" alt="images_folder/<?php echo $image2;?>" />
            
              </div>
              <div class="col-md-4"><img src="images_folder/<?php echo $image3;?>" alt="images_folder/<?php echo $image3;?>" />
            
              </div>
              <?php break;
  
}
else $found=0;
     }
     if($found==0) echo "Recommendation not found for ".$id;

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
   border: 2px solid #e8e8e8;
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
</style>



</body>
</html>
