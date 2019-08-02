<div class="form-group row">
    <label for="eventId" class="col-md-4 col-form-label text-md-right">Event</label>
    <div class="col-md-6">
        <select name="eventId" class="form-control @error('eventId') is-invalid @enderror" id="eventId">
            @foreach ($events as $event)
            <option value="{{$event->eventId}}" 
                @if(isset($result->eventId)) @if($event->id == $result->eventId) selected @endif @endif>
                {{$event->name}}</option>
            @endforeach
        </select>
        @error('eventId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="pilotId" class="col-md-4 col-form-label text-md-right">Pilot</label>
    <div class="col-md-6">
        <select name="pilotId" class="form-control @error('pilotId') is-invalid @enderror" id="pilotId">
            @foreach ($pilots as $pilot)
            <option value="{{$pilot->pilotId}}" 
                @if(isset($result->pilotId)) @if($pilot->id == $result->pilotId) selected @endif @endif>
                {{$pilot->name}}</option>
            @endforeach
        </select>
        @error('pilotId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="position" class="col-md-4 col-form-label text-md-right">Position</label>
    <div class="col-md-6">
        <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" 
        name="position" value="{{ !isset($result->position) ? old('position') : $result->position }}" 
        required autocomplete="position">
        @error('position')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="notes" class="col-md-4 col-form-label text-md-right">Notes</label>
    <div class="col-md-6">
        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" 
        id="notes" rows="3">{{ !isset($result->notes) ? old('notes') : $result->notes }}</textarea>
        @error('notes')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
