<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class MaponApiController
{
    /**
     * @throws GuzzleException
     */
    function actionRetrieveHistoricalData(): void
    {
        $client = new Client();

        $response = $client->request('GET', ' https://mapon.com/api/v1/unit_data/history_point.json', [
            'query' => [
                'key' => $_ENV["MAPON_API_KEY"],
                'unit_id' => '199332',
                'datetime' => '2019-04-08T12:00:00Z',
                'include' => [
                    "can_total_distance",
                    "mileage",
                    "position"
                ]
            ]
        ]);

        print_r((string)$response->getBody());
    }
}