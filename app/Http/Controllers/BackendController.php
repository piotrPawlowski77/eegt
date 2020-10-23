<?php

namespace App\Http\Controllers;

use App\eegt\Gateways\BackendGateway;
use App\eegt\Interfaces\BackendRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests\ResearchRequest;  //uzycie klasy z walidacja danych

class BackendController extends Controller
{

    //konstruktor zeby miec dostepne repo w all metodach tej klasy
    public function __construct(BackendRepositoryInterface $bR, BackendGateway $bG)
    {
        $this->middleware('CheckOwner')->only(['researchList','index']);

        //mamy widoczne repozytorium i gateway w all metodach tej klasy
        $this->bR = $bR;
        $this->bG = $bG;
    }

    //dodaj strony panelu admina - wyswietl liste wizyt
    public function index()
    {
        $visits = $this->bR->getAllVisits();

        //dd($visits);

        return view('backend.index', compact('visits'));
    }

    //wyswietl l1iste badan
    public function researchList()
    {
        $researchList = $this->bR->getAllResearch();

        //dd($researchList);

        return view('backend.researchList', compact('researchList'));
    }

    //usun badanie
    public function deleteResearch($research_id)
    {
        //znajdz w repo dane badanie
        $research = $this->bR->getResearch($research_id);

        //autoryzacja
        //$this->authorize('checkOwner', $research);

        //przekaze caly obiekt a nie tylko id
        $this->bR->deleteResearch($research);

        //dd($research);

        return redirect()->back();

    }

    //edytuj badanie
    public function editResearch($research_id)
    {
        //znajdz w repo dane badanie
        $research = $this->bR->getResearch($research_id);

        return view('backend.researchEditForm', compact('research'));
    }

    public function updateResearch(Request $request, $research_id)
    {
        //update badania
        $this->bR->updateResearch($request, $research_id);


        return redirect()->route('researchList');

    }

}
