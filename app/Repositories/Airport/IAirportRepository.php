<?php

namespace App\Repositories\Airport;

interface IAirportRepository
{
    public function all();
    public function getOneAirport($id);

}
