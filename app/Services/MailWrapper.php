<?php
namespace App\Services;

use Log;



class MailWrapper {


public function negativeMail($source_id, $date, $original_grade, $author_id, $body, $venue, $language){
    $to = "greg.lindenman@31ten.network, joseph@31ten.network, mario@31ten.network, li@le-bordelais.com";
          $subject = "Negative comment on ".$source_id;
    $message= "
                <p>Dear, </p>
                  <p> Please find as below the negative comment/grade received on ".$source_id.", Location: ".$venue."</p>
                  <h1>Negative Comment from ".$source_id."</h1>
                  <table>
                    <tr>
                      <th>Date</th>
                      <th>Original Grade</th>
                      <th>Author ID</th>
                      <th>Comment Body</th>
                      <th>Venue</th>
                      <th>Source</th>
                      <th>Language</th>
                    </tr>
                    <tr>
                      <td>".$date."</td>
                      <td>".$original_grade."</td>
                      <td>".$author_id."</td>
                      <td>".$body."</td>
                      <td>".$venue."</td>
                      <td>".$source_id."</td>
                      <td>".$language."</td>
                    </tr>
                </table>";
    if ($source_id == "DianPing") {
         $message .= "View the user's full comment: http://www.dianping.com/member/".$author_id;
       }else{
         $message .= "View the user's full comment: http://profile.bonapp.cn/otherprofile.html?otherUserId=".$author_id;
       }
    $headers = 'From: greg@31ten.network' . "\r\n". "Content-Type: text/html; charset=UTF-8";
    mail($to, $subject, $message, $headers);
}


}
