<?php

namespace App;

interface IWeatherService
{
    public function getTemperature($lat, $lon);
}