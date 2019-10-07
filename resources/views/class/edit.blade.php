@component('layouts.app')

@slot('pageTitle')
Edit class
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
<div id="labels" class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('class.update', ['id' => $class->classId]) }}">
            @method('PUT')
            @csrf
            <fieldset>
                <legend>Class info</legend>
                @include('class._classform')
            </fieldset>
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit">Save</button>
        </form>
    </div>
</div>
@endcomponent
