<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    //kazda rola ma 1 usera
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
