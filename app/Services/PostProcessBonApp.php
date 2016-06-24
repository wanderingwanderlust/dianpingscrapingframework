<?php
namespace App\Services;

use Log;
use App\Services\PostProcess;
use App\Services\ScrapperWrapper;
use App\Critic;
use App\Services\MailWrapper;


class PostProcessBonApp {

# @TODO (greg) why calling that function getBonAppCritic while we are inside PostProcessBonApp, getCritic should be enough
# @TODO (greg) $bonapp var? what is is?
public function getBonAppCritic($max, $bonapp){
  $i = 0;
  # @TODO (greg) why handling the mail here while the function name says it "get a critic" + bad code design, one function = one task only
  $mailer = new MailWrapper();
  
  # @TODO (greg) I dont understand the loop thing with all the code inside, something better should be doing it with 2 functions
  # function processArray
  #    while array as elementArray
  #        $result[] = $this->cleanOneBonAppCritic(elementArray) 
  #
  # function cleanOneBonAppCritic
  #     process transformation logic here
  
  while($i < $max)
  {
    $critic = new Critic();
    $critic->body = $bonapp["resultList"][$i]["content"];
    $critic->author_id = $bonapp["resultList"][$i]["dinerId"];
    $convertDate = strtotime($bonapp["resultList"][$i]["dateDesc"]);
    $fixedDate = date("Y-m-d", $convertDate);
    $critic->date = $fixedDate;
    if($bonapp["resultList"][$i]["likeIt"] == 1){
      $critic->original_grade = "Liked";
      $critic->liked = true;
    } else {
      $critic->original_grade = "Disliked";
      $critic->liked = false;
    }
    $critic->venue = $bonapp["resultList"][$i]["fkRestaurantId"];
    $critic->source_id = 'BonApp';
    $critic->language = 'EN';
    $mdCritic = md5($critic->body.$critic->author_id.$critic->date.$critic->original_grade.$critic->liked.$critic->venue.$critic->source_id, false);
    $mdCheck = Critic::select("mdhash")->where('mdhash', '=', $mdCritic)->count() > 0;
    if ($mdCheck != $mdCritic){
      $critic->mdhash = $mdCritic;
      $critic->save();
      if($critic->liked == false)
      {
        sleep(20);
        $mailer->negativeMail($critic->source_id, $critic->date, $critic->original_grade, $critic->author_id, $critic->body, $critic->venue, $critic->language);
      }
  }
  $i += 1;
    }

  }










}
