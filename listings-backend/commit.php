<?php
include("databaseconnect.php");
include("propertyclass.php");

$delete = explode(" ",$_GET['delete']);
$add = explode(" ",$_GET['add']);



foreach ($delete as $key => $value) {
  if(!empty($value)){
    $sql = "DELETE FROM `property` WHERE mlsid = '{$value}';";
    $result = $conn->query($sql);
  }
}
foreach ($add as $key => $value) {
    if(!empty($value)){
      $property = new Property($value);
      $property->getdata();
      $property->push();
    }
}

$add_sold = explode(" ",$_GET['add-sold']);
$remove_sold = explode(" ",$_GET['remove-sold']);

foreach ($add_sold as $key => $value) {
  if(!empty($value)){
    $sql = "UPDATE `property` SET Sold = '1' WHERE mlsid = '{$value}';";
    $result = $conn->query($sql);
  }
}

foreach ($remove_sold as $key => $value) {
  if(!empty($value)){
    $sql = "UPDATE `property` SET Sold = '0' WHERE mlsid = '{$value}';";
    $result = $conn->query($sql);
  }
}

header("Location: loggedin.php");
die();
 ?>
