<?php
require("vendor/autoload.php");
include("../listings-backend/propertyclass.php");
//include("../listings-backend/databaseconnect.php");

/* $property = new Property("R2340570");
$property->getdata();
print_r($property); */


$webflow = new \Webflow\Api('cc31fd98052ef99f350aecd5694382104aef9e55a2ced1c615219eb1d612b24c');
$data=$webflow->info();
print_r($data);
die;

$sites = $webflow->sites();
$collections = $webflow->collections($sites[0]->_id);
print_r($collections);
$fields = [
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
    'image-3' => $property->images[2]
];

print_r($fields);

$webflow->createItem($collections[0]->_id, $fields);

$webflow->publishSite($sites[0]->_id,["kylenekonkin.com","www.kylenekonkin.com"]);
?>
