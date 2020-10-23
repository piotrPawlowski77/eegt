<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchHour extends Model
{

    //kazda godzina nalezy do 1 lub wielu badan
    public function research()
    {
        return $this->belongsTo('App\Research','research_id');
    }

    //kazda godzina nalezy do jakiegos zapisanego uzytkownika
    public function user()
    {

    }

}
