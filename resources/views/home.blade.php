@extends('layouts.master')

@section('title', 'Home')

@section('header')

@section('content')
<div class="content">
	<div class="banner">
	    <img src={{ asset('assets/images/banner.jpg') }} class="banner">
    	<h1 class="banner_text">Need help with your workouts? We've got you covered.<br />
    		<a href='/generate'><button>Generate My Workout</button></a></h1>
    </div>
</div>
@endsection
