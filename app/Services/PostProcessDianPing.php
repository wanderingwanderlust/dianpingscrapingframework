<?php
namespace App\Services;

use Log;
use App\Services\PostProcess;
use App\Services\ScrapperWrapper;
use App\Critic;
use App\Services\MailWrapper;


class PostProcessDianPing extends PostProcess{

  public function __construct($crawler){
    $this->crawler = $crawler;
  }



public function getDianPing($client, $x)
{
  //$postDian = new PostProcess($crawler);
  while($x <= 21){
    $fields = array(
     'body' => $this->processTextFields('.comment-txt'),
     'author_id' => $this->processHrefFields('.name > a'),
     'date' => $this->processTextFields('.time'),
     'original_grade' => $this->processClassFields('.user-info > span'),
     'venue' => $this->processHrefFields('.revitew-title > h1 > a'),
    );
      $this->getNewDianPingCritic($fields);
  }
  $x++;
}

public function getNewDianPingCritic($fields){
    $i=0;
    $mailer = new MailWrapper();
    while ($i < count($fields['body'])) {
        //$mdCheck = Critic::select('SELECT mdhash FROM critic having count(*) > 1');
        $critic = new Critic();
        $critic->body = trim($fields['body'][$i]);
        $critic->author_id = substr($fields['author_id'][$i], 8);

        $dateConvert = $fields['date'][$i];
        if(strlen($dateConvert) == 32){
            $shortDate = utf8_decode(substr($dateConvert, 0, 8));
            $trimDate = trim($shortDate);
            //Log::info(strlen($trimDate));
            if(strpos($trimDate, '?') == true){
                $shorterDate = substr($trimDate, 0, 5);
                $critic->date = trim('2016-'.$shorterDate);
              }else{
                $critic->date = '20'.$trimDate;
              }
            }elseif(strlen($dateConvert) == 5){
              $critic->date = trim('2016-'.$dateConvert);
            }else{
              $critic->date = trim('20'.$dateConvert);
            }

        if(substr($fields['original_grade'][$i], -2) == 'er'){
          $critic->original_grade = '0';
        }else{
        $critic->original_grade = substr($fields['original_grade'][$i], -2);
      }
        if($critic->original_grade == '50' || $critic->original_grade == '40'){
          $critic->liked = true;
        }else {
          $critic->liked = false;
        }
        $critic->venue = substr($fields['venue'][0], 6);
        $critic->source_id = 'DianPing';
        $critic->language = 'ZH';
        $mdCritic = md5($critic->body.$critic->author_id.$critic->date.$critic->original_grade.$critic->liked.$critic->venue.$critic->source_id, false);
        $mdCheck = Critic::select("mdhash")->where('mdhash', '=', $mdCritic)->count() > 0;
        //$mdVar = var_dump($mdCheck);
        if ($mdCheck != $mdCritic)
        {
          $critic->mdhash = $mdCritic;
          $critic->save();
          if($critic->liked == false)
          {
            sleep(2);
            $mailer->negativeMail($critic->source_id, $critic->date, $critic->original_grade, $critic->author_id, $critic->body, $critic->venue, $critic->language);
          }
        }
        $i++;
}

}



}
?>
