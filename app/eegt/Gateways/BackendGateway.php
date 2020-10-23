<?php


namespace App\eegt\Gateways;

use App\eegt\Interfaces\BackendRepositoryInterface;
use Illuminate\Foundation\Validation\ValidatesRequests;

//w gateway uzywac bd repozytorium
//GATEWAY = walidacja form, logika biznesowa, odwolanie do repozytorium



class BackendGateway
{

    use ValidatesRequests; //import z Controller.php - potrzebny do zastos. tu metody validate()

    /**
     * BackendGateway constructor.
     */
    public function __construct(BackendRepositoryInterface $bR)
    {
        $this->bR = $bR;
        //i mam w gateway dostepne moje repo dla kazdej metody
    }






}
