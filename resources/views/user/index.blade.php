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
<a href="{{route('user.create')}}" class="btn-floated">
    <button type="button" class="btn btn-success btn-floated" data-toggle="tooltip" data-placement="top"
        title="Add new user"><span class="fa fa-plus"></span>
    </button>
</a>

@endslot

@slot('searchBar')

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
        <div class="form-group">
            <div class="input-group input-group-alt">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
                    </div>
                    <input id="search_user" class="form-control" type="text"
                        placeholder="You can search users by '#', Name or Email">
                </div>
            </div>
        </div>
        @include('user._usertable')
        <div class="links-table">
            {{$users->onEachSide(1)->links()}}
        </div>
    </div>
</div>
@endcomponent