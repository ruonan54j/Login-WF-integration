<?php

$url = 'http://rew.ca/properties/search/build?property_search[query]=R2401682';
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
/*$dom = new DOMDocument();
@$dom->loadHTML($output);
print_r($dom);*/
#echo $dom->'path';
//Parsing output
$dom = new DOMDocument();
@$dom->loadHTML($output);

foreach($dom->getElementsByTagName('meta') as $link) {
         if($link->getAttribute('property') == "og:image"){
            echo $link->getAttribute('content');
         }
}

  ?>