<?php
    include('databaseconnect.php');
    require_once('webflow_Api.php');
    
    $mlsid =$_POST["mlsid"];
    $id=$_POST['ids'];
          
    $query = "INSERT INTO `soldlistings` SELECT * FROM `property` WHERE `id` = '".$id."';";
     //file_put_contents("query.txt","\n".print_r($query ,true),FILE_APPEND);
    $result = $conn->query($query);
    if($result !== false){
        $last_id = $conn->insert_id;
        echo "success</br>";
      }else {
        echo "Trasnfer failed    $conn->error";
      } 
    $query = "DELETE FROM `property` WHERE `id` = '".$id."'";
    $result = $conn->query($query);
    if($result !== false){
        echo "success</br>";
      }else {
        echo "Trasnfer failed    $conn->error";
      }
    $query = "UPDATE `soldlistings` SET `Sold`='0' WHERE `id`= '".$last_id."';";
    $result = $conn->query($query);
    if($result !== false){
        echo "success";
      }else {
        echo "Trasnfer failed    $conn->error";
      }
      
      //update in webflow mark as sold
       $update_webflow="SELECT streetaddress,Sold,webflow_Item_id from soldlistings WHERE id =". $last_id;
       $result = $conn->query($update_webflow);
       $row = $result->fetch_assoc();
        
       $Sold=$row['Sold'];
       $streetaddress=$row['streetaddress'];
       $item_id=$row['webflow_Item_id'];

       if( $Sold == 1 ){
          $Sold='false';
       }else {
          $Sold='true';
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
                      "_archived":false,
                      "slug" : "'.$Slug.'",
                      "_draft": false,                 
                      "available" : "'.$Sold.'"                 
                  }
              }';
    if(!empty($item_id)){
       $update_item= item_update('PUT',$fields,$item_id);     
       //file_put_contents('update_item.txt',print_r($update_item ,true),FILE_APPEND );       
    }        
  
?>
