<div class="row">
    <div class="form-group col-sm-12 col-lg-6">
        <label for="multigpId">Multigp ID<span class="badge badge-danger">Optional</span></label>
        <input name="multigpId" type="text" class="form-control @error('multigpId') is-invalid @enderror" id="multigpId"
            placeholder="" value="{{ !isset($event->multigpId) ? old('multigpId') : $event->multigpId }}">
        @error('multigpId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group col-sm-12 col-lg-6">
        <label for="name">Name<span class="badge badge-danger">Required</span></label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder=""
            required="" value="{{ !isset($event->name) ? old('name') : $event->name }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-sm-12 col-lg-6">
        <label for="location">Location<span class="badge badge-danger">Required</span></label>
        <input name="location" type="text" class="form-control @error('location') is-invalid @enderror" id="location"
            placeholder="" required="" value="{{ !isset($event->location) ? old('location') : $event->location }}">
        @error('location')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-sm-12 col-lg-6">
        <label class="control-label" for="classId">Class<span class="badge badge-danger">Required</span></label>
        <select name="classId" id="classId" class="form-control @error('classId') is-invalid @enderror"
            data-toggle="select2" data-allow-clear="false">
            @foreach ($classes as $class)
            <option value="{{$class->classId}}" @if(isset($event->classId)) @if($class->classId == $event->classId)
                selected @endif @endif>{{$class->name}}</option>
            @endforeach
        </select>
        @error('classId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-sm-12 col-lg-6">
        <label class="control-label" for="date">Date<span class="badge badge-danger">Required</span></label>
        <input value="{{ !isset($event->date) ? old('date') : $event->date }}" name="date" id="date" type="text"
            class="form-control @error('date') is-invalid @enderror" data-toggle="flatpickr" data-enable-time="true"
            data-date-format="Y-m-d H:i" data-allow-input="true" autocomplete="off">
        @error('date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-12">
        <label for="dropzone">Photo {{(Route::currentRouteName() == 'event.edit' ? '**Empty to keep same photo' : ' ')}}
            <span
                class="badge badge-danger">{{(Route::currentRouteName() == 'event.edit' ? 'Optional' : 'Optional')}}</span></label>
        <div id="dropzone" class="fileinput-dropzone">
            <span>Drop files or click to upload.</span>
            <!-- The file input field used as target for the file upload widget -->
            <input name="photo" type="file" class="form-control-file @error('photo') is-invalid @enderror"
                id="fileupload-dropzone">
        </div>
        @error('photo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>