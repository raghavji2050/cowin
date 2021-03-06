@extends('layout')

@section('content')
	<div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
					{{ env('APP_NAME') }}
				</div>

				<div class="links">
					<a href="{{ route('states.index') }}">States</a>
                    <a href="{{ route('centers.index') }}">Centers</a>
					<a href="{{ route('sessions.index') }}">Sessions</a>
				</div>
            </div>
        </div>
@endsection