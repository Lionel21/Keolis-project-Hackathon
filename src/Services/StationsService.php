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
}
