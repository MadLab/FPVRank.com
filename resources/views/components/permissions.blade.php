<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{$labelTitle}}</label>
    <div class="col-md-3">
        <input type="checkbox" class="form-check-input form-control" name="{{$createName}}" {{$createValue == '1' ? 'checked' : ' '}}>
    </div>
    <div class="col-md-3">
        <input type="checkbox" class="form-check-input form-control" name="{{$editName}}" {{$editValue == '1' ? 'checked' : ' '}}>
    </div>
</div>
