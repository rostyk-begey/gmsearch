

{{ Form::open(['url' => route('company.add'), 'method' => "POST", 'files' => true]) }}
    <div class="form-row">
        <div class="form-group col-md-5 avatar-upload">
            <div class="avatar-edit">
                {{ Form::file('logo',['id'=>'logo',"accept"=>".png, .jpg, .jpeg, .svg"]) }}
                {{ Form::label('logo', ' ') }}
            </div>
            <div class="avatar-preview">
                <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                </div>
            </div>
        </div>
        <div class="form-group col-md-7">
            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name','',['class'=>"form-control",'required'=>'required','autofocus'=>'autofocus','placeholder'=>"Name"]) }}
            </div>
            <div class="form-group">
                {{ Form::label('address', 'Address') }}
                {{ Form::text('address','',['class'=>"form-control",'required'=>'required','placeholder'=>"Address"]) }}
            </div>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description','',['class'=>"form-control",'required'=>'required','placeholder'=>"Description"]) }}
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            {{ Form::label('latitude', 'Latitude') }}
            {{ Form::number('latitude', 0, ['step'=>'any',"onchange"=>"moveMarker(this)", "class"=>"form-control","required"=>"required"]) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('longitude', 'Longitude') }}
            {{ Form::number('longitude', 0, ['step'=>'any',"onchange"=>"moveMarker(this)", "class"=>"form-control","required"=>"required"]) }}
        </div>
    </div>
    {{--<div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Check me out
            </label>
        </div>
    </div>--}}
    {{ Form::submit('Add company',['class'=>'btn btn-primary', 'id'=>'form_submit']) }}
{{ Form::close() }}