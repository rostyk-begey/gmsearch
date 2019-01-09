@extends('layouts.app')

@section('content')


    <div class="container-fluid px-5">
        @if( Session::get('flash_message') )
            <div class="row col-12 h-auto justify-content-between px-4 hide">
                <div class="alert col-12 alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
        <div class="row col-12 h-auto justify-content-between px-4">
            <div id="map" class="card col-8 px-0">
            </div>
            <!-- ######################################################## -->
            <div class="card col-3 px-0">
                <div class="card-header" id="form_name">{{ __('Add company') }}</div>
                <div class="card-body">
                    @include('layouts.form-add')
                </div>
            </div>
        </div>
    </div>

@endsection
