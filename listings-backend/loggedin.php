<?php

include('propertyclass.php');
include('databaseconnect.php');

$sql = "SELECT * FROM property";
$result = $conn->query($sql);

function make_card($property,$new,$selling, $sold = 0) {
    //echo "===========================";
    $Item_id=$property->webflow_Item_id;
    $mlsid = $property->mlsid;

    $jsonImg = json_encode($property->images);
    $jsonImg = str_replace("\"", "", $jsonImg);
    $jsonImg = str_replace("'", "", $jsonImg);

    $description = $property->description;
    $description = str_replace("\"", "", $description);
    $description = str_replace("'", "", $description);
    $description = str_replace("\n", "", $description);

    $input ="'".$property->mlsid."', '".$jsonImg."', '".$description."', '".$property->price."', '".$property->streetaddress."', '".$property->addressLocality."', '".$property->beds."', '".$property->bathrooms."', '".$property->propsize."', '".$property->proptype."', '".$property->LotSize."', '".$property->YearBuilt."', '".$property->Brokerage."'";

    echo '<div class="col-sm-4 listing">';
   //file_put_contents("debug/streetaddress.txt","\n".print_r($property->streetaddress ,true),FILE_APPEND);
    
    if($selling) { 
        echo "<div class='row options-btn'>
        <button class='options-select-btn' onClick=\"remove('".$property->streetaddress."','".$property->id."','sold')\">Remove</button>

        <button class='options-select-btn' onClick=\"edit('".$property->mlsid."', '".$jsonImg."', '".$description."', '".$property->price."', '".$property->streetaddress."', '".$property->addressLocality."', '".$property->beds."', '".$property->bathrooms."', '".$property->propsize."', '".$property->proptype."', '".$property->id."','".$Item_id."','sold', '".$property->LotSize."', '".$property->YearBuilt."', '".$property->Brokerage."')\">Edit</button>

        <button class='options-select-btn' onClick=\"markActive('".$mlsid."','".$property->id."')\">Active</button>

      </div>";
    }else {
        
        echo "<div class='row options-btn'>
        <button class='options-select-btn' onClick=\"remove('".$property->streetaddress."','".$property->id."','Active')\">Remove</button>

        <button class='options-select-btn' onClick=\"edit('".$property->mlsid."', '".$jsonImg."', '".$description."', '".$property->price."', '".$property->streetaddress."', '".$property->addressLocality."', '".$property->beds."', '".$property->bathrooms."', '".$property->propsize."', '".$property->proptype."','".$property->id."','".$Item_id."','active', '".$property->LotSize."', '".$property->YearBuilt."', '".$property->Brokerage."')\">Edit</button>

        <button class='options-select-btn' onClick=\"markSold('".$mlsid."','".$property->id."')\">Sold</button>

      </div>";    
    }
    
    if($new){
          if($selling){
            echo "<div class='lisitngs-outer new selling' mlsid={$property->mlsid} >";
          }else {
            echo "<div class='lisitngs-outer new' mlsid={$property->mlsid} >";
          }
    } else {
        if($selling){
            if ($sold) {
              echo "<div class='lisitngs-outer-s selling' mlsid={$property->mlsid} >";
            }else {
              echo "<div class='lisitngs-outer-s selling' mlsid={$property->mlsid} >";
            }
        }else {
            echo "<div class='lisitngs-outer' mlsid={$property->mlsid} >";
        }
    }
    //fix resolution
    $fix_img = explode("?", $property->image );
    $property->image = $fix_img[0];
        
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
    		</div>';
}
 ?>

<!DOCTYPE html>
<html lang="en">

<!--navbar-->
<div id = "side-navbar">
<ul id="ul-side">
  <h1 id="side-title">CASTLE</h1>
 
  <li class="li-side" id="sideOpt1">
    <a href="#redirectMlsid">Add Listing by MLSID</a>
    
  </li>
  <li class="li-side" id="sideOpt2">
    <a href="#redirectManual">
    Add Listing Manually
    </a>
  </li>
  <li class="li-side" id="sideOpt3">
    <a href="#redirectActive">
    Active Listings
    </a>
  </li>
  <li class="li-side" id="sideOpt4">
    <a href="#redirectSold">
    Sold Listings
    </a>
  </li>
  <li class="li-side" id="sideOpt5">
    <a href="/LoginWF_t/listings-backend/logout.php">
          Log out
        </a>
  </li>
  
</ul>
</div>

<div class="pageContent">

<div id='form-popup'></div>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Main Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="loggedin_s.css" />
    
</head>

