@component('layouts.app')

@slot('pageTitle')
Create event
@endslot

@slot('pageTitle2')

@endslot

@slot('imageCover')

@endslot

@slot('pageCover')

@endslot

@slot('floatingButton')

<button id="bottom-button" class="btn btn-info btn-floated" type="button" onclick="$('html, body').animate({ scrollTop: $(document).height() }, 500)"><span data-toggle="tooltip" data-placement="top" title="Go to Bottom"
class="fa fa-arrow-down"></span>
</button>

<button id="top-button" class="btn btn-info btn-floated" type="button" onclick="$('html, body').animate({ scrollTop: 0 }, 500)"><span data-toggle="tooltip" data-placement="top" title="Go to Top" class="fa fa-arrow-up"></span>
</button>

<button class="btn btn-primary btn-floated" type="button" data-toggle="modal" data-target="#jsonmodal"><span data-toggle="tooltip" data-placement="top" title="Upload event with JSON" class="fa fa-file-import"></span>
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
    Create event with JSON
</div>
@endslot
@slot('button')
<div id="modalbutton">

</div>
@endslot
<div id="modalcontent">
    <form method="POST" action="{{ route('event.storejson') }}">
        @csrf
        @include('components._jsonform', ['rows' => 7])
    </form>
    <hr class="separator-line">

</div>
@endcomponent
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('event.store') }}" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend>Event info</legend>
                @include('event._eventform')
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
            <fieldset>
                <legend>Results info</legend>
                <div class="inputs-title row">
                    <div class="col-sm-12 col-md-3">
                        Position
                    </div>
                    <div class="col-sm-12 col-md-3">
                        Pilot
                    </div>
                    <div class="col-sm-12 col-md-3">
                        Laps - Time
                    </div>
                    <div class="col-sm-12 col-md-3">

                    </div>
                </div>
                <input type="hidden" value="0" id="form-count">
                <div name="results" id="result-form-content">

                </div>
            </fieldset>
            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="button" onclick="getInput()">Add 10 rows</button>

            <button class="btn btn-success btn-lg btn-block" type="submit">Save</button>

        </form>
    </div>
</div>
@endcomponent
