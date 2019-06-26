<?php
    include('./databaseconnect.php');
    
    require_once('webflow_Api.php');
    
   // include("../webflow-php/vendor/autoload.php");
    
    $address=$_POST["address"];
    $row_id=$_POST["ids"];
    $type=$_POST['types'];
   // file_put_contents("post_types.txt","\n".print_r($_POST ,true),FILE_APPEND);
    $item_id='';
    
    if($type=='Active'){
   
        $get_id="select `webflow_Item_id` from `property` where `id`=".$row_id;
        $results = $conn->query($get_id);
        $row = $results->fetch_assoc();
        $item_id=$row['webflow_Item_id'];
    
        
        $query = "DELETE FROM `property` WHERE `id` = '".$row_id."'";
        $result = $conn->query($query);
        if($result !== false){
            //echo "success";
          }else {
            echo "Trasnfer failed    $conn->error";
          }
    }  
    else{
        $get_id="select `webflow_Item_id` from `soldlistings` where `id`=".$row_id;
        $results = $conn->query($get_id);
        $row = $results->fetch_assoc();
        $item_id=$row['webflow_Item_id'];
         
        $query = "DELETE FROM `soldlistings` WHERE `id` = '".$row_id."';";
        $result = $conn->query($query);
        if($result !== false) {
            //echo "success";        
          }
          else {
            //echo "Trasnfer failed    $conn->error";
          }
      }
     //file_put_contents("tem_id.txt","\n".print_r($item_id ,true),FILE_APPEND);
     if($item_id != '') {
          $delete_res=item_delete('DELETE',$item_id);
         // file_put_contents("delete_res.txt","\n".print_r($delete_res ,true),FILE_APPEND);
        
     }
    
    
      
      
   
?>