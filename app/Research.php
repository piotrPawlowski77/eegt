<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $table='research';
    protected $primaryKey = 'research_id';

    //kazde badanie moze miec 1 lub wiele wizyt
    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    //kazde badanie moze miec 1 lub wiele godzin
    public function research_hours()
    {
        return $this->hasMany('App\ResearchHour', 'research_id');
    }

}
