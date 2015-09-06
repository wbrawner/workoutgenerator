@extends('layouts.master')

@section('title', 'Add an Exercise')
@section('header')

@section('content')
<div class="content">
	<h1>Add a New Exercise</h1>
	<fieldset>
	{!! Form::open() !!}

		{!! Form::text('name', null, ['placeholder'=>'Name']) !!}

	{!! Form::close() !!}
	</fieldset>
</div>
@endsection