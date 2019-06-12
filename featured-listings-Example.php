<?php
include("listings-backend/databaseconnect.php");


$sql = "SELECT * FROM property";
$result = $conn->query($sql);

function make_card($property){
    $description = htmlspecialchars($property->description,ENT_QUOTES);
    echo '<div class="col-sm-4">';
    echo "<a href = /listing-view.php?mlsid={$property->mlsid} style='text-decoration: none; color:#333'>";
    echo "<div class='lisitngs-outer' mlsid='{$property->mlsid}' images='{$property->images}' overview='Address: {$property->streetaddress}  Price: {$property->price}  Postal Code: {$property->postalCode}  Building Type: {$property->proptype}  Beds: {$property->beds}  Bathrooms: {$property->bathrooms}  Size: {$property->propsize}  {$property->mlsid}' description='{$description}'>";
    echo "<img src='{$property->image}' class='img-responsive' style='width:100%' alt=''>";
    echo '<div style="padding: 10px;">';
    echo "<h4>{$property->streetaddress}</h4>";
    echo "<p class='listings-short-d'>{$property->addressLocality}</p>";
    echo "<p>
            <span class='istings-short-d' >{$property->beds} BD  |  {$property->bathrooms} BA  | {$property->propsize} SF</span>
            <span class='listings-price'>{$property->price}</span>
         </p>";
    echo '</div>
          </div>
          </a>
    		</div>';
}

 ?>
<!DOCTYPE html>
<html>



<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Listings</title>
	<meta name="description" content="">
	<link href="assets/behnoushicon.png" rel="icon" type="image/png" /><meta name="keywords" content="best real estate agent, best real estate agents, best realtor, estate agent, estate agents, finding a realtor, how to find a real estate broker, real estate agent, real estate agencies, real estate agents, real estate broker, realtor, realtor vancouver, top real estate agents, real estate agent listings, find a realtor">
	<link href="styles.css" rel="stylesheet" /><script src="https://use.fontawesome.com/a105812224.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script><script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

	<!-- Start of Async Drift Code -->

	<!-- Start of Async Drift Code -->

	<style media="screen">
		 	.mls{
		 		width: 100% !important;
		 		height:3500px;
		 	}
	</style>

	<script>
		   function resizeIframe(obj) {
		     obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		   }
	</script>
	<!-- Start of Async Drift Code -->
<script>
!function() {
  var t;
  if (t = window.driftt = window.drift = window.driftt || [], !t.init) return t.invoked ? void (window.console && console.error && console.error("Drift snippet included twice.")) : (t.invoked = !0,
  t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ],
  t.factory = function(e) {
    return function() {
      var n;
      return n = Array.prototype.slice.call(arguments), n.unshift(e), t.push(n), t;
    };
  }, t.methods.forEach(function(e) {
    t[e] = t.factory(e);
  }), t.load = function(t) {
    var e, n, o, i;
    e = 3e5, i = Math.ceil(new Date() / e) * e, o = document.createElement("script"),
    o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + i + "/" + t + ".js",
    n = document.getElementsByTagName("script")[0], n.parentNode.insertBefore(o, n);
  });
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('bucm2pivdf7a');
</script>
<!-- End of Async Drift Code -->

</head>
<body>
	<a href="https://www.instagram.com/behnoushmalek/"><img style="float:right;height:30px; margin:5px 5px 0px 0px" src="assets/inst.png" alt=""> </a>
	<a href="https://www.facebook.com/behnoushmalek/"><img style="float:right;height:30px;margin:5px 5px 0px 0px "  src="assets/face.png" alt=""> </a>
	<a href="#"><img style="float:right;height:30px; margin:5px 5px 0px 0px" src="assets/pint.png" alt=""> </a>
	<a href="mailto:b@behnoushmalek.com?Subject=Hello"><img style="float:right;height:30px;margin:5px 5px 0px 0px "  src="assets/mail.png" alt=""> </a>
	<p><a href=""><img style="clear:right" id="logoasset" src="assets/logobehnoushrealestate.png" /></a></p>

	<div id="menuholder">
	<div id="sticky-anchor"></div>

	<ul id="menu">
		<li><a href="index.php" >HOME</a></li>
		<li>
			<span class="dropdown " >
				<a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					HELLO
				</a>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="vip-sign/">News Letter</a>
				<a class="dropdown-item" href="meet-behnoush/">Meet Behnoush</a>
				<a class="dropdown-item" href="contact/">Connect</a>
			</div>
		</span>
		</li>
		<li>
			<span class="dropdown ">
	  		<a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    		LISTINGS
	  		</a>
	  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	    	<a class="dropdown-item" href="listings">Office</a>
				<a class="dropdown-item" href="featured-listings.php">Featured</a>
	  	</div>
		</span>
		</li>
		<!-- <li><a href="listings">LISTINGS</a></li> -->
		<li>
			<span class="dropdown ">
				<a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					RESOURCES
				</a>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="services/">Services</a>
				<a class="dropdown-item" href="resources/">Advice</a>
			</div>
		</span>
		</li>
		<li><a href="">BM DESIGN </a></li>
	</ul>
	</div>

<body>
<style media="screen">
.lisitngs-outer {
	border: 1px solid #E7DBDB;
	margin-bottom: 30px;
	box-shadow: 10px 10px 30px #E8DCDC;
}

</style>

<div class="container" style="padding-top:50px">
	<div class="row">
		<?php
		for($i=0;$property = $result->fetch_object();$i++) {
					make_card($property);
				}
		?>
	</div>
</div>






<div id="footer">
<table>
	<tbody>
		<tr>
			<td>
			<a href=""><img id="logoasset_footer" src="assets/logobehnoushrealestate.png" /></a></td>
			<td>

			<!--<div id="map" style="width:90%; height:150px">My map will go here</div>
              <script>
              function myMap() {
                  var mapOptions = {
                      center: new google.maps.LatLng(49.283396, -123.126118),
                      zoom: 10,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
              var map = new google.maps.Map(document.getElementById("map"), mapOptions);
              }
              </script>
              <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8r9Zw1JD0rJqRnWjFjeYPF3eTWzJgIfE&callback=myMap"></script>--></td>
			<td>
				<td>
				<p id="address"><a href="tel:+16048806821">604.880.6821</a><br />
				<a href="mailto:b@behnoushmalek.com">b@behnoushmalek.com</a><br />
				<a href="https://www.google.ca/maps/search/109+-+850+Harbourside+Drive,+North+Vancouver,+BC+V7P+3T7/@49.3148736,-123.097225,19z">#109 - 850 Harbourside Drive, <p>North Vancouver, BC V7P 3T7</p></a><br />
				<br />
				<a href="http://www.Castle.ca" id=""> Made with <font color="">❤</font> by
					<font color="#6771E5"></font><a href="https://Castle.ca/">Castle</a></a></p>
		</tr>
	</tbody>
</table>
</div>
</body>
<script>
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#menu').addClass('stick');
        $('#menuholder').addClass('stickpadding');
    } else {
        $('#menu').removeClass('stick');
        $('#menuholder').removeClass('stickpadding');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script></html>
