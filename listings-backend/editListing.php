<?php

include('databaseconnect.php');

require("../webflow-php/vendor/autoload.php");

require_once('webflow_Api.php');

//file_put_contents('debug/i_POST.txt',print_r($_POST,true),FILE_APPEND );

    foreach ($_POST as $key => $value) {
         $post_data="Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
    }

    $images = [];
    $TempImages = [];
    $imagesWF = [];
    $tempImages = [];
    $fileLength=$_POST['edit_file_length'];
    $Images = $_POST['image_array'];
    $didUpload='';
    
    if($Images != ''){
    $ImagesArray = explode(",",$Images);

    foreach($ImagesArray as $EachImagesArray){
        $fileName = $EachImagesArray;
        // file_put_contents('debug/fileName3.txt',print_r($fileName,true),FILE_APPEND );
        if($fileName != ""){
            $currentDir = 'https://castlelab.properties/LoginWF_t/listings-backend/';
            //$uploadDirectory = "uploaded_images/";
            $errors = []; // Store all foreseen and unforseen errors here
            $images[] = $fileName;
           // $imagesWF[] = $currentDir."uploaded_images/".$fileName;
            $tempImages[] =  $currentDir.$fileName;
            //$uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
            $uploadPath =  basename($fileName); 
            
            if ($didUpload) {
             //   echo "The file " . basename($fileName) . " has been uploaded";
            } else {
              //  echo "An error occurred somewhere. Try again or contact the admin";
            }
        }
    }
    //
    if($_FILES['myfile0']['name'] != ''){
        for ($i = 0; $i <= $fileLength; $i++) {
             $fileName =str_replace(' ','',$_FILES['myfile'.$i]['name']);
               //file_put_contents('debug/fileName1.txt',print_r($fileName,true),FILE_APPEND );
            if($fileName != "") {
                $currentDir = 'https://castlelab.properties/LoginWF_t/listings-backend/';
                $uploadDirectory = "uploaded_images/";
                $errors = []; // Store all foreseen and unforseen errors here
                $images[] = "uploaded_images/".$fileName;
                $fileSize = $_FILES['myfile'.$i]['size'];
                $fileTmpName  = $_FILES['myfile'.$i]['tmp_name'];
                $fileType = $_FILES['myfile'.$i]['type'];
                $imagesWF[] = $currentDir."uploaded_images/".$fileName;
                //$uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
                $uploadPath =  $uploadDirectory . basename($fileName); 
               // echo $uploadPath;
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        
                if ($didUpload) {
                 //   echo "The file " . basename($fileName) . " has been uploaded";
                } else {
                  //  echo "An error occurred somewhere. Try again or contact the admin";
                }
            }
        }
    }
    }else if($Images == '') {
        if($_FILES['myfile0']['name'] != '') {
            for ($i = 0; $i <= $fileLength; $i++) {
                $fileName = str_replace(' ','',$_FILES['myfile'.$i]['name']);
                     //file_put_contents('debug/fileName2.txt',print_r($fileName,true),FILE_APPEND );
                if($fileName != "") {
                    $currentDir = 'https://castlelab.properties/LoginWF_t/listings-backend/';
                    $uploadDirectory = "uploaded_images/";
                    $errors = []; // Store all foreseen and unforseen errors here
                    $images[] = "uploaded_images/".$fileName;
                    $fileSize = $_FILES['myfile'.$i]['size'];
                    $fileTmpName  = $_FILES['myfile'.$i]['tmp_name'];
                    $fileType = $_FILES['myfile'.$i]['type'];
                    $imagesWF[] = $currentDir."uploaded_images/".$fileName;
                    //$uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
                    $uploadPath =  $uploadDirectory . basename($fileName); 
                   // echo $uploadPath;
                    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            
                    if($didUpload) {
                     //   echo "The file " . basename($fileName) . " has been uploaded";
                    } else {
                      //  echo "An error occurred somewhere. Try again or contact the admin";
                    }
                }
            }
       }
    }
    
        $imagesWFF = array_merge($imagesWF,$tempImages);
      
        /*=====================================*/
        $Slug='';
        $item_id='';
  
        $floorplan=$image1=$image2=$image3=$image4=$image5=$image6=$image7=$image8=$image9=$floorplans='';
     
        if(isset($_POST['items_id'])){
            $item_id=$_POST['items_id'];
        }
        $l_type=$_POST['L_type'];
        $streetaddrr=$_POST['streetaddrr'];
        $l_id=$_POST["lids"];
        $mlsid = $_POST["mlsid"];
        $description =str_replace ("'","",str_replace ('"',"",$_POST["description"]));
        $price = $_POST["price"];
        $proptype = $_POST["building_type"];
        $beds = preg_replace('/[^0-9]/','',$_POST["beds"]);
        $bathrooms = preg_replace('/[^0-9]/','',$_POST["bathrooms"]);
        $size = preg_replace('/[^0-9]/','',$_POST["size"]); 
        
      /*================================================*/    
    
        $LotSize=str_replace ("'","",str_replace ('"',"",$_POST["LotSize"])); 
        $YearBuilt=str_replace ("'","",str_replace ('"',"",$_POST["YearBuilt"])); 
        $Brokerage=str_replace ("'","",str_replace ('"',"",$_POST["Brokerage"])); 
        
      /*=============================================*/
         $Slug='';
         $id=rand();
         $id2=rand();
         $add=$id.$streetaddrr.$id2;
         $uniqe_id=substr($add,0,240);
         $Slug=preg_replace("/[^a-zA-Z0-9]+/", "", $uniqe_id);
  
  
     $fields='';
        $fields .=' {
               "fields": {
                      "name" : "'.$streetaddrr.'",
                      "slug" : "'.$Slug.'",
                      "_archived":false,
                      "_draft": false,           
                      "sale-price" : "'.$price.'",
                      "property-type" : "'.$proptype.'",
                      "number-of-rooms" : "'.$beds.'",
                      "number-of-baths" : "'.$bathrooms.'",
                      "square-feet" : "'.$size.'",
                      "year-built" : "'.$YearBuilt.'",
                      "lot-size" : "'.$LotSize.'",
                      "agent-contact-info" : "'.$Brokerage.'",
                      "property-description" : "'.$description.'",';
 
    $needle = "https://assets";
    $replace='https://castlelab.properties/LoginWF_t/listings-backend/';
    
   /* if(isset($imagesWFF[0])){
        
         $floorplan = $imagesWFF[0];
        
        if (strpos($floorplan, $needle) !== false) {
         $floorplan=str_replace($replace,'', $floorplan);
        }
        
         $fields.='"floorplan" : "'.str_replace(' ', '%20',$floorplan).'",';
    
    }else{*/
      $fields.='"floorplan" :"",';
    //} 
    
     if(isset($imagesWFF[0])){
        $image1=$imagesWFF[0];
        
        if (strpos($image1, $needle) !== false) {
         $image1=str_replace($replace,'', $image1);
        }
        
        $fields.='"image-1" : "'.str_replace(' ', '%20',$image1).'",';
     }else{
          $fields.='"image-1" :"",';
     }
     
     if(isset($imagesWFF[1])){
        $image2=$imagesWFF[1];
        
         if (strpos($image2, $needle) !== false) {
         $image2=str_replace($replace,'', $image2);
        }
        
        $fields.='"image-2" : "'.str_replace(' ', '%20',$image2).'",';
     }else{
          $fields.='"image-2" :"",';
     }
     if(isset($imagesWFF[2])){
        $image3=$imagesWFF[2];
        
         if (strpos($image3, $needle) !== false) {
         $image3=str_replace($replace,'', $image3);
        }
        
        $fields.='"image-3" : "'.str_replace(' ', '%20',$image3).'",';
     }else{
          $fields.='"image-3" :"",';
     }
     if(isset($imagesWFF[3])){
        $image4=$imagesWFF[3];
        
         if (strpos($image4, $needle) !== false) {
         $image4=str_replace($replace,'', $image4);
        }
        $fields.='"image-4" : "'.str_replace(' ', '%20',$image4).'",';
        
     }else{
          $fields.='"image-4" :"",';
     }
     if(isset($imagesWFF[4])){
        $image5=$imagesWFF[4];
        
            if (strpos($image5, $needle) !== false) {
               $image5=str_replace($replace,'', $image5);
            }
        
        $fields.='"image-5" : "'.str_replace(' ', '%20',$image5).'",';
     }else{
          $fields.='"image-5" :"",';
     }
     if(isset($imagesWFF[5])){
        $image6=$imagesWFF[5];
        
            if (strpos($image6, $needle) !== false) {
              $image6=str_replace($replace,'', $image6);
            }
        $fields.='"image-6" : "'.str_replace(' ', '%20',$image6).'",';
        
     }else{
         
          $fields.='"image-6" :"",';
     }
     if(isset($imagesWFF[6])){
        $image7=$imagesWFF[6];
        
            if (strpos($image7, $needle) !== false) {
               $image7=str_replace($replace,'', $image7);
            }
        
        $fields.='"image-7" : "'.str_replace(' ', '%20',$image7).'",';
     }else{
          $fields.='"image-7" :"",';
     }
     if(isset($imagesWFF[7])){
        $image8=$imagesWFF[7];
        
            if (strpos($image8, $needle) !== false) {
               $image8=str_replace($replace,'', $image8);
            }
        
        $fields.='"image-8" : "'.str_replace(' ', '%20',$image8).'",';
    }else{
          $fields.='"image-8" :"",';
     }
     if(isset($imagesWFF[8])){
        $image9=$imagesWFF[8];
        
            if (strpos($image9, $needle) !== false) {
                $image9=str_replace($replace,'', $image9);
            }
        
        $fields.='"image-9" : "'.str_replace(' ', '%20',$image9).'",';
     }else{
          $fields.='"image-9" :"",';
     }
     
 /*    if(isset($imagesWFF[9])){
        $floorplans=$imagesWFF[9];
        
            if (strpos($floorplans, $needle) !== false) {
               $floorplans=str_replace($replace,'', $floorplans);
            }
        
        $fields.='"floorplans" : "'.str_replace(' ', '%20',$floorplans).'",';
     }else{*/
          $fields.='"floorplans" :"",';
    // }
       $body=rtrim($fields,",");
       $body.=  '}
                 }';    


       //file_put_contents('debug/body.txt',print_r($body,true),FILE_APPEND );
   /*=======================================*/
      $imageString = $_POST["image_array"]; 
      $imageArr = explode(',', $imageString);  
      $query= "";
      $imgArr_total = [];
 
      $imgArr_total = array_merge($imageArr, $images);
      $imageString = implode(",", $imagesWFF);
      $imageString = rtrim($imageString,",");
      $imageString = ltrim($imageString,",");
      $imageString = str_replace("https://castlelab.properties/LoginWF_t/listings-backend/", "",$imageString);
      $imageString2 = explode(",", $imageString);
      $image = $imageString2[0];

      //die;
      
      // echo "string: ".$imageString;

      /*$query = "UPDATE `soldlistings` SET `image`= '".$image."',`images`= '".$imageString."',`description`='".$description."',`price`='".$price."',`beds`='".$beds."',`bathrooms`='".$bathrooms."',`propsize`='".$size."',`proptype`='".$proptype."' WHERE `mlsid`= '".$mlsid."';";
        $result = $conn->query($query);
        if($result !== false){
          echo "success";
        }else {
          echo "Trasnfer failed    $conn->error";
        }
    	echo "IMAGE LIST:  {$imageString}";
        echo "<br> desc:  {$description}";*/
      //update in webflow using api
    
      //session_start();
      // $webflowAPI ="Bearer".' '.$_SESSION['webflow_api'];
     
    $flage=false;
    if($l_type == 'sold'){
      $flage=true;    
      $query = "UPDATE `soldlistings` SET `image`= '".$image."',`images`= '".$imageString."',`description`='".$description."',`price`='".$price."',`beds`='".$beds."',`bathrooms`='".$bathrooms."',`propsize`='".$size."',`proptype`='".$proptype."',`LotSize`='".$LotSize."',`YearBuilt`='".$YearBuilt."',`Brokerage`='".$Brokerage."' WHERE `id`= '".$l_id."'";
      //file_put_contents('debug/Sold_query.txt',print_r($query,true),FILE_APPEND );
    }else {
      $query = "UPDATE `property` SET `image`='".$image."',`images`= '".$imageString."',`description`='".$description."',`price`='".$price."',`beds`='".$beds."',`bathrooms`='".$bathrooms."',`propsize`='".$size."',`proptype`='".$proptype."',`LotSize`='".$LotSize."',`YearBuilt`='".$YearBuilt."',`Brokerage`='".$Brokerage."'  WHERE `id`= '".$l_id."'";
      //file_put_contents('debug/property_query.txt',print_r($query,true),FILE_APPEND );
        
    }
   
    $result = $conn->query($query);
    if($result !== false) {
        
        //edit item update in webflow cms
        if($item_id !='' && $item_id != NULL){
         
        $update_item= item_update('PUT',$body,$item_id);
        
        echo "<script type='text/javascript'>alert('Success, Listing Updated Successfully');
             window.location='loggedin.php';
           </script>";
           
        } else {
            
            $item_idss='';
            $get_item = ag_item_insert('POST',$body);
            
            $item_idss=$get_item['_id'];
            
            if($flage==true) {
                //echo "=======if=======";
                  $query_sold ="UPDATE `soldlistings` SET `webflow_Item_id`='".$item_idss."',`webflow_status`='".true."' WHERE `id`= '".$l_id."'";  
                  $results = $conn->query($query_sold);
            } else{
                //echo "=======else=======";
                  $query_pro ="UPDATE `property` SET `webflow_Item_id`='".$item_idss."',`webflow_status`='".true."' WHERE `id`= '".$l_id."'";   
               
                  $resultss = $conn->query($query_pro);
            }
            
            // die;
        echo "<script type='text/javascript'>alert('Success, Not Found In Webflow, Inserted Successfully');
             window.location='loggedin.php';
           </script>";
        }
       echo "<script type='text/javascript'>
             window.location='loggedin.php';
           </script>";
      exit;
    } else {
     // echo "Trasnfer failed    $conn->error";
      echo "<script type='text/javascript'>
      alert('Trasnfer failed, Listing Not Added');    
       window.location='loggedin.php';
      </script>";
    }
    	echo "IMAGE LIST:  {$imageString}";
      echo "<br> desc:  {$description}";
?>