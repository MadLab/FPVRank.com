<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{$labelTitle}}</label>
    <div class="col-md-3 text-center">
        <div>
            <input type="checkbox" id="{{$createName}}" name="{{$createName}}" {{$createValue == '1' ? 'checked' : ' '}}>
        </div>
    </div>
    <div class="col-md-3 text-center">
        <div>
            <input type="checkbox" id="{{$editName}}" name="{{$editName}}" {{$editValue == '1' ? 'checked' : ' '}}>
        </div>
    </div>
</div>
