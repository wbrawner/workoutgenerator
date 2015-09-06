@extends('layouts.master')

@section('title', 'Home')

@section('header')

@section('content')
<div class="content">
	<h1>Your Workout, Should You Choose to Accept It...</h1>
	<br style="clear:both;" />
	<p style="text-align:center;">This part is still under development, but check back soon!</p>
	{{-- <table class="workout">
		<th>Your Goal:</th>
		<th>Your Preferred Workout Types:</th>
		<th>Your Experience:</th>
		<th>Your Desired Workout Frequency:</th>
		<tr>
			<td>{{ $goal }}</td>
			<td>{{ $preferences }}</td>
			<td>{{ $experience }} months</td>
			<td>{{ $frequency }} days per week</td>
		</tr>
	</table>--}}
	<br style="clear:both;" />	 
</div>
@endsection