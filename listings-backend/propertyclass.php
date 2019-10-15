<?php
class Property {

  public $mlsid = "";
  public $image = "";
  public $images = [];
  public $description = "";
  public $price = "";
  public $streetaddress = "";
  public $addressLocality = "";
  public $addressProvince = "";
  public $postalCode = "";
  public $propertyoverview = [];
  public $beds = "";
  public $bathrooms = "";
  public $propsize ="";
  public $proptype = "";
  public $wfPropertyId = "";
  public $Lot_Size="";
  public $Year_Built="";
  public $Brokerage="";
  
  
   public function __construct($mlsid){
      $this->mlsid = $mlsid;
   }
   public function getdata() {
       
     $summaryitems = [];
     
    $url = 'http://rew.ca/properties/search/build?property_search[query]='.$this->mlsid;
    #$url ='https://www.rew.ca/properties/R2401682/608-4638-gladstone-street-vancouver-bc';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; CrawlBot/1.0.0)');

    curl_setopt($ch,CURLOPT_HEADER,0);

    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

    $output = curl_exec($ch);
    $output = json_decode($output,TRUE);
    print_r($output);
    echo $output['path'];
    $url = "https://www.rew.ca{$output['path']}";

    echo "<script type='text/javascript'>console.log('".$url."');
    </script>";
    echo "<script type='text/javascript'>console.log('".$output."');
    </script>";
   //Page found

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; CrawlBot/1.0.0)');

    curl_setopt($ch,CURLOPT_HEADER,0);

    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

    $output = curl_exec($ch);

    $dom = new DOMDocument();
    @$dom->loadHTML($output);
    print_r($dom);
    //Parsing output
    $dom = new DOMDocument();
    @$dom->loadHTML($output);
    
    foreach($dom->getElementsByTagName('meta') as $link) {
             if($link->getAttribute('property') == "og:image"){
                array_push($this->images, $link->getAttribute('content'));
             }
    }
    $this->image = $this->images[0];

    foreach($dom->getElementsByTagName('div') as $link) {

             if($link->getAttribute('itemprop') == "description"){
                $this->description = $link->nodeValue;
             }
             if($link->getAttribute('class') == "propertyheader-price"){
                 $this->price = $link->nodeValue;
            
             }
             if($link->getAttribute('class') == "col-xs-3 summarybar-item"){
                 array_push($summaryitems,str_replace("\n","",$link->nodeValue));
             }
    }
    
    /*****************************************************************/
    //get element by tag name
    foreach($dom->getElementsByTagName('table') as $link) {
        if($link->getAttribute('class') == "contenttable") {
            $THDATA=$link->getElementsByTagName('th');
            $TDDATA=$link->getElementsByTagName('td');
            $i = 0;
            foreach($THDATA as $th_data) {
                  $tr1=preg_replace('/\s+/', '',$th_data->nodeValue);
                $thArray[$i] = str_replace(' ','',$tr1);
               $i++;
            }
            $j = 0;
            foreach($TDDATA as $td_data) {
                   $tdArray[$j] = $tr1=$td_data->nodeValue;
               $j++;
            }
            $t_body = array_combine($thArray, $tdArray);
        }
    }
    if(isset($t_body['PrimaryBroker'])){
         $this->Brokerage =$t_body['PrimaryBroker'];
    }    
    if(isset($t_body['LotSize'])){
         $this->Lot_Size =$t_body['LotSize'];
    }
    if(isset($t_body['PropertyAge'])) {
         $this->Year_Built =$t_body['PropertyAge'];
    }

    $this->beds =str_replace("Bed","",$summaryitems[0]);
    $this->bathrooms = str_replace("Bath","",$summaryitems[1]);
    $this->propsize = str_replace("Sqft","",$summaryitems[2]);
    $this->proptype = str_replace("Type","",$summaryitems[3]);
    
    foreach($dom->getElementsByTagName('span') as $link) {
             
             if($link->getAttribute('itemprop') == "streetAddress"){
                 $this->streetaddress = $link->nodeValue;
             }
             if($link->getAttribute('itemprop') == "addressLocality"){
                 $this->addressLocality = $link->nodeValue;
             }
             if($link->getAttribute('itemprop') == "addressLocality"){
                 $this->addressProvince = $link->nodeValue;
             }
             if($link->getAttribute('itemprop') == "postalCode"){
                 $this->postalCode = $link->nodeValue;
             }
       }
   }
   
   public function push() {
       
        if (empty($this->price)) {
            echo "<script type='text/javascript'>
                     alert('Property Price: Empty');
                  </script>";
                  
            return false;
            exit;
        }

      include("databaseconnect.php");
     
      $this->images = implode(",",$this->images);

      $this->description= $conn->real_escape_string($this->description);
     
      $prop_type='';
      $proptype='';
     
      $prop_type=str_replace(' ','',strtolower($this->proptype));
      
      $property_type = array("duplex","house","apartment","manufacturedhome","mobilehome","recreational","lot","townhouse","apt/condo");
      if(in_array($prop_type, $property_type)) {
          $proptype=$this->proptype;
      }
      
      $description=preg_replace('~[\r\n]+~',' ',$this->description);
     
     $query = "INSERT INTO `property` (`mlsid`, `image`, `images`, `description`, `price`, `streetaddress`, `addressLocality`, `addressProvince`, `postalCode`, `beds`, `bathrooms`, `propsize`, `proptype`, `LotSize`, `YearBuilt`, `Brokerage`, `Sold`, `webflow_Item_id`, `webflow_status`)
              VALUES ('{$this->mlsid}',
                      '{$this->image}',
                      '{$this->images}',
                      '{$description}',
                      '{$this->price}',
                      '{$this->streetaddress}',
                      '{$this->addressLocality}',
                      '{$this->addressProvince}',
                      '{$this->postalCode}',
                      '{$this->beds}',
                      '{$this->bathrooms}',
                      '{$this->propsize}',
                      '{$proptype}',
                      '{$this->Lot_Size}',
                      '{$this->Year_Built}',
                      '{$this->Brokerage}',
                      '0',
                      '{$this->wfPropertyId}',
                      '1');";
     
    $result = $conn->query($query);
    
    if($result !== false){
      return true;
    }else {
      //echo "Trasnfer failed    $conn->error";
    }
     //echo "IMAGE LIST:  {$this->images}";
    // echo "<br> desc:  {$this->description}";
     return false;
   }
   
   public function setwfPropertyId($property_id){
       $this->wfPropertyId = $property_id;
   }

}


 ?>
