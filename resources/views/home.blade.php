@extends('layouts.master')

@section('title', 'Home')

@section('header')

@section('content')
<div class="content">
	<div class="banner">
	    <img src={{ asset('assets/images/banner.jpg') }} class="banner">
    	<h1>Need help with your workouts? We've got you covered.<br />
    	<a href='/generate'><button class="home-button">Generate My Workout</button></a></h1>
    </div>
    <div class="content-section">
    	<div class="content-box">
    	    <h2>How does it work?</h2>
        	<p>It's simple, really. You tell us a little bit about yourself: your goals, experience, and preferences, 
        	and we take care of the rest. You'll get a complete workout routine including warm-ups, stretches, 
        	cool-downs, the number of sets and reps you should be doing for each exercise, and occasional 
        	nutritional tips to help you reach your goals even faster. If you'd like, you can even add in some 
        	custom exercises to make your experience even more personalized.</p>
        </div>
    </div>
    <br style="clear:both;"/>
    <div class="content-section">
    	<div class="content-box" style="float:right;">
    		<h2>Why random generation?</h2>
	    	<p>One of the primary pillars of fitness is <b>periodization</b>. Studies have shown that after about 2-3 weeks, 
	    	your body begins to adapt to the challenges you give it, which means you'll still be putting in the work 
	    	but you won't be seeing the results. Periodization is the process of changing up the structure of your 
	    	routine to prevent you from adapting to it. Say goodbye to plateaus!</p>
	    </div>
    </div>
    <br style="clear:both;"/>
    <div class="content-section">
    	<div class="content-box">
    		<h2>Still not convinced?</h2>
	    	<p>Don't take our word for it, sign up and try it out today!<br /></p>
	    </div>
        <div class="content-box">
            <p><a href='/generate'><button class="home-button">Get Started</button></a></p>
        </div>
    </div>
</div>
@endsection
