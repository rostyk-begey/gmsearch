@extends('layouts.app')

@section('content')
    <div class="container-fluid px-5">
        @if( Session::get('flash_message') )
            <div class="row h-auto justify-content-between hide">
                <div class="alert col-12 alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
        <div class="row h-auto justify-content-between">

            <div id="map" class="card col-8 px-0">
            </div>
        {{--<div class="card">
            <div class="card-header">{{ __('Add company') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('addCompany') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

                        <div class="col-md-6">
                            <input id="logo" type="file" class="form-control-file form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}" name="logo" value="{{ old('logo') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('logo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="input-group row">
                        <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>
                        --}}{{----}}{{--<div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>--}}{{----}}{{--
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>-

                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus>

                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>

                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="latitude" class="col-md-4 col-form-label text-md-right">{{ __('Zip code') }}</label>

                        <div class="col-md-6">
                            <input id="zip_code" type="number" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" name="zip_code" required>

                            @if ($errors->has('zip_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('zip_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="latitude" class="col-md-4 col-form-label text-md-right">{{ __('latitude') }}</label>

                        <div class="col-md-6">
                            <input id="latitude" type="number" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" required>

                            @if ($errors->has('latitude'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('latitude') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="longitude" class="col-md-4 col-form-label text-md-right">{{ __('Longitude') }}</label>

                        <div class="col-md-6">
                            <input id="longitude" type="number" class="form-control" name="longitude" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>--}}
        <!-- ######################################################## -->
            <div class="card col-3 px-0 mr-0">
                <div class="card-header" id="form_name">
                @if(Route::current()->getName() == 'admin.companies')
                    {{ __('Add company') }}
                @else
                    {{ __('Update company') }}
                @endif
                </div>
                <div class="card-body">
                    @if(Route::current()->getName() == 'admin.companies')
                        @include('layouts.form-add')
                    @else
                        @include('layouts.form-update')
                    @endif
                </div>
            </div>
        </div>
        <div class="row companies-grid justify-content-start card-deck">
            @foreach($companies as $company)
                @include('layouts.admin-company-card')
            @endforeach
        </div>
    </div>

@endsection
