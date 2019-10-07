@component('layouts.app')

@slot('pageTitle')
Edit user
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
        <form method="POST" action="{{ route('profile.update', ['id' => $user->userId]) }}">
            @method('PUT')
            @csrf
            <fieldset>
                <legend>User info</legend>
                @include('user._userform')
            </fieldset>
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block" type="submit">Save</button>
        </form>
    </div>
</div>
@endcomponent
