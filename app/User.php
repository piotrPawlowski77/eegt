<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public static $roles = [];  //na potrzeby hasRole()

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname', 'nr_indeksu'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //kazdy user ma 1 role admin lub patient
    public function role()
    {
        return $this->hasOne('App\Role');
    }

    //kazdy user moze miec 1 lub wiele wizyt
    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    public function hasRole(array $roles)
    {
        //zeby nie odwolywac sie co chwila do bd, stworzylem tab z rolami dla userow (na pocz tej klasy)
        foreach ($roles as $role)
        {
            if(isset(self::$roles[$role])) //jesli w tab statycznej $roles istnieje rola jak w tab metody hasRole. self to odwolanie do zm statycznej
            {
                if(self::$roles[$role]) //jesli rola istnieje - przewrwij skrypt
                    return true;
            }
            else
            {
                //jesli rola nie istnieje - zapisz role do zm statycznej => potrzebna relacja role()
                self::$roles[$role] = $this->role()->where('role_name', $role)->exists(); //jesli istnieje rola gdzie role_name = rola z petli - przypisz true lub false w przec wypad.

                if(self::$roles[$role]) return true;
            }
        }
        return false;
    }

}
