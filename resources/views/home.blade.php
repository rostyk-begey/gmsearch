@extends('layouts.app')

@section('content')


<div class="container-fluid px-5 h-100">
    @if( Session::get('flash_message') )
        <div class="row col-12 h-auto justify-content-between px-4 hide">
            <div class="alert col-12 alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('flash_message') }}
            </div>
        </div>
    @endif
        @if( Session::get('flash_message') )
            <div class="row h-auto justify-content-between hide">
                <div class="alert col-12 alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
    <div class="row map-row">
        <div id="map" class="card" >
        </div>
        <!-- ######################################################## -->
        {{--<div class="card col-2 px-0 h-75">
            <div class="card-header" id="form_name">{{ __('Find company') }}</div>
            <div class="card-body">
                @include('layouts.form-find')
            </div>
        </div>--}}
    </div>
    <div class="row companies-grid mx-0">
        @foreach($companies as $company)
            @include('layouts.home-company-card')
        @endforeach
    </div>
</div>

@endsection
