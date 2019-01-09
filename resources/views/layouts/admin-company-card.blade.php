<div class="card company flex-fill col-2 px-0 mr-5 mt-5">
    <div class="card-header d-flex justify-content-between">
        {{$company->name}}
        {{--<a href="home/{{$company->id}}/delete" class="close">&times;</a>--}}
        {{ Form::open(['action' => ['CompaniesController@destroy',$company->id], 'method' => "POST"]) }}
            {{ Form::hidden('_method','DELETE') }}
            {{ Form::submit('x',['class'=>'close']) }}
        {{ Form::close() }}
    </div>
    <div class="card-body">
        {{-- HTML::image($company->image, '', array('class' => 'image')) --}}
        <img src="{{ Storage::url($company->logo) }}" alt="" style="width: 100%; height: auto">
        {{--<img src="{{ asset('public/storage/'.$company->logo) }}" alt="">--}}
        <div class="card-content mt-3">
            <h4>{{$company->address}}</h4>
            <blockquote>{{$company->description}}</blockquote>
            {{--<a class="btn btn-secondary company_change" href="{{ route('company.edit',['id'=>$company->id]) }}" onclick="updateCompany( {{ json_encode($company) }} )">Change</a>--}}
            {{ Form::open(['action' => ['CompaniesController@edit',$company->id], 'method' => "POST"]) }}
                {{ Form::hidden('_method','POST') }}
                {{ Form::submit('Edit',['class'=>'btn btn-secondary company_change']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>