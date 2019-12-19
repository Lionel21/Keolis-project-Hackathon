<?php


namespace App\Service;

const KCALMIN = 24.5/200;
class CalorieService
{
    public function calculCalories(int $weight,int $duration): float
    {
        $calorie = KCALMIN*$weight*$durations;
        return $calorie;
    }
}
