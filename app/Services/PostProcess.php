<?php
namespace App\Services;

use Log;
use App\Services\ScrapperWrapper;

//this will clean the data from the ScapperWrapper

class PostProcess {


  // $dianPingDataStructure = [
  //   ['field_title' => [comments], [] ],
  //   ['field_title' => [authorId], [] ],
  //   ['field_title' => [date] , []    ],
  //   ['field_title' => [grades], []   ],
  //   ['field_title' => [venue], []    ] ,
  // ];
  //this function will process an array similar to the above
 public function dianPingDataCleaner($rawDataArray)
 {
   $cleanDataArray = [];
       foreach ($rawDataArray as $rawData)
       {
        //create array that will hold the individual data
        //need to devise correct array for the data to live in

           $rawData['comment'] = trim($rawData[$i]);
           $rawData['authorId'] => substr($rawData['author_id'][$i], 8);

           //fixing dianPing's broken dates
           $dateConvert = $rawData['date'][$i];
           if(strlen($dateConvert) == 32){
               $shortDate = utf8_decode(substr($dateConvert, 0, 8));
               $trimDate = trim($shortDate);
               if(strpos($trimDate, '?') == true){
                   $shorterDate = substr($trimDate, 0, 5);
                   $cleanDataArray[$date] => trim('2016-'.$shorterDate);
                 }else{
                   $cleanDataArray[$date] => '20'.$trimDate;
                 }
               }elseif(strlen($dateConvert) == 5){
                 $cleanDataArray[$date] => trim('2016-'.$dateConvert);
               }else{
                 $cleanDataArray[$date] => trim('20'.$dateConvert);
               }

               //getting the number value of the User's rating
           if(substr($criticValue['original_grade'][$i], -2) == 'er'){
             $criticValue[$original_grade] = '0';
           }else{
           $criticValue[$original_grade] = substr($criticValue['original_grade'][$i], -2);
         }
           if($criticValue[$original_grade] == '50' || $criticValue[$original_grade] == '40'){
             $cleanDataArray[$liked] => true;
           }else {
             $cleanDataArray[$liked] => false;
           }
           $cleanDataArray[$venue] => substr($fields['venue'][0], 6);

           $cleanDataArray[$source_id] => 'DianPing'; //since this data can only be used on dian ping hardcoding it
           $cleanDataArray[$language] => 'ZH'; //find solution to detect language by text

        }
      }
        return $cleanDataArray;
}

?>
