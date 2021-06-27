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
			@forelse($states as $state)
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
						@foreach($state['districts'] as $district)
							<a href="{{ route('centers.index', ['district' => $district['id']]) }}">
								{{ $district['name'] }}
							</a>
							<br>
						@endforeach
					</th>
				</tr>
			@empty
				<tr >
					<th colspan="6" class="text-center">
						No data found
					</th>
				</tr>
			@endforelse
		  </tbody>
		</table>
	</div>
@endsection