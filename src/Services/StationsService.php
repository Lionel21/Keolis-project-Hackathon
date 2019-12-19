<?php


namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class StationsService
{
    public function getStations(): array
    {
        $client = HttpClient::create();
        $url = 'https://data.orleans-metropole.fr/api/records/1.0/search/?apikey=289cad31eb950033126984e663a0e35a82394938ea542d4cabf4c095&dataset=liste-des-stations-velo-2018-orleans-metropole&rows=35';
        $response = $client->request('GET', $url);
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
