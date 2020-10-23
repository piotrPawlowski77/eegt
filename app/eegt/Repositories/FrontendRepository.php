<?php


namespace App\eegt\Repositories;

use App\Research;
use App\eegt\Interfaces\FrontendRepositoryInterface;
use App\Visit;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

//komunikacja z BD

class FrontendRepository implements FrontendRepositoryInterface
{

    //zwrocenie listy dostepnych badan
    public function getResearchList()
    {
//        $research_list = DB::table('research')
//            ->join('research_hours','research.id','=','research_hours.research_id')
//            ->select('research.research_name', 'research.description', 'research.research_date', 'research_hours.hour')
//            ->where([
//                ['research.availability','=','1'],
//                ['research_hours.availability','=','1'],
//            ])->get();

          $research_list = DB::table('research')
            ->select('research.research_name')
            ->where('availability','=','1')->get();

        //dd($research_list);

        return $research_list;

    }

    //zwrocenie opisu badania na podstawie zaznaczonego badania
    public function findResearchDescription($request)
    {
//        $research_description = DB::table('research')
//            ->join('research_hours','research.id','=','research_hours.research_id')
//            ->select('research.description')
//            ->where([
//                ['research.availability','=','1'],
//                ['research_hours.availability','=','1'],
//            ])
//            ->where('research_name',$request->research_name)
//            ->get();

          $research_description = DB::table('research')
            ->select('description')
            ->where('research.availability','=','1')
            ->where('research_name',$request->research_name)
            ->get();

        return $research_description;

    }

    //zwrocenie daty badania na podstawie zaznaczonego opisu
    public function findResearchDate($request)
    {
        $research_date = DB::table('research')
            ->select('research_date')
            ->where('availability','=','1')
            ->where('description',$request->description_name)
            ->get();

        return $research_date;
    }

    public function findResearchHours($request)
    {
        $research_hours = DB::table('research')
            ->join('research_hours','research.research_id','=','research_hours.research_id')
            ->select('research_hours.hour')
            ->where([
                ['research.availability','=','1'],
                ['research_hours.availability','=','1'],
            ])
            ->where('research.research_date',$request->research_date)
            ->get();

        return $research_hours;


    }

    public function getResearchIdByResearchName($research_name)
    {
        $id = Research::select('research_id')->where('research_name', $research_name)->first();

//        to tez dziala!
//        $id = DB::table('research')
//            ->select('research_id')
//            ->where('research_name', $research_name)
//            ->first();


        $id_convert = $id->research_id;

        //dd($id_convert);

        return $id_convert;
    }

    public function saveVisit($request)
    {
        //generacja kodu wizyty
        $digits = 9;
        $code = rand(pow(10, $digits-1), pow(10, $digits)-1);

        //wyszukanie id badania na podstawie jego nazwy
        $research_id = $this->getResearchIdByResearchName($request->research_name);

        //dd($research_id);

        //przed zapisem wizyty musze zupdateowac tabele research_hours

        DB::table('research_hours')
            ->where('research_id', $research_id)
            ->where('hour', $request->hours)
            ->update([
                'availability' => 0,
                'user_id' => $request->user()->id,
                'research_code' => $code,
            ]);

        //jesli godziny wizyt sie wyczerpaly dla danego badania
        //to zmien availability w tabeli research na 0
        //$jedynka = 1; //TU SKONCZYLEM. ZAPYTANIE $is_research_availability DO POPRAWY!
        //$is_research_availability = DB::select("select count(*) as ilosc from research_hours where research_id = ? and availability = ?", [$research_id], [$jedynka]);
        $is_research_availability = DB::table('research_hours')
                                    ->select( DB::raw("count(*) as ilosc") )
                                    ->where('research_id', $research_id)
                                    ->where('availability', 1)
                                    ->first();

        //dd($is_research_availability);

        //jesli ilosc to 0 oznacza to ze badanie jest juz niedostepne -> godziny na to badanie sie wyczerpaly
        if($is_research_availability->ilosc == 0)
        {
            DB::table('research')
                ->where('research_id',$research_id)
                ->update([
                    'availability' => 0,
                ]);
        }

        //utworzenie zmiennej sesji z kodem badania
        //potrzeba by wypełnić automatycznie pole w wyszukiwarce wizyty
        //class mongo db not found. nie dziala
        //Session::set('research_code', $code);

        //utworzenie wizyty w tabeli visit
        return Visit::create([
            'user_id' => $request->user()->id,
            'research_id' => $research_id,
            'research_code' => $code,
        ]);


    }

    public function isResearchCodeExists($request)
    {
        return Visit::where('research_code', $request->research_code)->where('user_id', $request->user()->id)->first();
        //moge dac first zamiast get (zwraca kolekcje elementow) bo przeciez kazde badanie ma swoj unikalny numer i jest tylko jedno
    }

    public function getResearchDetails($is_research_code_exists)
    {
        //załadowanie modelu wizyty z zaladowaniem zaleznych modeli.
        //wczytam wizyte z uzytkownikiem i badaniem. bo wizyta ma jakiegos usera i badanie.
        //dd( Visit::with(['user', 'research', 'research.research_hours']) );
        //dd( Visit::with(['user', 'research', 'research.research_hours'])->select('user_id', 'research_id')->first() );

        //dd($is_research_code_exists);

        //dd( Visit::with(['user', 'research', 'research.research_hours'])->where('research_code', $is_research_code_exists->research_code)->where('user_id', $is_research_code_exists->user_id)->first() );

        //dd( Visit::with(['user', 'research', 'research_hours'])->where('research_code', $is_research_code_exists->research_code)->where('user_id', $is_research_code_exists->user_id)->first());

        return Visit::with(['user', 'research', 'research_hours'])->where('research_code', $is_research_code_exists->research_code)->where('user_id', $is_research_code_exists->user_id)->first();

    }


}
