<?php


namespace App\eegt\Repositories;


use App\eegt\Interfaces\BackendRepositoryInterface;
use App\Research;
use App\Visit;

//komunikacja z BD

class BackendRepository implements BackendRepositoryInterface
{

    //znajdz wszystkie wizyty
    public function getAllVisits()
    {
        return Visit::with('user', 'research', 'research_hours')->orderBy('research_id')->get();
    }

    //znajdz wszystkie badania
    public function getAllResearch()
    {
        return Research::orderBy('research_id')->get();
    }

    public function getResearch($research_id)
    {
        return Research::find($research_id);
    }

    public function deleteResearch(Research $research)
    {
        //wykonaj met delete na obiekcie room z param
        return $research->delete();
    }

    public function updateResearch($request, $research_id)
    {
        if($request->research_id == $research_id)
            return Research::where('research_id', $research_id)->update([
                'research_id' => $research_id,
                'research_name' => $request->research_name,
                'description' => $request->description,
                'research_date' => $request->research_date,
                'availability' => $request->availability,
            ]);
        else
            return false;
    }

}
