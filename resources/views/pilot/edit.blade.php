@component('layouts.app')

@slot('pageTitle')
Edit pilot
@endslot

@slot('pageTitle2')

@endslot

@slot('pageCover')

@endslot

@slot('imageCover')

@endslot

@slot('floatingButton')

@endslot

@slot('searchBar')

@endslot
<div id="labels" class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('pilot.update', ['id' => $pilot->pilotId]) }}" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend>Pilot info</legend>
                @include('pilot._pilotform')
                <div class="row justify-content-md-center">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="card card-figure">
                            <figure class="figure">
                                <img id="currentImage" class="img-fluid" src="{{$pilot->imagePath}}" alt="Current Image">
                                <figcaption class="figure-caption">
                                    <h6 class="figure-title text-center">Current photo</h6>
                                    <p class="text-muted mb-0"></p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
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
