<?php
    include('./databaseconnect.php');
    include("../webflow-php/vendor/autoload.php");

    $address =$_POST["address"];
    echo $address;
    session_start();
    echo "sess";
    $con = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
    

    $query = "DELETE FROM `property` WHERE `streetaddress` = '".$address."';";
    $result = $conn->query($query);
    if($result !== false){
        echo "success";
       
      }else {
        echo "Trasnfer failed    $conn->error";
      }
        
  

     
    $query = "DELETE FROM `soldlistings` WHERE `streetaddress` = '".$address."';";
    $result = $conn->query($query);
    if($result !== false){
        echo "success";        
      }
      else {
        echo "Trasnfer failed    $conn->error";
      }



      $webflowAPI = $_SESSION['webflow_api'];
      //echo $webflowAPI."\n yay \n";
      
      $webflow = new \Webflow\Api($webflowAPI);
      $sites = $webflow->sites();
      //echo $sites[0]->_id;
    
  
  
      $findField=['name'=> $address];
      //echo $findField['name'];
      
      $collections = $webflow->collections($sites[0]->_id);
      $collectionID = 0;

      foreach( $collections as $value ) {
        if ($value->name == "Featured Listings"){
          $collectionID = $value->_id;
          echo("<script>console.log('found feat listing: ".$collectionID."');</script>");
        }
      }

      $itemID[] = $webflow->findOrCreateItemByName($collectionID,$findField);
      
      echo "here\n".$itemID[0]->_id."\n gsfdf".$itemID[0]->name;
      $webflow->removeItem($collectionID, $itemID[0]->_id);  
  
      
      echo "<script type='text/javascript'>alert('Success, Listing removed');
      window.location='loggedin.php';
      </script>";
   
?>