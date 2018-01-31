<?php

namespace App\Http\Controllers;
use Bodunde\GoogleGeocoder\Geocoder;
use Illuminate\Http\Request;
use App\Airport;
use App\Http\Requests\RequestAirport;
use App\Repositories\Airport\IAirportRepository;
class AirportController extends Controller
{


    protected $airports;

    public function __construct(IAirportRepository $airports)
    {
        $this->airports = $airports;
    }
    /**
     * funcion creada para responder a una llamada ajax, retornara toda la lista de aeropuertos de USA
     * @return [json]
     */
    public function all(){
        $airports  = $this->airports->all();
        return response()->json(array('data' =>$airports));
    }
    /**
     *Para no hacer lenta la carga al momento de retornar toda la lista de Aeropuertos 
     *se muestra solo un Aeropuerto en el Centro del Mapa de USA
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airports      =  $this->airports->getOneAirport('4343');
        $list_airports =  $this->airports->all();
        return view('airports.index',[
                        'airports'      => $airports,
                        'list_airports' => $list_airports
            ]);

    }


        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(RequestAirport $request)
        {

             $origen        = $this->airports->getOneAirport($request->origen);
             $destino       = $this->airports->getOneAirport($request->destino);
             $list_airports = $this->airports->all();
             $latLong       = array('origen'=>$origen , 'destino' => $destino);

              $geocoder      = new Geocoder;
             
              $location1 = [
                    "lat" => $origen[0]['Latitude'],
                    "lng" => $origen[0]['Longitude'],
              ];

              $location2 = [
                    "lat" => $destino[0]['Latitude'],
                    "lng" => $destino[0]['Longitude'],
              ];
               // calcula la distancia entre dos puntos, como parametros le envio las coordenadas de ambos puntos
              $distance = array(
                'Millas Naúticas' => $geocoder->getDistanceBetween($location1, $location2,'nmi'),
                'Kilometros'      => $geocoder->getDistanceBetween($location1, $location2,'km'),
                'Millas'          => $geocoder->getDistanceBetween($location1, $location2,'mi')
          ); 
             
             return view('airports.distance',[
                            'list_airports' => $list_airports,
                            'distance'      => $distance,
                            'latLong'       => $latLong]);
             
    }              


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
