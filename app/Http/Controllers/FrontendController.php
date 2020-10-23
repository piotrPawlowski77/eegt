<?php

namespace App\Http\Controllers;

use App\eegt\Gateways\FrontendGateway;
use App\eegt\Interfaces\FrontendRepositoryInterface;
use Illuminate\Http\Request;


class FrontendController extends Controller
{

    //konstruktor zeby miec dostepne repo i gateway w all metodach tej klasy
    public function __construct(FrontendRepositoryInterface $repository, FrontendGateway $fG)
    {
        $this->fR = $repository;
        $this->fG = $fG;
    }

    //widok strony glownej
    public function index()
    {
        //wyswietlenie listy dostepnych badan
        $research_list = $this->fR->getResearchList();

        //dd($research_list);

        return view('frontend.index', compact('research_list')); //send data to view

    }

    public function findResearchDescription(Request $request)
    {
        $research_description = $this->fR->findResearchDescription($request);

        //dd($research_description);

        return response()->json($research_description); //send data to ajax success
    }

    public function findResearchDate(Request $request)
    {
        $research_date = $this->fR->findResearchDate($request);

        //dd($research_date);

        return response()->json($research_date); //send data to ajax success
    }

    public function findResearchHours(Request $request)
    {
        $research_hours = $this->fR->findResearchHours($request);

        //dd($research_hours);

        return response()->json($research_hours); //send data to ajax success
    }

    //zapisz na badanie
    public function save(Request $request)
    {

        //tu uzyje wzorca projektowego Gateway => tam bd: walidacja form, logika biznesowa, odwolanie do repozytorium
        $visit = $this->fG->saveVisit($request);

        //dd($visit);

        return view('frontend.save', compact('visit'));
    }

    public function findVisit()
    {

        return view('frontend.findVisit');
    }

    public function findVisitResult(Request $request)
    {

        $visitDetails = $this->fG->findVisitResult($request);

        return view('frontend.findVisit', compact('visitDetails'));
    }


}
