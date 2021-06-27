@extends('layout')

@section('content')
	<div class="container">
		<form action="{{ route('centers.index') }}" method="get" class="mb-5">
			<div class="row col-12">
				<div class="col-3">
					<select class="form-control" name="district" onchange="this.form.submit()">
						<option value="">District</option>
						@foreach($districts as $districtData)
							<option value="{{ $districtData->id }}" @if($districtData->id == request()->district) selected @endif>
								{{ $districtData->name }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			@if($blocks->count())
				<div class="row col-12">
					<div class="col-3">
						<select class="form-control" name="block" onchange="this.form.submit()">
							<option value="">Block</option>
							@foreach($blocks as $blockData)
								<option value="{{ $blockData->block_name }}" @if($blockData->block_name == request()->block) selected @endif>
									{{ $blockData->block_name }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
			@endif
			<div class="table-responsive">
				<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
					<th scope="col">District Name</th>
					<th scope="col">Center Id</th>
					<th scope="col">Name</th>
					<th scope="col">Address</th>
					<th scope="col">Block Name</th>
					<th scope="col">Pin Code</th>
					</tr>
				</thead>
				<tbody>
					@forelse($centers as $center)
						<tr>
							<th>
								{{ $center->district_name }}
							</th>
							<th>
								<a href="{{ route('sessions.index', ['center' => $center->id]) }}">
									{{ $center->id }}
								</a>
							</th>
							<th>
								<a href="{{ route('sessions.index', ['center' => $center->id]) }}">
									{{ $center->name }}
								</a>
							</th>
							<th>
								{{ $center->address }}
							</th>
							<th>
								{{ $center->block_name }}
							</th>
							<th>
								{{ $center->pincode }}
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
		{{ $centers->appends(['district' => request()->district, 'block' => request()->block])->links() }}
		</form>
	</div>
@endsection