@extends('layouts.app')

@section('content')
	<!-- BEGIN AIRPORTS SECTION -->
	
	<span id="print-msg"></span>
	<section id="airports" class="">
		<div class="container">
			<div class="row">
				<div id="airports-info" class="col-sm-12">
					<h3 class="center">Aeropuertos de <br>USA</h3>
					
					<div id="airport-info">
						<div class="featured">
							<div class="icon"><i class="icon-map-marker"></i></div>
							<h4>Seleccione un Origen y un Destino</h4>
						</div>
						<form method="POST" action="{{ url('/airport') }}">
							{{ csrf_field() }}
							<div class="date col-sm-12">
							  <div class="form-group">
							    <label for="select-city">Origen: </label>
										<select name="origen"  id="select-city-origin" class="form-control select2-choice select2-default">
										<option ></option>
											@foreach($list_airports as $row)
												<option value="{{ $row->id	 }}">{{ $row->Name }}</option>
											@endforeach

										</select> 
							  </div>							

							  <div class="form-group">
							    <label for="select-city">Destino:</label>
										<select name="destino" id="select-city-dest" class="form-control select2-choice select2-default">
										<option ></option>
											@foreach($list_airports as $row)
												<option value="{{ $row->id	 }}">{{ $row->Name }}</option>
											@endforeach

										</select> 
							  </div>

							  <div class="form-group">
								   <center> 
								   		  <button type="submit" value="Submit" class="btn btn-default btn-icon" ><i class="icon-long-arrow-right"></i><span>Calcular Ruta</span></button>
								   				  	
								   	</center>
							  </div>

							</div> 
						</form>
						<div class="location col-sm-12"></div> 
					</div>
					
					<div class="buttons-area col-sm-12">
						<button id="complete-list-btn" class="btn btn-dark2">Ver lista de Aeropuertos</button>
					</div>
					
					<div id="complete-list">
						<i class="icon-remove-circle close-complete-list"></i>
						<div id="list"></div>
					</div> 
				</div>
			</div>
		</div>
		
		<div id="map_canvas" class=""></div>
	</section>
	<div id="example" width='20px' class=""></div>
	<!-- END AIRPORTS SECTION -->
	<input type="hidden" id="status-All-Airport" value=''>

@endsection
@section('footer')
<script type="text/javascript">
	//get List Airports Usa
	var myAirports = '@php print_r(json_encode($airports)); @endphp';
	myAirports = JSON.parse(myAirports);
	Airport.init();

</script>

@endsection