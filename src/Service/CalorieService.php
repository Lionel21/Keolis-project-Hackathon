<?php


namespace App\Service;

const KCALMIN = 24.5/200;
class CalorieService
{
    public function calculCalories(int $poids,int $temps): float
    {
        $calorie = KCALMIN*$poids*$temps;
        return $calorie;
    }
}
