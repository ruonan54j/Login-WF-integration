<?php

include('propertyclass.php');
include('databaseconnect.php');


$sql = "SELECT * FROM property";
$result = $conn->query($sql);

function make_card($property,$new){
    echo '<div class="col-sm-4">';
    if($new){
      echo "<div class='lisitngs-outer new' mlsid={$property->mlsid} >";
    }else {
      echo "<div class='lisitngs-outer' mlsid={$property->mlsid} >";
    }
    echo "<img src='{$property->image}' class='img-responsive' alt=''>";
    echo '<div style="padding: 10px;">';
    echo "<h4>{$property->streetaddress}</h4>";
    echo "<p class='listings-short-d'>{$property->addressLocality}</p>";
    echo "<p>
            <span class='istings-short-d' >{$property->beds} BD  |  {$property->bathrooms} BA  | {$property->propsize} SF</span>
            <span class='listings-price'>{$property->price}</span>
         </p>";
    echo '</div>
          </div>
    		</div>';
}
 ?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



	<title></title>

		<!-- bootstrap link -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">



	<!-- Optional theme -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">



	<!-- google font CDN -->

	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>



	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



	<!-- font-awesome script cdn -->

	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>



	<!-- css links -->

	<link rel="stylesheet" href="../css/main.css">

	<link rel="stylesheet" href="../css/listings.css">



	<!-- javascript and jquery cdn -->

	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>



	<!-- external javascript file -->

	<script src="../js/main.js"></script>

</head>


	<div class="container" style="margin-bottom: 10px;">

	<div class="row">
    <?php
    while($property = $result->fetch_object()){
        make_card($property,0);
     }

    foreach ($_GET as $key => $mlsid) {
      $mlsid = new Property($mlsid);
      $mlsid->getdata();
      make_card($mlsid,1);
    }
     ?>
	</div>

<form class="" action="commit.php" method="get">
  <input id="delete" type="text" name="delete" value="" style="display:none">
  <input id="add" type="text" name="add" value="" style="display:none">
  <input id="submit" type="submit" name="button" style="width:100%;padding:20px;background: green;">
</form>

</div> <!-- container end -->


</body>
<style media="screen">
  .remove{
    background-color : red;
  }
</style>

<script type="text/javascript">
let remove = ""
let add = ""
  $(".lisitngs-outer").click(function(){
    $(this).toggleClass("remove")
  });

  $("#submit").click(function(){
    $(".lisitngs-outer").each(function(i){
      if($(this).hasClass("remove")){
        remove +=$(this).attr("mlsid") + " "
      }else {
        if($(this).hasClass("new")){
        add +=  $(this).attr("mlsid") + " "
        }
      }
    })
    $("#add").attr("value",add)
    $("#delete").attr("value",remove)
  })

</script>
</html>
