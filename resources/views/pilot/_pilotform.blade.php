<div class="row">
    <div class="form-group col-sm-12 col-lg-6">
        <label for="pilotId">ID<span class="badge badge-danger">Required</span></label>
        <input name="pilotId" type="text" class="form-control @error('pilotId') is-invalid @enderror" id="pilotId"
            placeholder="" required="" value="{{ !isset($pilot->pilotId) ? old('pilotId') : $pilot->pilotId }}">
        @error('pilotId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-sm-12 col-lg-6">
        <label for="name">Name<span class="badge badge-danger">Required</span></label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder=""
            required="" value="{{ !isset($pilot->name) ? old('name') : $pilot->name }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-sm-12 col-lg-6">
        <label for="username">Username<span class="badge badge-danger">Required</span></label>
        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username"
            placeholder="" required="" value="{{ !isset($pilot->username) ? old('username') : $pilot->username }}">
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-sm-12 col-lg-6">
        <label class="control-label" for="country">Country<span class="badge badge-danger">Optional</span></label>
        <select name="country" id="country" class="form-control @error('country') is-invalid @enderror"
            data-toggle="select2" data-allow-clear="false">
            <option value="null">Select a country</option>
            @foreach ($countries as $key => $country)
            <option value="{{$key}}" @if(isset($pilot->country)) @if($pilot->country == $key) selected @endif
                @endif>{{$country}}</option>
            @endforeach
        </select>
        @error('country')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-12">
        <label for="dropzone">Photo {{(Route::currentRouteName() == 'pilot.edit' ? '**Empty to keep same photo' : ' ')}}
            <span
                class="badge badge-danger">{{(Route::currentRouteName() == 'pilot.edit' ? 'Optional' : 'Optional')}}</span></label>
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