@component('layouts.app')

@slot('pageTitle')
Create class
@endslot

@slot('pageTitle2')

@endslot

@slot('imageCover')

@endslot

@slot('pageCover')

@endslot

@slot('floatingButton')
<button class="btn btn-primary btn-floated" type="button" data-toggle="modal" data-target="#jsonmodal"><span data-toggle="tooltip" data-placement="top" title="Upload classes with JSON" class="fa fa-file-import"></span>
</button>
@endslot

@slot('searchBar')

@endslot
@component('components.modal')
@slot('id')
jsonmodal
@endslot
@slot('title')
<div id="modaltitle">
    Create classes with JSON
</div>
@endslot
@slot('button')
<div id="modalbutton">

</div>
@endslot
<div id="modalcontent">
    <form method="POST" action="{{ route('class.storejson') }}">
        @csrf
        @include('components._jsonform', ['rows' => 8])
    </form>
    <hr class="separator-line">
    <div>**If JSON contains same classId as in the database, data will be updated!</div>
</div>
@endcomponent
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('class.store') }}">
            @csrf
            <fieldset>
                <legend>Class info</legend>
                <div class="row">
                    <div class="form-group col-6">
                        <label>Last ID</label>
                        <input class="form-control" type="text" class="form-control" value="{{isset($lastClassId) ? $lastClassId : ' '}}" readonly>
                    </div>
                </div>
                @include('class._classform')
            </fieldset>
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit">Save</button>
        </form>
    </div>
</div>
@endcomponent
