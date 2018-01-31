<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    public function allAirportsUsa()
    {

         $airports=Airport::where('Country','=','United States')
        ->select('id','Name','City','Country','IATA','Latitude','Longitude')
        ->get();
        return $airports;
    }
} 
