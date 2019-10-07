@component('layouts.app')

@slot('pageTitle')
Create user
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
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('user.store') }}">
            @csrf
            <fieldset>
                <legend>User info</legend>
                @include('user._userform')
            </fieldset>
            <hr class="mb-4">
            <fieldset>
                <legend>Permissions</legend>
                @include('user._permiform')
            </fieldset>
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit">Save</button>
        </form>
    </div>
</div>
@endcomponent
