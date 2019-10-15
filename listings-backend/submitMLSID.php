<?php
    include('propertyclass.php');
    
    include('databaseconnect.php');
    
    require_once('webflow_Api.php');
    
    require("../webflow-php/vendor/autoload.php");

    echo "<script>console.log('hi')</script>";
    echo "<script>console.log( 'Debug Objects: ".$webflowAPI . $sub_domain ."');</script>";
    
    $mlsid1 = $_POST["mlsid1"];
    $mlsid2 = $_POST["mlsid2"];
    $mlsid3 = $_POST["mlsid3"];
    $mlsid4 = $_POST["mlsid4"];
    $mlsid5 = $_POST["mlsid5"];
    $mlsid6 = $_POST["mlsid6"];
    
    $property1 = null;
    $property2 = null;
    $property3 = null;
    $property4 = null;
    $property5 = null;
    $property6 = null;

function push_to_webflow($property) {
    
    file_put_contents('debug/property.txt',print_r($property,true),FILE_APPEND );
    
  for ($x = 0; $x < 9; $x++) {
   
    $imgStr = $property->images[$x];
    $imgSplit = explode("?", $imgStr);
    $property->images[$x] = $imgSplit[0];
    
  }

  //$con = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
 
  /*session_start();
  $webflowAPI = $_SESSION['webflow_api'];
  $webflow = new \Webflow\Api($webflowAPI);
  $sites = $webflow->sites();
  echo("<script>console.log('PHP: ".$sites[0]->_id."');</script>");
  echo("<script>console.log('PHP name: ".$sites[0]->name."');</script>");
  $collections = $webflow->collections($sites[0]->_id);
  echo("<script>console.log('collections: ".$collections[2]->_id."');</script>");
  echo("<script>console.log('mame: ".$collections[2]->name."');</script>");
  $collectionID = 0;
  foreach( $collections as $value ) {
    if ($value->name == "Featured Listings"){
      $collectionID = $value->_id;
      echo("<script>console.log('found feat listing: ".$collectionID."');</script>");
    }
  }*/
  
  $type="POST";
  
  /*$fields = [
      'name' => $property->streetaddress,
      'neighbourhood' => $property->addressLocality,
      'postal-code' => $property->postalCode,
      'sale-price' => $property->price,
      'mls-id' => $property->mlsid,
      'property-type' => $property->proptype,
      'number-of-rooms' => $property->beds,
      'number-of-baths' => $property->bathrooms,
      'square-feet' => $property->propsize,
      'property-description' => $property->description,
      'image-1' => $property->images[0],
      'image-2' => $property->images[1],
      'image-3' => $property->images[2],
      'image-4' => $property->images[3],
      'image-5' => $property->images[4],
      'image-6' => $property->images[5],
      'image-7' => $property->images[6],
      'image-8' => $property->images[7],
      'image-9' => $property->images[8]
  ];*/
         $Slug='';
         $id=rand();
         $id2=rand();
         $add=$id.$property->streetaddress.$id2;
         $uniqe_id=substr($add,0,240);
         $Slug=preg_replace("/[^a-zA-Z0-9]+/", "", $uniqe_id);
     
      $prop_type='';
      $proptype='';
      $prop_type=str_replace(' ','',strtolower($property->proptype));
      
     // file_put_contents('debug/prop_type.txt',print_r($prop_type,true),FILE_APPEND );
      
      $property_type = array("duplex","house","apartment","manufacturedhome","mobilehome","recreational","lot","townhouse","apt/condo");
      if(in_array($prop_type, $property_type)) {
          $proptype=$property->proptype;
      }else {
          $Not_found='Property type '.$property->proptype.' not found in webflow';
          echo '<script type="text/javascript">alert("'.$Not_found.'");
             </script>';
      }
    
     $description=str_replace('"', '',$property->description);
  
      $fields='{
               "fields": {
			      "name" : "'. $property->streetaddress.'",
			      "slug" : "'.$Slug.'",
			      "_archived":false,
                  "_draft": false,
				  "neighbourhood" : "'.$property->addressLocality.'",
				  "postal-code" : "'.$property->postalCode.'",
				  "sale-price" : "'.$property->price.'",
				  "mls-id" : "'.$property->mlsid.'",
				  "property-type" : "'.$proptype.'",
				  "number-of-rooms" : "'.$property->beds.'",
				  "number-of-baths" : "'.$property->bathrooms.'",
				  "square-feet" : "'.$property->propsize.'",
				  "year-built" : "'.$property->Year_Built.'",
                  "lot-size" : "'.$property->Lot_Size.'",
                  "agent-contact-info" : "'.$property->Brokerage.'",
				  "property-description" : "'.$description.'",
				  "image-1" : "'.$property->images[0].'",
				  "image-2" : "'.$property->images[1].'",
				  "image-3" : "'.$property->images[2].'",
				  "image-4" : "'.$property->images[3].'",
				  "image-5" : "'.$property->images[4].'",
				  "image-6" : "'.$property->images[5].'",
				  "image-7" : "'.$property->images[6].'",
				  "image-8" : "'.$property->images[7].'",
				  "image-9" : "'.$property->images[8].'"			   			  			 
			   }
           }';
    
           $webflow_call = item_insert($type,$fields);
           if(isset($webflow_call[_id])){
           return $webflow_call[_id];
           }
   //$webflow->createItem($collectionID, $fields);
}


