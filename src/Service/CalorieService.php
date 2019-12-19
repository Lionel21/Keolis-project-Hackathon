<?php


namespace App\Service;

class CalorieService
{
    const  KCALMIN =  24.5/200;
    public function calculCalories(int $weight, $duration): float
    {
        $calorie = self::KCALMIN*$weight*$duration;
        return $calorie;
    }
}
