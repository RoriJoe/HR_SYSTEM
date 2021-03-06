@extends('widget_templates.'.($widget_template ? $widget_template : 'plain'))

@section('widget_title')
	<h1> {!! $widget_title  or 'Data Kalender' !!} </h1>
@overwrite

@section('widget_body')
	<div class="row">
		<div class="col-md-12">
			<h4 class="title-calendar font-30 mb-30"></h4>			
			<div class="sk-spinner sk-spinner-fading-circle spinner-loading-schedule">
				<div class="sk-circle1 sk-circle"></div>
				<div class="sk-circle2 sk-circle"></div>
				<div class="sk-circle3 sk-circle"></div>
				<div class="sk-circle4 sk-circle"></div>
				<div class="sk-circle5 sk-circle"></div>
				<div class="sk-circle6 sk-circle"></div>
				<div class="sk-circle7 sk-circle"></div>
				<div class="sk-circle8 sk-circle"></div>
				<div class="sk-circle9 sk-circle"></div>
				<div class="sk-circle10 sk-circle"></div>
				<div class="sk-circle11 sk-circle"></div>
				<div class="sk-circle12 sk-circle"></div>
			</div>
			<div id="calendar"></div>	
		</div>
	</div>
@overwrite	