<body>

    <div class="container">
        <div class="grey-box" id ="section1">
            <h1 class="box-title" id="redirectMlsid">Enter MLS ID#</h1>
            <form action="submitMLSID.php" method="post">
                <div class="row">
                    <input class="form-control responsive col-md-4 input-b1" type="text" name="mlsid1" placeholder="Enter listings...">

                    <input class="form-control responsive col-md-4 input-b1" type="text" name="mlsid2" placeholder="More listings...">
                </div>
                <div class="row">
                    <input class="form-control responsive col-md-4 input-b1" type="text" name="mlsid3" placeholder="More listings...">

                    <input class="form-control responsive col-md-4 input-b1" type="text" name="mlsid4" placeholder="More listings...">
                </div>
                <div class="row">
                    <input class="form-control responsive col-md-4 input-b1" type="text" name="mlsid5" placeholder="More listings...">

                    <input class="form-control responsive col-md-4 input-b1" type="text" name="mlsid6" placeholder="More listings...">
                </div>
                <input class="black-btn" type="submit" value="ADD LISTINGS">
            </form>
        </div>

        <div class="grey-box" id="section2">

            <h1 class="box-title" id="redirectManual">Manual: adding listing</h1>
           

            <form action="submitManual.php" method="post" enctype="multipart/form-data">
                
                <div id="uploadFiles">
                <input type='hidden' name='file_length' id="file_length" value='0'/> 
                Upload Images:
                <button id="newFile" type="button" class= "upload-plus-btn">+</button>
                
                <br>
                <input type="file" name="myfile0" id="fileToUpload">

                </div>

                <input id="streetaddress" class="form-control responsive col-md-12 input-b2" type="text" name="street_address"
                    placeholder="Property Street Address" value="" required>

                <div class="row">
                    <div class="col-md-6">
                        <input id="postal_code" class="form-control responsive input-b2 input-inner" type="text" name="postal_code"
                            placeholder="Postal Code" value="">
                    </div>
                    <div class="col-md-6">
                        <input id="mlsid" class="form-control responsive input-b2 input-inner" type="text" name="mlsid"
                            placeholder="MSL ID# (optional)" value="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input id="province" class="form-control responsive input-b2 input-inner" type="text" name="province"
                            placeholder="Province" value="">
                    </div>
                    <div class="col-md-6">
                        <input id="locality" class="form-control responsive input-b2 input-inner" type="text" name="locality"
                            placeholder="Locality" value="">
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-md-6">
                        <input id="price" class="form-control responsive input-b2 input-inner" type="text" name="price"
                            placeholder="Price" value="">
                    </div>
                    <div class="col-md-6">
                         <input id="size" class="form-control responsive input-b2 input-inner" type="text" name="size"
                            placeholder="Property Size (square ft)" value="">
                       
                            
                    </div>
                </div>
                  <!---------------date:22_04_2019---------------------->
               <div class="row">
                    <div class="col-md-4">
                         <input id="LotSize" class="form-control responsive input-b2 input-inner" type="text" name="LotSize"
                            placeholder="Lot Size" value="">
                    </div>
                    <div class="col-md-4">
                         <input id="YearBuilt" class="form-control responsive input-b2 input-inner" type="text" name="YearBuilt"
                            placeholder="Year Built" value="">
                    </div>
                    <div class="col-md-4">
                         <input id="Brokerage" class="form-control responsive input-b2 input-inner" type="text" name="Brokerage"
                            placeholder="Brokerage" value="">
                    </div>
                </div>
                <!----------------------------->
                <div class="row">
                    <div class="col-md-4">
                        <input id="beds" class="form-control responsive input-b2 input-inner" type="number" name="beds"
                            placeholder="Number of Beds" value="">
                    </div>
                    <div class="col-md-4">
                        <input id="bathrooms" class="form-control responsive input-b2 input-inner" type="number" name="bathrooms"
                            placeholder="Number of Bathrooms" value="">
                    </div>
                    <div class="col-md-4">
                        
                        <select id="building_type" class="form-control responsive input-b2 input-inner" type="text" name="building_type"
                            placeholder="Building Type" value="">
                           <option value="House" selected>House</option>                       
                           <option value="Duplex">Duplex</option>
                           <option value="Apartment">Apartment</option>
                           <option value="Manufactured Home">Manufactured Home</option>
                           <option value="Mobile Home">Mobile Home</option>
                           <option value="Recreational">Recreational</option>
                           <option value="Lot">Lot</option>
                           <!--<option value="Row / Townhouse">Row / Townhouse</option>-->
                           <option value="Townhouse">Townhouse</option>
                           <option value="Apt/Condo">Apt/Condo</option>
                        </select> 
                            
                    </div>
                </div>
              
                
                <textarea id="description" class="form-control responsive col-md-12" rows="4" type="text" name="description"
                    placeholder="Description" value=""></textarea>

                <div class="row toggle-div">
                    <p class="toggle-lbl">ACTIVE</p>
                    <input type="checkbox" id="switch" name="active_sold" /><label for="switch" class="labelSwitch"></label>
                    <p class="toggle-lbl">SOLD</p>
                </div>
                <br>
                <input class="black-btn" type="submit" style="width:40%" value="ADD LISTINGS">
            </form>
        </div>


        <div class="grey-box" id="section3">
            <h1 class="box-title" id="redirectActive">ACTIVE Listings on your website</h1>
            <p>Click submit to save your changes.</p>
            <div class="row">
                <?php
            while($property = $result->fetch_object()){
                make_card($property,0,0);
             }
            foreach ($_GET as $key => $mlsid) {
              $mlsid = new Property($mlsid);
              $mlsid->getdata();
              make_card($mlsid,1,0);
            }
             ?>

            </div>
            <form class="" action="commit.php" method="get">
                <input id="delete" type="text" name="delete" value="" style="display:none">
                <input id="add" type="text" name="add" value="" style="display:none">
            </form>
        </div>
        <div class="grey-box" id="section4">
            <h1 class="box-title" id="redirectSold">SOLD Listings on your website</h1>
            <p>Click submit to save your changes.</p>
            <div class="row">
                <?php
              $sql = "SELECT * FROM soldlistings";
              $result = $conn->query($sql);
              while($property = $result->fetch_object()){
                 
                    make_card($property,0,1,1);

               }

              foreach ($_GET as $key => $mlsid) {
                $mlsid = new Property($mlsid);
                $mlsid->getdata();
                make_card($mlsid,1,1);
              }
               ?>
            </div>
            <form class="" action="commit.php" method="get">
            </form>
        </div>
    </div>

    <footer style="height:100px; background:black;margin-top:50px" class="footer">
        <div class="footer-txt">
            If you don’t see a feature, then it is not available. <br>Castle is always available for any question:
            team@castlelab.ca
        </div>
    </footer>


</body>
</div>
</html>
<script type="text/javascript" src="loggedin.js"></script>
