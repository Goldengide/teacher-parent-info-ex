<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    //
    public function sequenceNumber($no) {
        $sort = str_split($no);
        $lastPartOfNo = $sort[count($sort) -1];
        if( $lastPartOfNo == 1 ) {
            return $no. "<sup>st</sup>";
        }
        elseif($lastPartOfNo == 2) {
            return $no. "<sup>nd</sup>";
        }
        elseif($lastPartOfNo == 3) {
            return $no. "<sup>rd</sup>";
        }
        else {
            return $no. "<sup>th</sup>";
        }
    }
}
