<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Critic extends Model {

protected $fillable = [
    'body',
    'author_id',
    'date',
    'original_grade',
    'liked',
    'venue',
    'source_id',
    'language',
    'mdhash',
];


protected $table ='critics';




//
// public function getText(){
//   return $this->text;
// }
//  public function getAuthor(){
//    return $this->author;
//  }
//  public function getDate(){
//    return $this->date;
//  }
//  public function getGrade(){
//    return $this->grade;
//  }
//  public function getVenue(){
//    return $this->venue;
//  }
 //
 // public function getFields(){
 //   return [
 //     'text' => $this->getText(),
 //     'author' => $this->getAuthor(),
 //     'date' => $this->getDate(),
 //     'grade' => $this->getGrade(),
 //     'venue' => $this->getVenue()
 //   ];
 //
  }


?>
