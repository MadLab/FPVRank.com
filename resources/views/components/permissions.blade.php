<div class="form-group row">
    <div class="col-4 text-center">
        <label>{{$labelTitle}}</label>
    </div>
    <div class="col-4 text-center">
        <div>
            <input type="checkbox" id="{{$createName}}" name="{{$createName}}"
                {{$createValue == '1' ? 'checked' : ' '}}>
        </div>
    </div>
    <div class="col-4 text-center">
        <div>
            <input type="checkbox" id="{{$editName}}" name="{{$editName}}" {{$editValue == '1' ? 'checked' : ' '}}>
        </div>
    </div>
</div>