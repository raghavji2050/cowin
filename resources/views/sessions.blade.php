@extends('layout')

@section('content')
	<div class="container table-responsive">
		<table class="table table-bordered">
		  <thead class="thead-dark">
			<tr>
			  <th scope="col">Session Id</th>
			  <th scope="col">Date</th>
			  <th scope="col">Center Id</th>
			  <th scope="col">Name</th>
			  <th scope="col">address</th>
			  <th scope="col">state_name</th>
			  <th scope="col">district_name</th>
			  <th scope="col">block_name</th>
			  <th scope="col">pincode</th>
			  <th scope="col">from</th>
			  <th scope="col">to</th>
			  <th scope="col">lat</th>
			  <th scope="col">long</th>
			  <th scope="col">fee_type</th>
			  <th scope="col">available_capacity</th>
			  <th scope="col">available_capacity_dose1</th>
			  <th scope="col">available_capacity_dose2</th>
			  <th scope="col">fee</th>
			  <th scope="col">min_age_limit</th>
			  <th scope="col">vaccines</th>
			  <th scope="col">slots</th>
			</tr>
		  </thead>
		  <tbody>
			@foreach($sessions as $session)
				<tr>
					<th>
						{{ $session->session_id }}
					</th>
					<th>
						{{ $session->date }}
					</th>
					<th>
						{{ $session->center_id }}
					</th>
					<th>
						{{ $session->name }}
					</th>
					<th>
						{{ $session->address }}
					</th>
					<th>
						{{ $session->state_name }}
					</th>
					<th>
						{{ $session->district_name }}
					</th>
					<th>
						{{ $session->block_name }}
					</th>
					<th>
						{{ $session->pincode }}
					</th>
					<th>
						{{ $session->from }}
					</th>
					<th>
						{{ $session->to }}
					</th>
					<th>
						{{ $session->lat }}
					</th>
					<th>
						{{ $session->long }}
					</th>
					<th>
						{{ $session->fee_type }}
					</th>
					<th>
						{{ $session->available_capacity }}
					</th>
					<th>
						{{ $session->available_capacity_dose1 }}
					</th>
					<th>
						{{ $session->available_capacity_dose2 }}
					</th>
					<th>
						{{ $session->fee }}
					</th>
					<th>
						{{ $session->min_age_limit }}
					</th>
					<th>
						{{ $session->vaccines }}
					</th>
					<th>
						{!! implode(", <br>", $session->slots) !!}
					</th>
				</tr>
			@endforeach
		  </tbody>
		</table>
	</div>
	{{ $sessions->links() }}
@endsection