<?php

ini_set('max_execution_time', 600);

include('databaseconnect.php');
require_once('webflow_Api.php');
require("../webflow-php/vendor/autoload.php");



$image='';
$images = [];
$imagesWF = [];

 $fileLength=$_POST['file_length'];

for ($i = 0; $i <= $fileLength; $i++){
    $fileName = str_replace(' ','',$_FILES['myfile'.$i]['name']);
  
   //file_put_contents('debug/file_Name.txt',print_r($fileName,true),FILE_APPEND );
  
  if ($fileName != ""){
    $currentDir = 'https://castlelab.properties/LoginWF_t/listings-backend/';
    $uploadDirectory = 'uploaded_images//';

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $images[] = "uploaded_images/".$fileName;
    
    $imagesWF[] = $currentDir."uploaded_images/".$fileName;

    $fileSize = $_FILES['myfile'.$i]['size'];
    $fileTmpName  = $_FILES['myfile'.$i]['tmp_name'];
    $fileType = $_FILES['myfile'.$i]['type'];
 
    // $tempExt =end(explode('.',$_FILES['myfile'.$i]['name']));
    //$fileExtension = strtolower($tempExt);
    //echo "</br>";
  
     $uploadPath =  $uploadDirectory . basename($fileName); 

     $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
     
    if ($didUpload) {
        echo ( "<script> console.log('The file " . basename($fileName) . " has been uploaded')</script>");
    } else {
        echo "An error occurred somewhere. Try again or contact the admin";
    }
  }
}

  // echo "<pre>";
  //print_r($imagesWF);
  //die;
  $floorplan=$image1=$image2=$image3=$image4=$image5=$image6=$image7=$image8=$image9=$floorplans='';

 /*if(isset($imagesWF[0])){
    $floorplan ='';
 }*/
 if(isset($imagesWF[0])){
    $image1=str_replace(' ', '%20',$imagesWF[0]);
 }
 if(isset($imagesWF[1])){
    $image2=str_replace(' ', '%20',$imagesWF[1]);
 }
 if(isset($imagesWF[2])){
    $image3=str_replace(' ', '%20',$imagesWF[2]);
 }
 if(isset($imagesWF[3])){
    $image4=str_replace(' ', '%20',$imagesWF[3]);
 }
 if(isset($imagesWF[4])){
    $image5=str_replace(' ', '%20',$imagesWF[4]);
 }
 if(isset($imagesWF[5])){
     
    $image6=str_replace(' ', '%20',$imagesWF[5]);
    
 }if(isset($imagesWF[6])){
    $image7=str_replace(' ', '%20',$imagesWF[6]);
 }
 if(isset($imagesWF[7])){
    $image8=str_replace(' ', '%20',$imagesWF[7]);
 }
 if(isset($imagesWF[8])){
    $image9=str_replace(' ', '%20',$imagesWF[8]);
 }
 /*if(isset($imagesWF[10])){
    $floorplans=str_replace(' ', '%20',$imagesWF[9]);
 }*/


  $mlsid = $_POST["mlsid"];
   $description1 = str_replace ('"'," ",$_POST["description"]);
   $description = str_replace ("'","",preg_replace('~[\r\n]+~',' ',$description1));
   
  $price = $_POST["price"];
  $streetaddr = str_replace ('"'," ",$_POST["street_address"]);
  $streetaddress = str_replace ("'"," ",$streetaddr);
  
  $postalCode = $_POST["postal_code"];
  
  
  $proptype = $_POST["building_type"];
  $province = $_POST["province"];
  $local = str_replace ('"'," ",$_POST["locality"]);
  $locality=str_replace ("'"," ",$local);
  
  $beds = $_POST["beds"];
  $bathrooms = $_POST["bathrooms"];
  $size = preg_replace('/[^0-9]/','',$_POST["size"]);

/*----------------------Date:22_04_19------------------------------------*/  

  $LotSize = str_replace ("'","",str_replace ('"',"",$_POST['LotSize']));
  $YearBuilt =str_replace ("'","",str_replace ('"',"",$_POST['YearBuilt']));
  $Brokerage = str_replace ("'","",str_replace ('"',"",$_POST['Brokerage']));

  
