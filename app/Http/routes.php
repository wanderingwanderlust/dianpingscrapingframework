<?php
use App\Critic;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'ScrapperController@homepage');


<<<<<<< HEAD
$app->get('testdata/{restid}/{start}/{end}', ['uses' => 'ScrapperController@testProcessDataFields']);
=======
# @TODO (greg) remove specific routes names (DianPingWuDingScrape) and find more generic-obvious names for the logic of the app
$app->get('/dianpingwuding', 'ScrapperController@beginDianPingWuDingScrape');


$app->get('/criticlist', 'ScrapperController@showCriticsListing');


$app->get('/bonappscrapper', 'ScrapperController@beginJsonScrap');

$app->get('/bonappbund', 'ScrapperController@bonAppBundScrape');

$app->get('testdata', 'ScrapperController@testProcessDataFields');
>>>>>>> a8e1f7bd33359d7d5f773add578df5f93b60d71c

$app->get('/testmail', function () {
//    return $app->welcome();
$to      = 'greg.lindenman@31ten.network';
$subject = 'test';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
});
