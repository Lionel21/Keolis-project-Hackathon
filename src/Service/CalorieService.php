<?php


namespace App\Service;

const KCALMIN = 24.5/200;
class CalorieService
{
    public function calculCalories(int $poids,int $duration): float
    {
        $calorie = KCALMIN*$poids*$durations;
        return $calorie;
    }
}
