@component('layouts.app')

@slot('pageTitle')
Users
@endslot

@slot('pageTitle2')

@endslot

@slot('pageCover')

@endslot

@slot('imageCover')

@endslot

@slot('floatingButton')
<a href="{{route('user.create')}}">
    <button type="button" class="btn btn-success btn-floated" data-toggle="tooltip" data-placement="top" title="Add new user"><span class="fa fa-plus"></span>
    </button>
</a>
@endslot

@slot('searchBar')
<input id="search_user" class="form-control" type="text" placeholder="You can search users by '#', Name or Email">
@endslot
@component('components.modal')
@slot('id')
user
@endslot
@slot('title')
<div id="modaltitle"></div>
@endslot
@slot('button')
<div id="modalbutton">

</div>
@endslot
<div id="modalcontent">

</div>
@endcomponent
<div class="card">
    <div class="card-body">
        @include('user._usertable')
        <div class="links-table">
            {{$users->onEachSide(1)->links()}}
        </div>
    </div>
</div>
@endcomponent