/*-------------------------------------------------------------*/   
  $sold = false;
  if(isset($_POST["active_sold"])){
   if($_POST["active_sold"] == true){
     $sold = true;
   }else{
       $sold = false;
   }
  }
 
  if(isset($images[0])){
  $image = $images[0];
  }
  $images =implode(",",$images);

  $query= "";
   //echo "IMAGE LIST: ".$image;
   //echo "test";
    $flag1=false;
    if ($sold == false) {     
       $query = "INSERT INTO `soldlistings` (`mlsid`, `image`, `images`, `description`, `price`, `streetaddress`, `addressLocality`, `addressProvince`, `postalCode`, `beds`, `bathrooms`, `propsize`, `proptype`, `LotSize`, `YearBuilt`, `Brokerage`, `Sold`) VALUES ('".$mlsid."', '".$image."', '".$images."', '".$description."', '".$price."', '".$streetaddress."', '".$locality."', '".$province."', '".$postalCode."', '".$beds."', '".$bathrooms."', '".$size."', '".$proptype."','".$LotSize."','".$YearBuilt."','".$Brokerage."', '0')";
    }
   else{
      $flag1=true;
      $query = "INSERT INTO `property`(`mlsid`, `image`, `images`, `description`, `price`, `streetaddress`, `addressLocality`, `addressProvince`, `postalCode`, `beds`, `bathrooms`, `propsize`, `proptype`, `LotSize`, `YearBuilt`, `Brokerage`, `Sold`) VALUES ('".$mlsid."', '".$image."', '".$images."', '".$description."', '".$price."', '".$streetaddress."', '".$locality."', '".$province."', '".$postalCode."', '".$beds."', '".$bathrooms."', '".$size."', '".$proptype."', '".$LotSize."','".$YearBuilt."','".$Brokerage."','".$sold."')";
    }
   
    $result = $conn->query($query);
    
   //====================================//
    //String json body for cms webflow
    
    if($sold == 1){
      $sold='false';
    }else{
      $sold='true';
    }
    
         $Slug='';
         $id=rand();
         $id2=rand();
         $add=$id.$streetaddress.$id2;
         $uniqe_id=substr($add,0,240);
         $Slug=preg_replace("/[^a-zA-Z0-9]+/", "", $uniqe_id);
    
    
    $fields =' {
               "fields": {
                      "name" : "'.$streetaddress.'",
                      "slug" : "'.$Slug.'",
                      "_archived":false,
                      "_draft": false,
                      "neighbourhood" : "'.$locality.'",
                      "postal-code" : "'.$postalCode.'",
                      "sale-price" : "'.$price.'",
                      "mls-id" : "'.$mlsid.'",
                      "property-type" : "'.$proptype.'",
                      "number-of-rooms" : "'.$beds.'",
                      "number-of-baths" : "'.$bathrooms.'",
                      "square-feet" : "'.$size.'",
                      "year-built" : "'.$YearBuilt.'",
                      "lot-size" : "'.$LotSize.'",
                      "agent-contact-info" : "'.$Brokerage.'",
                      "property-description" : "'.$description.'",
                      "available" : "'.$sold.'",
                      "floorplan" : "'.$floorplan.'",
                      "image-1" : "'.$image1.'",
                      "image-2" : "'.$image2.'",
                      "image-3" : "'.$image3.'",
                      "image-4" : "'.$image4.'",
                      "image-5" : "'.$image5.'",
                      "image-6" : "'.$image6.'",
                      "image-7" : "'.$image7.'",
                      "image-8" : "'.$image8.'",
                      "image-9" : "'.$image9.'",
                      "floorplans" : "'.$floorplans.'"
                  }
              }';
              
            file_put_contents('debug/fields.txt',print_r($fields,true),FILE_APPEND );
    //=====================================//
   if($result !== false) {
        $last_id = $conn->insert_id;
       //call insert item in cms webflow api file
        $get_item = item_insert('POST',$fields);

        $error_mes='';
        if(isset($get_item['msg'])) {
         $error_mes=$get_item['msg'];
        }

        if($error_mes !='') {
          ?>

           <script type='text/javascript'>
            alert('Transfer failed : please contact technical support');       
             window.location='loggedin.php';  
           </script>

        <?php

          } elseif ($flag1==true) {        
          $update="UPDATE `property` SET `webflow_Item_id`='".$get_item['_id']."',`webflow_status`='".true."' WHERE id=".$last_id;
          $update_result = $conn->query($update);  
          } else{

            $update="UPDATE `soldlistings` SET `webflow_Item_id`='".$get_item['_id']."',`webflow_status`='".true."' WHERE id=".$last_id;
            $update_result = $conn->query($update); 
          }  

      if($flag1==true) {
        ?>

          <script type='text/javascript'>
            alert('Transfer Successful : Active Property');
             window.location='loggedin.php'
           </script>';

      <?php   

      }else {

      ?>
      
         <script type='text/javascript'>
            alert('Transfer Successful : Sold Property');
            window.location='loggedin.php';
           </script>
       
      <?php     
      }        
    } 
?>