<?php


namespace App\Service;

use App\Entity\Travel;
use App\Entity\User;
use App\Repository\VoyageRepository;

class CalorieService
{
    const  KCALMIN =  24.5/200;
    public function calculCalories(int $weight, $duration): float
    {
        $calorie = self::KCALMIN*$weight*($duration/60);
        return $calorie;
    }

    public function getKcalTotal(VoyageRepository $travelRepository, User $user): float
    {
        $travels = $travelRepository->findBy(['user' => $user]);
        $total = 0;
        foreach ($travels as $travel) {
            $total += $travel->getCalory();
        }
        return $total;
    }
}
