<div class="card company col-sm-2 px-0 mr-5 mt-5">
    <div class="card-header d-flex justify-content-between">
        {{$company->name}}
    </div>
    <div class="card-body">
        {{-- HTML::image($company->image, '', array('class' => 'image')) --}}
        <img src="{{ Storage::url($company->logo) }}" alt="" style="width: 100%; height: auto">
        {{--<img src="{{ asset('public/storage/'.$company->logo) }}" alt="">--}}
        <div class="card-content mt-3">
            <h4>{{$company->address}}</h4>
            <p>{{$company->description}}</p>
        </div>
    </div>
</div>