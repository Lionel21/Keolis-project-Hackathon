<?php


namespace App\Service;

class CalorieService
{
    const  KCALMIN =  24.5/200;
    public function calculCalories(int $weight, $duration=15): float
    {
        $calorie = self::KCALMIN*$weight*$duration;
        return $calorie;
    }
}
