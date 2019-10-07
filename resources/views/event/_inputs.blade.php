<div class="row mobile-view-inputs" id="{{!isset($result->position) ? $count : $result->position }}">
    <input type="hidden" name="resultId[]" value="{{!isset($result->resultId)? 'null' : $result->resultId}}">
    @csrf
    <div class="form-group col-sm-12 col-md-2">
        <label class="label-mobile">Position</label>
        <input step="1" min="1" onchange="changeOrder($(this).val(), $(this).parent().parent())" type="number" class="form-control @error('position[]') is-invalid @enderror" name="position[]"
        value="{{!isset($result->position) ? $count : $result->position }}">
        @error('position[]')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-sm-12 col-md-4">
        <label class="label-mobile">Pilot</label>
        <select name="pilotId[]" id="select{{$count}}" class="form-control @error('pilotId[]') is-invalid @enderror selects" data-toggle="select2" data-allow-clear="false">
            <option value="null">Select a pilot</option>
            @foreach ($pilots as $pilot)
            @if(!isset($result->pilotId))
            <option value="{{$pilot->pilotId}}">
                {{$pilot->name}}</option>
            @else
            @if($pilot->pilotId == $result->pilotId)
            <option selected value="{{$pilot->pilotId}}">
                {{$pilot->name}}</option>
            @else
            <option value="{{$pilot->pilotId}}">
                {{$pilot->name}}</option>
            @endif

            @endif
            @endforeach
        </select>
        @error('pilotId[]')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label class="label-mobile">Notes</label>
        <input name="notes[]" type="text" class="form-control @error('notes.*') is-invalid @enderror" value="{{isset($result->notes) ? $result->notes : ' ' }}" autocomplete="off">
        @error('notes.*')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
