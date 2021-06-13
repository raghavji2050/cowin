@extends('layout')

@section('content')
	<div class="container">
		<table class="table table-bordered">
		  <thead class="thead-dark">
			<tr>
			  <th scope="col">Id</th>
			  <th scope="col">Name</th>
			  <th scope="col">Count</th>
			  <th scope="col">Districts</th>
			</tr>
		  </thead>
		  <tbody>
			@foreach($states as $state)
				<tr>
					<th>
						{{ $state['id'] }}
					</th>
					<th>
						{{ $state['name'] }}
					</th>
					<th>
						{{ count($state['districts']) }}
					</th>
					<th>
						{!! implode(", <br>", array_column($state['districts'], 'name')) !!}
					</th>
				</tr>
			@endforeach
		  </tbody>
		</table>
	</div>
@endsection