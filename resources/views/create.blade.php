@extends('layouts.master')

@section('title', 'Add an Exercise')
@endsection

{{!! Form::open() !!}}

	{{!! Form::text('Name') !!}}

{{ Form::close() !!}}

@section('content')

@endsection