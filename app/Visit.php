<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Visit extends Model
{

    protected $guarded = [];
    public $timestamps = false;

    //kazda wizyta nalezy do okreslonego usera
    public function user()
    {
        //return $this->belongsTo('App\User', 'id');
        return $this->belongsTo('App\User');
    }

    //kazda wizyta nalezy do 1 lub wiele badan
    public function research()
    {
        //return $this->belongsTo('App\Research', 'id');
        return $this->belongsTo('App\Research', 'research_id');
    }

    //wizyta moze miec wiele godzin wizyt
    public function research_hours()
    {
        return $this->hasManyThrough('App\ResearchHour', 'App\Research', 'research_id', 'research_id', 'research_id');
    }

}
