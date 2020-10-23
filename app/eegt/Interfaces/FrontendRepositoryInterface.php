<?php


namespace App\eegt\Interfaces;


interface FrontendRepositoryInterface
{
    public function getResearchList();
    public function findResearchDescription($request);
    public function findResearchDate($request);
    public function findResearchHours($request);
    public function isResearchCodeExists($request);
    public function getResearchDetails($is_research_code_exists);
}
