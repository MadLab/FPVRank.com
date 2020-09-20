@component('layouts.app')

@slot('pageTitle')
Glicko default values
@endslot

@slot('pageTitle2')

@endslot

@slot('imageCover')

@endslot

@slot('pageCover')

@endslot

@slot('floatingButton')

@endslot

@slot('searchBar')

@endslot
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('glicko.store') }}" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend>Current values</legend>

                @include('glickoValues._form')
                
            </fieldset>
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit">Save</button>
        </form>
    </div>
</div>
@endcomponent