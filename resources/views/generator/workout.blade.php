@extends('layouts.master')

@section('title', 'Home')

@section('header')

@section('content')
<div class="content">
	<h1>{{ $goal }} - {{ $experience }} - {{ $frequency }} Day Split</h1>
	<br style="clear:both;" />
	<p style="text-align:center;">This part is still under development, but check back soon!</p>
	
	@for ($i = 0; $i < $frequency; $i++)
	<table class="workout">
		<h2>{{ $headers[$i] }}</h2>
		<th>Exercise</th>
		<th>Sets:</th>
		<th>Reps:</th>
		@for ($i = 0; $i < count)
		<tr>
			<td>{{ $goal }}</td>
			<td>{{ $preferences }}</td>
			<td>{{ $experience }}</td>
			<td>{{ $frequency }} days per week</td>
		</tr>
	</table>
	@endfor 
</div>
@endsection