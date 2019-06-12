<?php
include('listings-backend/databaseconnect.php');

$mlsid = $_GET['mlsid'];

$sql = "SELECT * FROM `property` WHERE mlsid = '{$mlsid}';";
$result = $conn->query($sql);

if($result->num_rows === 0){
  $sql = "SELECT * FROM `soldlistings` WHERE mlsid = '{$mlsid}';";
  $result = $conn->query($sql);
}

$property = $result->fetch_object();
$images = $property->images;
$images = explode("," , $images);
 ?>
 <!DOCTYPE html>
 <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
 <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
 <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
 <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <title>Barry Thomas - Real Estate</title>
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="shortcut icon" type="image/png" href="assets/images/logo.png"/>
         <link rel="stylesheet" href="assets/fonts/fonts-stylesheet.css">
         <link rel="stylesheet" href="assets/css/font-awesome.min.css">
         <link rel="stylesheet" href="assets/css/bootstrap.min.css">
         <link rel="stylesheet" href="assets/css/style.css">
         <link rel="stylesheet" href="assets/css/responsive.css">
         <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
     </head>
     <body>
         <!--[if lt IE 7]>
             <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
         <![endif]-->

         <!---- Header start --->
         <header class="susan-header-area clearfix">
             <div class="container-fluid">
                 <div class="row">
                     <div class="susan-main-menu w-100 clearfix">
                         <!---- Menu area start ---->
                         <nav class="navbar navbar-expand-md navbar-dark ">
                             <a class="navbar-brand" href="index.php">
                                 <img class="white-logo" src="assets/images/logo.png" alt="" />
                                 <img class="black-logo" src="assets/images/black-logo.png" alt="" />
                             </a>
                             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                                 <span class="navbar-toggler-icon"></span>
                             </button>
                             <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                                 <ul class="navbar-nav">
                                     <li class="nav-item">
                                         <a class="nav-link active" href="index.php">Home</a>
                                     </li>
                                     <li class="nav-item dropdown">
                                         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Properties
                                         </a>
                                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                             <a class="dropdown-item" href="mylistings.php">My Listings</a>
                                             <a class="dropdown-item" href="bowenmls.php">All Bowen Island Listings</a>
                                             <a class="dropdown-item" href="bowenlots.php">All Bowen Island Lots</a>
                                         </div>
                                     </li>
                                     <li class="nav-item dropdown">
                                         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             About Us
                                         </a>
                                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                             <a class="dropdown-item" href="about-us.php">Meet the Team</a>
                                             <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                                         </div>
                                     </li>
                                      <li class="nav-item">
                                         <a class="nav-link" href="bowen.html">Bowen Island</a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="nav-link" href="contact-us.html">Contact</a>
                                     </li>
                                 </ul>
                             </div>
                         </nav>
                         <!---- Menu area end ---->
                     </div>
                 </div>
             </div>
         </header>
         <!---- Header end --->

         <!----- Page banner start ----->
         <section class="susan-page-banner" style="background-image:url(assets/images/page-banner.png)">

         </section>
         <!----- Page banner end ----->

         <!----- Testimonials susan ------>
         <section class="testimonial-about-area clearfix">
             <div class="container">
               <div class="row">
                 <div class="col-md-12">
                   <a href="javascript:window.history.back()" class="back-btn">
                     <i class="fa fa-angle-left"></i>
                     Back
                   </a>
                 </div>
                 <div class="col-md-12">
                   <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                     <div class="carousel-inner">
                       <?php
                       $first = 1;
                       foreach ($images as $image) {
                         if($first){
                           echo "<div class='carousel-item active'>";
                           $first = 0;
                         } else {
                           echo "<div class='carousel-item'>";
                         }
                           echo "<img class='d-block w-100' src='{$image}' alt=''>";
                           echo "</div>";
                       }
                       ?>
                     </div>
                     <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                       <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                       <span class="sr-only">Next</span>
                     </a>
                   </div>
                 </div>
                 <div class="col-md-12">
                   <ul id="prop-overview" style="list-style-type: none; padding-top:30px">
                     <?php
                       echo "<li class='modal-list'>Address: {$property->streetaddress}</li>";
                       echo "<li class='modal-list'>Price: {$property->price}</li>";
                       echo "<li class='modal-list'>Postal Code: {$property->postalCode}</li>";
                       echo "<li class='modal-list'>Building Type: {$property->proptype}</li>";
                       echo "<li class='modal-list'>Size: {$property->propsize}</li>";
                       echo "<li class='modal-list'>MLSid: {$property->mlsid}</li>";
                      ?>
                     <li class="modal-list"></li>
                   </ul>
                 </div>
               </div>
               <div class="row">
                 <h2>&nbsp Description:</h2>
                 <p id="description" style="padding:15px">
                   <?php
                     echo "{$property->description}";
                    ?>
                 </p>
               </div>
             </div>
             </div>
         </section>
         <!----- Testimonials susan ------>

         <section class="browen-article p-0 clearfix">
             <div class="container-fluid">
                 <div class="row justify-content-center">
                     <div class="col-lg-11">
                         <div class="browen-article-padding">
                             <div class="row clearfix">
                                 <div class="col-lg-5">
                                     <h2>Testimonials</h2>
                                     <br />
                                     <br />
                                     <article class="susan-single-testimonial">
                                         <p>Barry oversaw every detail throughout the process and represented our interests with integrity and confidence. He is a real estate marketing powerhouse who is attentive, gracious and fun. He epitomizes competence. A rare find.</p>
                                         <h4>— Shawna Goodrich & Vikk Dua, June 2018</h4>
                                         <div class="height-60"></div>
                                         <div class="susan-more-testimonial">
                                             <a href="testimonials.html"> <button class="m-0" >VIEW MORE <img src="assets/images/arrow-right.png" alt="" /></button> </a>
                                         </div>
                                     </article>
                                 </div>
                                 <div class="col-lg-7">
                                     <p><img src="assets/images/test-2.png" alt="" /></p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
         <div class="margin-100"></div>
         <!---- Footer start --->
         <footer class="susan-footer-area clearfix">
             <div class="container">
                 <div class="row">
                     <!--- Single widget start --->
                     <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                         <div class="susan-single-widget susan-footer-logo">
                             <div class="footer-logos text-center d-inline-block">
                                 <a href="#"><img src="assets/images/footer-logo.png" alt="" /></a>
                                 <div class="black-border"></div>
                                 <a href="#"><img src="assets/images/leading logo.png" alt="" /></a>
                             </div>
                         </div>
                     </div>
                     <!--- Single widget end --->
                     <!--- Single widget start --->
                     <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12">
                         <div class="susan-single-widget">
                             <h3>Menu</h3>
                             <ul>
                                 <li><a href="index.php">Home</a></li>
                                 <li><a href="featured-listings.html">Properties</a></li>
                                 <li><a href="about-us.php">Meet the Team</a></li>
                                 <li><a href="contact-us.html">Contact</a></li>
                             </ul>
                         </div>
                     </div>
                     <!--- Single widget end --->
                     <!--- Single widget start --->
                     <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12">
                         <div class="susan-single-widget">
                             <h3>Resources</h3>
                             <ul>
                                 <li><a href="bowen.html">About Bowen</a></li>
                                 <li><a href="testimonials.php">Testimonials</a></li>
                             </ul>
                         </div>
                     </div>
                     <!--- Single widget end --->
                     <!--- Single widget start --->
                     <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                         <div class="susan-single-widget">
                             <h3>Barry Thomas — Personal Real Estate Corporation</h3>
                             <p>Cell: (604) 803-0012 <br /> Office: (604) 947-9738 <br />Email: bt@livingbowen.com</p>
                             <p>Address:<br> 1575 Marine Drive, West Vancouver, BC V7V 1H9 CA</p>
                             <p class="social-links"><a href="https://www.facebook.com/LivingBowen/"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="https://www.instagram.com/livingbowen"><i class="fa fa-instagram" aria-hidden="true"></i></a><a href="https://twitter.com/LivingBowen"><i class="fa fa-twitter" aria-hidden="true"></i></a></p>
                         </div>
                     </div>
                     <!--- Single widget end --->
                 </div>
             </div>
         </footer>
         <!---- Footer end --->

         <script src="assets/js/jQuery.min.js"></script>
         <script src="assets/js/popper.min.js"></script>
         <script src="assets/js/bootstrap.min.js"></script>
         <script src="assets/js/main.js"></script>
     </body>
 </html>
