<?php

namespace App\Implementations\Weather;

use App\IWeatherService;
use GuzzleHttp\Client;

class YandexWeatherService implements IWeatherService
{

    /**
     * YandexWeatherService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getTemperature($lat, $lon)
    {
        $endpoint = "https://api.weather.yandex.ru/v1/forecast?";

        try {
            $response = $this->client->request('GET', $endpoint, [
                'headers' => [
                    'X-Yandex-API-Key' => env("YANDEX_WEATHER_KEY")
                ],
                'query' => [
                    'lat' => $lat,
                    'lon' => $lon
                ]
            ]);

            $content = json_decode($response->getBody());
            return $content->fact->temp;
        } catch (\Exception $e) {
            info(self::class, ["msg" => "ошибка в запросе погоды"]);
            info($e);
            return "";
        }
    }
}