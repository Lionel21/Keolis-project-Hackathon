<?php


namespace App\Services;


use App\Entity\Travel;
use App\Entity\User;
use App\Repository\VoyageRepository;
use http\Env\Response;

class DistanceService
{
    public function getDistanceTotal(VoyageRepository $travelRepository, User $user): float
    {
        $travels = $travelRepository->findBy(['user' => $user]);
        $total = 0;
        foreach ($travels as $travel) {
                $total += $travel->getDistance();
        }
        return $total;
    }

    public function calcDistance(float $lat1, float $lng1, float $lat2, float $lng2) : float
    {
        // distance en metres
        $earthRadius = 6371000;
        // convert from degrees to radians
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lng1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lng2);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

    public function getTimeTotal(VoyageRepository $travelRepository, User $user) : float
    {
        $travels = $travelRepository->findBy(['user' => $user]);
        $total = 0;
        foreach ($travels as $travel) {
            $total += $travel->getDuration();
        }
        return $total;
    }
}
