<?php

namespace Tests\Unit;

use App\Implementations\Weather\YandexWeatherService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class YandexWeatherServiceTest extends TestCase
{
    public function test_must_returns_temp()
    {
        // arrange
        $mock = new MockHandler([
            new Response(200, [], json_encode(["fact" => ["temp" => 1]])),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $service = new YandexWeatherService($client);

        // act
        $result = $service->getTemperature(1, 1);

        // assert
        $this->assertEquals(1, $result);
    }

    public function test_must_returns_empty_if_exception()
    {
        // arrange
        $mock = new MockHandler([
            new Response(403),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $service = new YandexWeatherService($client);

        // act
        $result = $service->getTemperature(1, 1);

        // assert
        $this->assertEquals("", $result);
    }
}
