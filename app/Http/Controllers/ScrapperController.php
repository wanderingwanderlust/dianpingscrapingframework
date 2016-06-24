<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\ForceCharsetPlugin;
use Symfony\Component\DomCrawler\Crawler;
use App\Services\ScrapperWrapper;
use App\Services\PostProcessDianPing;
use App\Services\PostProcessBonApp;
use App\Services\MailWrapper;
use App\Services\PostProcess;
use App\Critic;
use DB;
use Log;



class ScrapperController extends Controller
{


public function testProcessDataFields($restId, $startpage, $endpage)
{
  $client = new Client();
  $rawData = [];
   $dianPingDataStructure = [
     ['.comment-txt','text','commentBody'],
     ['.name > a', 'href', 'authorId'],
     ['.time', 'text', 'commentDate'],
     ['.user-info > span:first-child', 'class', 'originalGrade' ],
     ['.revitew-title > h1 > a', 'href', 'commentVenue'],
   ];
  $sw = new ScrapperWrapper($client, 'http://www.dianping.com/shop/'.$restId.'/review_all?pageno=', $startpage, $endpage, $dianPingDataStructure);
  $combinedRawData = $sw->getPageData();
  print_r(var_dump($combinedRawData));
}

//
//
// public function beginDianPingWuDingScrape(){
//     $x = 1;
//     $client = new Client();
//     $restId = '5863177';
//     $sw = new ScrapperWrapper($client, 'http://www.dianping.com/shop/'.$restId.'/review_all?pageno='.$x);
//     $crawler = $sw->getCrawler();
//     $dianPing = new PostProcessDianPing($crawler);
//     $fields = $dianPing->getDianPing($client, $x);
//   }
//
//
//
// public function beginJsonScrap(){
//   $bonAppJing = 'http://iservice.bonapp.cn/reviews/list.json?fkRestaurantId=3438&sort=reviewdate.desc&page=';
//   $bApp = new PostProcessBonApp();
//   $x = 1;
//   while($x < 4)
//   {
//     $url = $bonAppJing.$x;
//     $json = file_get_contents($url); // this WILL do an http request for you
//     $bonapp = json_decode($json, true);
//     $bApp->getBonAppCritic(5, $bonapp);
//   }
//   $x++;
//  }
//
//
// public function bonAppBundScrape(){
//     $bApp = new PostProcessBonApp();
//     $bonAppBund = 'http://iservice.bonapp.cn/reviews/list.json?fkRestaurantId=14216&sort=reviewdate.desc&page=1';
//     $url = $bonAppBund;
//     $json = file_get_contents($url); // this WILL do an http request for you
//     $bonapp = json_decode($json, true);
//     $bApp->getBonAppCritic(2, $bonapp);
//     }
//
//
// public function showCriticsListing(){
//   $critics = Critic::all();
//   $view = view('scraplist', ['critics' => $critics]);
//   return $view;
// }

public function homepage(){
  $view = view('home');
  return $view;
}


}
 ?>
