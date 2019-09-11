<div class="form-group row">
    <label for="classId" class="col-md-4 col-form-label text-md-right">ID</label>
    <div class="col-md-6">
        <input id="classId" type="text" class="form-control @error('classId') is-invalid @enderror"
        name="classId" value="{{ !isset($class->classId) ? old('classId') : $class->classId }}" required
        autocomplete="name" autofocus>
        @error('classId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
        name="name" value="{{ !isset($class->name) ? old('name') : $class->name }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
    <div class="col-md-6">
        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
        name="description"
        value="{{ !isset($class->description) ? old('description') : $class->description }}" required autocomplete="email">
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="location">Location</label>
    <div class="col-md-6">
        <select name="location" class="select2 form-control @error('location') is-invalid @enderror" id="location">
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
