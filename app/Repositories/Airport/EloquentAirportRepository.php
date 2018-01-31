<?php
namespace App\Repositories\Airport;

use App\Airport;
use Illuminate\Support\Facades\Hash;
use DB;
class EloquentAirportRepository implements IAirportRepository
{ 
    /**
     * Consulta la lista de todos los aeropuertos de USA.
     * @return [array]
     */
    public function all()
    {

         $airports=Airport::where('Country','=','United States')
        ->select('id','Name','City','Country','IATA','Latitude','Longitude')
        ->get();
        return $airports;
    }

    /**
     * @param  id del aeropuerto
     * @return array
     */
    public function getOneAirport($id){
    $getOneAirport = Airport::where('Country','United States')
                ->select('id','Name','City','Country','IATA','Latitude','Longitude')
                ->where('id',$id)
                ->get();
                return $getOneAirport;
    }



    public function citysCount($id_permiso,$id)
    {

        $citys = DB::table('airports')->select( 'City',DB::raw('count(*) as total_count'))
                  ->where('Country','=','United States')
                  ->groupBy('City');
        return $citys->get();
    }




}
