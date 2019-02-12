<?php

namespace App\Http\Controllers;

use App\IWeatherService;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    /**
     * @var IWeatherService
     */
    private $weatherService;

    public function __construct(IWeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index()
    {
        return view("temperature", [
            "temp" => $this->weatherService->getTemperature(53.2423778, 34.3668288)
        ]);
    }
}
