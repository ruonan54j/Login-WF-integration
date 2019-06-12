<?php


include("listings-backend/databaseconnect.php");

$sql = "SELECT * FROM property WHERE `BarryListing`=1";
$result = $conn->query($sql);

function make_card($property){
  $description = htmlspecialchars($property->description,ENT_QUOTES);
  $description_sentences = explode(".", $description);
  $description = $description_sentences[0].'.';
  if(strlen($description) < 35){
    $description = $description.$description_sentences[1].'.';
  }
  if(substr($description, -3) == "Mt."){
    $description = $description.$description_sentences[1].'.';
  }
    echo " <div class='col-lg-4 col-md-4 col-sm-12'><a href='listing-view.php?mlsid={$property->mlsid}'>
            <article class='susan-single-fea-listing'>
              <div class='susan-featured-image clearfix'>
                <img src='{$property->image}' alt='' />
              </div>
              <div class='susan-featured-info clearfix'>
                <h3>{$property->streetaddress}</h3>
                <p>{$description}</p>
                <h4>{$property->price}</h4>
              </div>
            </article></a>
          </div>";
        }
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
        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!---- Header start --->
        <div class="home-desktop-banner">
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

          <!------ Home banner start ------->
          <section class="susan-home-banner clearfix">
              <div class="container">
                  <div class="row">
                      <div class="col-xl-12 text-center col-lg-12 clearfix">
                          <p><img src="assets/images/banner-logo.png" alt="" /></p>
                      </div>
                  </div>
              </div>
              <div class="susam-banner-arrow">
                  <img src="assets/images/Arrow.png" alt="" />
              </div>
              <div class="slider-raper">
                  <div class="owl-carousel owl-theme" id="Slider">
                      <div class="item">
                          <img src="assets/images/home-banner.jpg" alt="" />
                      </div>
                      <div class="item">
                          <img src="assets/images/home-banner2.jpg" alt="" />
                      </div>
                      <div class="item">
                          <img src="assets/images/home-banner3.jpg" alt="" />
                      </div>
                      <div class="item">
                          <img src="assets/images/home-banner4.jpg" alt="" />
                      </div>
                      <div class="item">
                          <img src="assets/images/home-banner5.jpg" alt="" />
                      </div>
                      <div class="item">
                          <img src="assets/images/home-banner6.jpg" alt="" />
                      </div>
                      <div class="item">
                          <img src="assets/images/home-banner7.jpg" alt="" />
                      </div>
                  </div>
              </div>
          </section>
          <!------ Home banner end ------->
        </div>
        <div class="changeClass home-mobile-banner">
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
                              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbarMobile">
                                  <span class="navbar-toggler-icon"></span>
                              </button>
                              <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbarMobile">
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

          <!------ Home banner start ------->
          <section class="susan-home-banner clearfix">
              <div class="container">
                  <div class="row">
                      <div class="col-xl-12 text-center col-lg-12 clearfix">
                          <p><img src="assets/images/banner-logo.png" alt="" /></p>
                      </div>
                  </div>
              </div>
              <div class="susam-banner-arrow">
                  <img src="assets/images/Arrow.png" alt="" />
              </div>
          </section>
          <!------ Home mobile banner end ------->
        </div>

        <!----- Featured listings start ----->
        <section class="susan-featured-listings-area clearfix">
            <div class="container">
                <div class="row justify-content-center susan-featured-heading clearfix">
                    <div class="col-lg-8 text-center">
                        <h2 class="susan-heading">featured listings</h2>
                        <p>Looking for your dream home or recreation property on Bowen Island?</p>
                    </div>
                </div>
                <div class="row clearfix">
                  <?php
                  for($i=0;$property = $result->fetch_object();$i++) {
                        make_card($property);
                      }
                   ?>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 text-center">
                        <a class="susan-read-more" href="featured-listings.html">MORE LISTINGS <img src="assets/images/map.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </section>
        <!----- Featured listings end ----->

        <!------- Article start -------->
        <section class="browen-article clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <p><br /></p>
                        <h2>Bowen Island</h2>
                        <p><strong>Learn more about the island</strong></p>
                        <p>A 20 minute ferry ride from the Horseshoe Bay ferry terminal, Bowen Island is a beautiful residential island in the middle of Howe Sound.</p>
                        <p>Bowen Island is an ideal place to call home surrounded by spectacular nature, a tight community with a vibrant arts, culture and culinary scene. Only a few kilometres from Vancouver City Centre you can enjoy a connection to the city while benefiting from the peace, tranquility and safety of island life.</p>
                        <br />
                        <a class="article-read-more" href="bowen.html">ABOUT BOWEN <img src="assets/images/heart.png" alt="" /></a>

                    </div>
                    <div class="offset-lg-1 col-lg-5">
                        <img class="border-radius-5" src="assets/images/Bitmap.png" alt="" />
                    </div>
                </div>
            </div>
        </section>
        <!------- Article end -------->

        <!------- Article start -------->
        <section class="browen-article clearfix">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-6 offset-lg-1 ">
                        <h2>Our Real Estate Team</h2>
                        <p><strong>Real Estate Services</strong></p>
                        <p>Our team of experts are skilled, entrepreneurial and continually striving to lead the field in marketing, client protection and results. Today's buyers and sellers require a trusted resource to guide them through the complexities of a real estate transaction in an ever changing market. With our extensive knowledge and expertise we are committed to understanding the needs and requirements of our clients and representing their best interests from start to finish. We are are your go-to source for real estate insight and advice.</p>

                        <br />
                        <img class="margin-right-50 medallion-logo"src="assets/images/medallion logo.png" alt="" /><img class="more-awards" src="assets/images/more awards.png" alt="" /><img class="leading-logo" src="assets/images/leading logo.png" alt="" />
                    </div>
                    <div class="col-lg-5">
                        <img class="border-radius-5" src="assets/images/Bitmap(1).png" alt="" />
                    </div>
                </div>
            </div>
        </section>
        <!------- Article end -------->

        <!------ Client testimonials start ------->
        <section class="susan-testimonials-area clearfix">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-12 text-center">
                        <h2 class="susan-heading">client testimonials</h2>
                    </div>
                </div>
                <div class="row clearfix">
                    <?php
                    include("admin/db_connect.php");
                    $sql = "SELECT * FROM testimonials ORDER BY ID DESC LIMIT 0,3";
                    $result = $conn->query($sql);
                    ?>
                    <?php while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <article class="susan-single-testimonial">
                                <p><?php echo $row['description']; ?></p>
                                <h4><?php echo $row['author']; ?></h4>
                            </article>
                        </div>
                    <?php
                    } ?>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 text-center">
                        <a class="susan-read-more" href="testimonials.php">MORE STORIES <img src="assets/images/award.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </section>
        <!------ Client testimonials end ------->


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
                            <p>Cell: (604) 803-0012 <br />Office: (604) 947-9738 <br />Email: btlivingbowen@gmail.com</p>
                            <p>Address:<br>1575 Marine Drive, West Vancouver, BC V7V 1H9 CA</p>
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
        <script src="assets/js/owl.carousel.min.js"></script>
        <script type="text/javascript">
          $('#Slider').owlCarousel({
              loop: true,
              autoplay: 3000,
              smartSpeed: 1000,
              animateOut: 'fadeOut',
              animateIn: 'fadeIn',
              margin: 0,
              nav: false,
              dots: false,
              responsive: {
                  0: {
                      items: 1
                  },
                  600: {
                      items: 1
                  },
                  1000: {
                      items: 1
                  }
              }
          })
          $(document).ready(function() {
            $(window).scroll(function() {
              var scroll = $(window).scrollTop();
              if (scroll >= 50) {
                $(".susan-header-area").addClass("shauna-header-change");
              } else {
                $(".susan-header-area").removeClass("shauna-header-change");
              }
            });
            $(window).on('load', function(){
              var scroll = setInterval(bannerScroll, 3000);
              var ijk = 2;
              function bannerScroll() {
                $(".changeClass").addClass("to_hide");
                setTimeout(function() {
                  if (ijk == 2) {
                    $(".changeClass").removeClass("banner8");
                  } else if (ijk > 2) {
                    var xyz = ijk - 1;
                    $(".changeClass").removeClass("banner" + xyz);
                  }
                  $(".changeClass").removeClass("to_hide");
                  $(".changeClass").addClass("banner" + ijk);
                  ijk++;
                  if (ijk == 9) {
                    ijk = 2;
                  }
                }, 600);
              }
            });
          });
        </script>
    </body>
</html>
