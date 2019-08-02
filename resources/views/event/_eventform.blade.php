<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
        name="name" 
        value="{{ !isset($event->name) ? old('name') : $event->name }}" 
        required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
    <div class="col-md-6">
        <input id="location" type="text" class="form-control @error('location') is-invalid @enderror"
         name="location" value="{{ !isset($event->location) ? old('location') : $event->location }}" 
         required autocomplete="location">
        @error('location')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="classId" class="col-md-4 col-form-label text-md-right">Class</label>
    <div class="col-md-6">
        <select name="classId" class="form-control @error('classId') is-invalid @enderror" id="classId">
            @foreach ($classes as $class)
            <option value="{{$class->classId}}" @if(isset($event->classId)) @if($class->classId == $event->classId) selected @endif @endif>{{$class->name}}</option>
            @endforeach
        </select>
        @error('classId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="date" class="col-md-4 col-form-label text-md-right">Date</label>
    <div class="col-md-6">
        <div class="input-group date form_datetime" data-date-format="dd MM yyyy - HH:ii p" 
            data-link-field="date">
            <input class="form-control @error('date') is-invalid @enderror" size="16" type="text" value="{{ !isset($event->date) ? old('date') : $event->date }}" readonly>
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input name="date" type="hidden" id="date" value="{{ !isset($event->date) ? old('date') : $event->date }}" /><br />
        @error('date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
