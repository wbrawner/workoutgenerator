@extends('layouts.master')

@section('title', 'Exercises')

@section('content')
<div class="content">
	<table>
        <tr>
            <td>Name</td>
            <td>Muscle Group</td>
            <td>Type</td>
        </tr>
        @foreach ($exercises as $exercise)
            <tr>
                <td>{{ $exercise->exercise_name }}</td>
                <td>{{ $exercise->muscle_group }}</td>
                <td>{{ $exercise->exercise_type }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
