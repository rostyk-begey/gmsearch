<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @if(Route::current()->getName() != 'login')
    <script>
        //alert("{{-- Route::current()->getName() --}}");
        let companies = [
            @forEach($companies as $company)
            {
                name: "{{$company->name}}",
                address: "{{ $company->address }}",
                description: "{{ $company->description }}",
                position: { lat: {{$company->latitude}}, lng: {{$company->longitude}} },
                icon: "{{ Storage::url($company->logo) }}"
            },
            @endforeach
        ];
        //console.log(companies);
    </script>
    @endif
    <script src="{{ asset('js/form-avatar.js') }}" defer></script>
    <script src="{{ asset('js/map.js') }}" defer></script>
    <script src="{{ asset('js/common.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="h-100">
        @include('layouts.navbar')

        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTXEzLVBB74OafvjeLO0wpCHcqrx7PkxA&callback=initMap">
</script>
</html>
