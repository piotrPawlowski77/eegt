<?php


namespace App\eegt\Gateways;

//w gateway uzywac bd repozytorium
use App\eegt\Interfaces\FrontendRepositoryInterface;
use Illuminate\Foundation\Validation\ValidatesRequests;

class FrontendGateway
{

    use ValidatesRequests; //import z Controller.php - potrzebny do zastos. tu metody validate()

    /**
     * FrontendGateway constructor.
     */
    public function __construct(FrontendRepositoryInterface $fR)
    {
        $this->fR = $fR;
        //i mam w gateway dostepne moje repo dla kazdej metody
    }

    public function saveVisit($request)
    {
        //walidacja danych
        if($request->input('name') == $request->user()->name &&
            $request->input('surname') == $request->user()->surname &&
            $request->input('research_name') == $request->research_name &&
            $request->input('description') == $request->description &&
            $request->input('research_date') == $request->research_date &&
            $request->input('hours') == $request->hours &&
            $request->input('research_name') != null &&
            $request->input('description') != null &&
            $request->input('research_date') != null &&
            $request->input('hours') != null
            )
        {

            //walidacja ok
            return $this->fR->saveVisit($request);
        }
        else
        {
            //dd('Tu jestem');
            return redirect()->route('home')->with('message', 'Niepoprawne dane formularza');
        }
    }

    public function findVisitResult($request)
    {
        //walidacja danych
        //validate() to metoda Controller-a i musze zaimportowac trait (na poczatku tej klasy jest)
        //ktory umozliwi mi wykonanie metody validate, poniewaz jestem we frontend Gateway

        $this->validate($request, [
            'research_code' => "required|numeric"
        ], ['Podano błędny numer wizyty!']);
        //jesli validate() nie przejdzie to kod ponizej nie zostanie wykonany.
        //Przekieruje nas na strone gdzie bylismy
        //dd($request->research_code);

        //GATEWAY = walidacja form, logika biznesowa, odwolanie do repozytorium
        //sprawdz czy kod wizyty wpisany przez usera (o jego id) istnieje w BD
        $is_research_code_exists = $this->fR->isResearchCodeExists($request);

        //dd($is_research_code_exists);

        //jesli istnieje wizyta
        if($is_research_code_exists)
        {
            //wyswietl jej szczegoly
            $visitDetails = $this->fR->getResearchDetails($is_research_code_exists);

            return $visitDetails;
        }

        return false;
    }

}
