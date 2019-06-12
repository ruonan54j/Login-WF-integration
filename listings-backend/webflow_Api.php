<?php
      
      include('databaseconnect.php');
      
      //session_start();
      $webflowAPI ="Bearer".' '.$_SESSION['webflow_api'];
      
      $sub_domain=$_SESSION['sub_domain'];


      //file_put_contents('debug/user_id.txt',print_r($user_id,true),FILE_APPEND );
     
      function jsondecode($fields) {

      $req_data_item='';
      $req_data_item.='{
        "fields":';
      $req_data_item.=json_encode($fields);
      $req_data_item.='}';
      return $req_data_item;
      
      }

      function get_site() {
            global $webflowAPI;
          
            $data='';
            $url="https://api.webflow.com/sites";
            $get_site = curl_call('Search',$webflowAPI,$url,$data);
            $Site=json_decode($get_site,true);
            $site_id=$Site[0]['_id'];
           // $get_domain_res=get_domain($site_id);
        return $site_id;
      }

      function collections() {
             global $webflowAPI;
             
             $site_id=get_site();
             
            //get collection information
            $data='';
            $url="https://api.webflow.com/sites/".$site_id."/collections";
          
            $info=curl_call('Search',$webflowAPI,$url,$data);
            $collections_info=json_decode($info,true);
            
           /*$url1="https://api.webflow.com/collections/5c8e0c6438c07d6993a487f8";
             $info1=curl_call('Search',$webflowAPI,$url1,$data);
             $collec=json_decode($info1,true);
             file_put_contents('debug/collec.txt',print_r($collec,true),FILE_APPEND );*/
             
            foreach( $collections_info as $value ) {
                if ($value['name'] == "Featured Listings") {
                      $collectionID = $value['_id'];
                }
            }
        return $collectionID;
      }

      function item_update($type,$data,$item_id) {
         global $webflowAPI;
         
          $coll_id=collections();

          $url="https://api.webflow.com/collections/".$coll_id."/items/".$item_id."?live=true";  
          
         // file_put_contents('debug/Json_date_data.txt',print_r($data,true),FILE_APPEND );
         
          
          $response=curl_call($type,$webflowAPI,$url,$data);
         
        // file_put_contents('debug/item_Update_Res.txt',print_r($response,true),FILE_APPEND );
       
        return $response;
      }

      function item_insert($type,$data) {    
        
         global $webflowAPI;
        
         $coll_id=collections();
         
         //file_put_contents('debug/insert_data.txt',print_r($data,true),FILE_APPEND );
         
         $create_item="https://api.webflow.com/collections/".$coll_id."/items?live=true";
         
         //file_put_contents('debug/create_item.txt',print_r($create_item,true),FILE_APPEND );
         
         $get_item_res = curl_call('POST',$webflowAPI,$create_item,$data);
         
          //file_put_contents('debug/get_item_res.txt',print_r($get_item_res,true),FILE_APPEND );
          
         $get_item=json_decode($get_item_res,true);
         
         return $get_item;
      }
      //if item is exist in application and not present in webflow
      function ag_item_insert($type,$data) {    
        
         global $webflowAPI;

            $coll_id=collections();
            $create_item="https://api.webflow.com/collections/".$coll_id."/items?live=true";
            $get_item_res = curl_call('POST',$webflowAPI,$create_item,$data);
            $get_item=json_decode($get_item_res,true);
        
        return $get_item;
      }
      

      function item_delete($type,$id) {
          
           global $webflowAPI;
           $json_data='';
           $coll_id='';

            $coll_id=collections();
          
            $url="https://api.webflow.com/collections/".$coll_id."/items/".$id."?live=true";
         
            $delete_item = curl_call($type,$webflowAPI,$url,$json_data);
          
            make_publish();
          
            return $delete_item;
      }
      
      function get_domain($site_id) {
          
          global $webflowAPI;
          $type='GET';
          $data='';
          
            $domain_url="https://api.webflow.com/sites/".$site_id."/domains";
       
            $get_domains= curl_call($type,$webflowAPI,$domain_url,$data);

            $domain=json_decode($get_domains,true);
            echo "<script>console.log( 'Debug Objects: ".$domain ."');</script>";
          
          return $domain;
      }
      
      function make_publish() {
          
          global $webflowAPI;
          global $sub_domain;
          
          $type='POST';
          $site_url='';
          $data='';
          $site_id=get_site();
      

         $data='{
                "domains": "['.$_SESSION['sub_domain2'].','.$_SESSION['sub_domain1'].']" 
    		    }';
             
            echo "<script>console.log( 'domain: ".$data."');</script>";

            $url_publish="https://api.webflow.com/sites/".$site_id."/publish";
          
            $publish_item = curl_call('POST',$webflowAPI,$url_publish,$data);
      }

      function curl_call($type,$token,$url,$data) {    

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_TIMEOUT,30);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                if($type == "PUT") {
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$data); 
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
                } if($type == "POST") {
                  curl_setopt($ch, CURLOPT_POSTFIELDS,$data); 
                  curl_setopt($ch, CURLOPT_POST, 1); 
                } if($type == "DELETE") {
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"DELETE");
                }
                  curl_setopt($ch,CURLOPT_HTTPHEADER, array(
                    "Authorization: ".$token,
                      "accept-version: 1.0.0",
                      "Content-Type: application/json"
                    ));
                $result ='';
                $sleep_i = 0;
                while ($result == '' && $sleep_i < 5)
                { 
                  $result = curl_exec($ch);
                  sleep(1);
                  $sleep_i++;
                }

                if ($result == ''){
                  echo "<script>alert('API not available, please contact Castle Team for support')</script>";
                }
                   return $result; 
        }
?>