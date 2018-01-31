<?php


use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Carbon\Carbon;
class AirportsTableSeeder extends CsvSeeder
{
	public function __construct()
	{
		$this->table = 'airports';
		$this->csv_delimiter = ',';
		$this->filename = base_path().'/database/seeds/csv/aeropuertos.csv';
		$this->offset_rows = 1;
		$this->mapping = [  
			0 => 'id',
			1 => 'Name',
			2 => 'City',
			3 => 'Country',
			4 => 'IATA',
			5 => 'ICAO',
			6 => 'Latitude',
			7 => 'Longitude',
			8 => 'Altitude',
			9 => 'Timezone',
			10=> 'DST',
			11=> 'Tz',
			12=> 'Type',
			13=> 'Source'
		];
		$this->should_trim = true;
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Inicio - Carga de lista de todos los aeropuertos.');
  
        // Se realiza un truncate a la tabla en caso que sea necesario
        DB::table($this->table)->truncate();
        // Recomendado cuando importo grandes cantidades de datos
        DB::disableQueryLog();

        
        parent::run();
        //actualizo las fecha de creacion de la base de datos
        DB::table($this->table)->update(['updated_at' => Carbon::now(), 'created_at' => Carbon::now()]);
        $this->command->info('Fin -'.Carbon::now());
    }
}