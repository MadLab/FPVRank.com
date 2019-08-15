<div class="form-group row">
    <label for="jsonurl" class="col-md-4 col-form-label text-md-right">JSON URL</label>
    <div class="col-md-6">
        <input id="jsonurl" type="text" class="form-control @error('jsonurl') is-invalid @enderror" name="jsonurl" value="" required autocomplete="off">
        @error('jsonurl')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-success">
            Save
        </button>
    </div>
</div>
<div class="form-group row">
    <label for="jsonurl" class="col-md-4 col-form-label text-md-right">JSON Example</label>
    <div class="col-md-6">
        <textarea class="form-control" id="myTextarea" cols="30" rows="{{$rows}}" readonly></textarea>
    </div>
</div>