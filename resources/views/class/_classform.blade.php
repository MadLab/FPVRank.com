<div class="row">
    <div class="form-group col-6">
        <label for="classId">ID<span class="badge badge-danger">Required</span></label>
        <input name="classId" type="text" class="form-control @error('classId') is-invalid @enderror" id="classId" placeholder="" required="" value="{{ !isset($class->classId) ? old('classId') : $class->classId }}">
        @error('classId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label for="name">Name<span class="badge badge-danger">Required</span></label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="" required="" value="{{ !isset($class->name) ? old('name') : $class->name }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label for="description">Description<span class="badge badge-danger">Required</span></label>
        <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="name" placeholder="" required="" value="{{ !isset($class->description) ? old('description') : $class->description }}">
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label class="control-label" for="location">Location<span class="badge badge-danger">Required</span></label>
        <select name="location" id="location" class="form-control @error('location') is-invalid @enderror" data-toggle="select2" data-allow-clear="false">
            <option value="global">Global</option>
            @foreach ($countries as $key => $country)
            <option value="{{$key}}" @if(isset($class->location)) @if($class->location == $key) selected @endif @endif>{{$country}}</option>
            @endforeach
        </select>
        @error('location')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
