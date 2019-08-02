<label class="label-mobile mx-auto"> ---------- New entry ----------</label>
<form class="row" id="form{{$count}}">
@csrf
<input type="hidden" name="resultId" id="resultId{{$count}}" value="">
    <div class="col-sm-12 col-md-3">
        <label class="label-mobile">Pilot</label>
        <select class="select2 form-control @error('pilotId') is-invalid @enderror" name="pilotId">
            @foreach ($pilots as $pilot)
            <option value="{{$pilot->pilotId}}">
                {{$pilot->name}}</option>
            @endforeach
        </select>
        @error('pilotId')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-2">
    <label class="label-mobile">Position</label>
        <input type="number" class="form-control @error('position') is-invalid @enderror" 
        name="position" value="" autocomplete="position" id="position{{$count}}">
        @error('position')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-5">
    <label class="label-mobile">Notes</label>
        <input type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" 
        value="" autocomplete="off">
        @error('notes')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-12 col-md-1">
        <a onclick="saveForm({{$count}})" class="btn btn-success text-white">
            Save
        </a>
    </div>
    </div>