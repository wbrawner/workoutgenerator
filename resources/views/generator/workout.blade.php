@extends('layouts.master')

@section('title', 'Home')

@section('header')

@section('content')
<div class="content">
	<h1>{{ $goal }} - {{ $experience }} - {{ $frequency }} Day Split</h1>
	<br style="clear:both;" />
	<p style="text-align:center;">This part is still under development, but check back soon!</p>
	@foreach ($days as $day)
	<table class="workout">
		<h2>{{ $day['name'] }}</h2>
		<th>Exercise</th>
		<th>Sets:</th>
		<th>Reps:</th>
		@foreach ($day['exercises'] as $exercise)
		<tr>
			<td>{{ $exercise }}</td>
			<td>{{ $sets }}</td>
			<td>{{ $reps }}</td>
		</tr>
		@endforeach
	</table>
	@endforeach
@endsection