if($mlsid1 != "") {
    
    $property1 = new Property($mlsid1);
    echo "<script type='text/javascript'>console.log('here');
    </script>";
    $property1->getdata();
    echo "<script type='text/javascript'>console.log('here2');
    </script>";
    console.log($property1);
    $property_id=push_to_webflow($property1);
    
    $property1->setwfPropertyId($property_id);
    
    $ret = $property1->push();
    
    if (!$ret) {
        
      echo "<script type='text/javascript'>alert('FAILED, Listing can not be added');
            window.location='loggedin.php';
            </script>";
      exit;
    }
}

if($mlsid2 != ""){
    $property2 = new Property($mlsid2);
    $property2->getdata();
    
    $property_id=push_to_webflow($property2);
    
    $property2->setwfPropertyId($property_id);
     
    $ret = $property2->push();
   
    if (!$ret){
        echo "<script type='text/javascript'>alert('FAILED, Listing can not be added');
              window.location='loggedin.php';
              </script>";
        exit;
    }
}

if($mlsid3 != ""){
    $property3 = new Property($mlsid3);
    $property3->getdata();
    
    $property_id= push_to_webflow($property3);
   
    $property3->setwfPropertyId($property_id);
   
    $ret = $property3->push();
   
    if (!$ret){
        echo "<script type='text/javascript'>alert('FAILED, Listing can not be added');
              window.location='loggedin.php';
              </script>";
        exit;
    }
}

if($mlsid4 != ""){
    $property4 = new Property($mlsid4);
    $property4->getdata();
    
    $property_id=push_to_webflow($property4);
    
    $property4->setwfPropertyId($property_id);
    
    $ret = $property4->push();
   
    if (!$ret){
      echo "<script type='text/javascript'>alert('FAILED, Listing can not be added');
            window.location='loggedin.php';
            </script>";
        exit;
    }
}

if($mlsid5 != ""){

    $property5 = new Property($mlsid5);
    $property5->getdata();
    
    $property_id=push_to_webflow($property5);
    
    $property5->setwfPropertyId($property_id);
    
    $ret = $property5->push();
   
    if (!$ret){
      echo "<script type='text/javascript'>alert('FAILED, Listing can not be added');
            window.location='loggedin.php';
            </script>";
      exit;
    }
}
if($mlsid6 != "") {
    
    $property6 = new Property($mlsid6);
    $property6->getdata();
    
    $property_id=push_to_webflow($property6);
    
    $property6->setwfPropertyId($property_id);
    
    $ret = $property6->push();
    if (!$ret) {
      echo "<script type='text/javascript'>alert('FAILED, Listing can not be added');
            window.location='loggedin.php';
            </script>";
      exit;
    }
}

  echo "<script type='text/javascript'>alert('Success, Listings added');
        window.location='loggedin.php';
        </script>";



?>
