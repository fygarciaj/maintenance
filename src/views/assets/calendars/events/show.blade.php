@extends('maintenance::layouts.main')

@section('header')
	<h1>{{ $title }}</h1>
@stop

@section('content')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_event" data-toggle="tab">Profile</a></li>
            <li><a href="#tab_recurrences" data-toggle="tab">Recurrences</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_event">
                @include('maintenance::assets.events.tabs.profile', array(
                    'asset'=>$asset, 
                    'event'=>$event
                ))
            </div>
            <div class="tab-pane" id="tab_recurrences">
                @include('maintenance::assets.events.tabs.recurrences', array(
                    'asset' => $asset,
                    'event' => $event,
                    'recurrences' => $recurrences
                ))
            </div>
        </div>
    </div>

@stop