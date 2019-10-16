@component('layouts.app')

@slot('pageTitle')
Create pilot
@endslot

@slot('pageTitle2')

@endslot

@slot('pageCover')

@endslot

@slot('imageCover')

@endslot

@slot('floatingButton')
<button class="btn btn-primary btn-floated" type="button" data-toggle="modal" data-target="#jsonmodal"><span
        data-toggle="tooltip" data-placement="top" title="Upload pilots with JSON" class="fa fa-file-import"></span>
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
    Create pilots with JSON
</div>
@endslot
@slot('button')
<div id="modalbutton">

</div>
@endslot
<div id="modalcontent">
    <form method="POST" action="{{ route('pilot.storejson') }}">
        @csrf
        @include('components._jsonform', ['rows' => 8])
    </form>
    <hr class="separator-line">
    <div>**If JSON contains same pilotId as in the database, data will be updated!</div>
</div>
@endcomponent
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('pilot.store') }}" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend>Pilot info</legend>
                <div class="row">
                    <div class="form-group col-sm-12 col-lg-6">
                        <label>Last ID</label>
                        <input type="text" class="form-control" value="{{isset($lastPilotId) ? $lastPilotId : ' '}}"
                            readonly>
                    </div>
                </div>
                @include('pilot._pilotform')
                <div class="row justify-content-md-center">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="card card-figure">
                            <figure class="figure">
                                <img id="selectedImage" class="img-fluid" src="#" alt="Selected Image">
                                <figcaption class="figure-caption">
                                    <h6 class="figure-title text-center">Selected photo</h6>
                                    <p class="text-muted mb-0"></p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </fieldset>
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit">Save</button>
        </form>
    </div>
</div>
@endcomponent