<?php

namespace App\Services;

use Goutte\Client;


//the scrapperwrapper initilaizes our scrapper and gathers all the data for it
//once all the data has been gathered we send it to PostProcess to clean the data

class ScrapperWrapper
{

  public function __construct($client, $url, $startpage, $endpage, $dianPingDataStructure){
    $this->client = $client;
    $this->url = $url;
    $this->crawler = $client->request('GET', $url);
    $this->startpage = $startpage;
    $this->endpage = $endpage;
    $this->dianPingDataStructure = $dianPingDataStructure;
  }

  public function getCrawler(){
    return $this->crawler;
  }

  public function getUrl(){
    return $this->url;
  }


  public function getPageData() {
    $i = $this->startpage;
    $rawArray = [];
    while ($i < $this->endpage) {
      $this->client->request('GET', $this->url . strval($i));
      $rawArray[] = $this->processDataFields($this->dianPingDataStructure);
      $combinedRawData = $this->groupArrayByKey($rawArray);
      $i++;
    }
    return $combinedRawData;
  }

  public function processTextFields($css){
    $array = $this->crawler->filter($css)->each(function($node){
      return iconv('UTF-8', 'UTF-8',$node->text());
    });
    return $array;
  }


  public function processAttrFields($css, $fieldType){
    $array = $this->crawler->filter($css)->each(
    function($node) use (&$fieldType){
     return iconv('UTF-8', 'UTF-8', $node->attr($fieldType));
    });
    return $array;
  }

  // $dianPingDataStructure = [
  //   ['.comment-txt','text','field_title'],
  //   ['.name > a' => 'href'],
  //   ['.time' => 'text'],
  //   ['.user-info > span' => 'class'],
  //   ['.revitew-title > h1 > a' => 'href'],
  // ];
  //this function will process an array similar to the above
  public function processDataFields($fields){
    $result = [];
    foreach($fields as $field){
      if($field[1] == 'text'){
        $result[$field[2]] = $this->processTextFields($field[0]);
      } else {
        $result[$field[2]] = $this->processAttrFields($field[0], $field[1]);
      }
    }
    return $result;
  }

  public function groupArrayByKey ($array) {
  $result = array();
  foreach ($array as $sub) {
    foreach ($sub as $k => $v) {
      $result[$k][] = $v;
    }
  }
  return $result;
}

}

 ?>
