<form id="form-select-event">
    <div class="form-group row">
        <label for="eventId" class="col-md-4 col-form-label text-md-right">Event</label>
        <div class="col-md-6">
            <select name="eventId" class="select2 form-control @error('eventId') is-invalid @enderror" id="eventId">
                @foreach ($events as $event)
                <option value="{{$event->eventId}}">
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

</form>
<div class="inputs-title row">
    <div class="col-sm-12 col-md-3">
        Pilot
    </div>
    <div class="col-sm-12 col-md-3">
        Position
    </div>
    <div class="col-sm-12 col-md-3">
        Notes
    </div>
    <div class="col-sm-12 col-md-3">

    </div>
</div>
<input type="hidden" value="0" id="form-count">
<div id="result-form-content">

</div>