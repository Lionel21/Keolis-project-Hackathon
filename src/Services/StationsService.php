<?php


namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class StationsService
{
    public function getStations(): array
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://data.orleans-metropole.fr/api/records/1.0/search/?dataset=liste-des-stations-velo-2018-orleans-metropole&rows=35');
        $content = $response->toArray();

        foreach ($content['records'] as $station) {
            $stations[$station['fields']['nomstation']] = [$station['fields']['latitude'], $station['fields']['longitude']];
        }

        return $stations;
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
}
