@component('layouts.app')

@slot('pageTitle')
Pilots
@endslot

@slot('pageTitle2')

@endslot

@slot('imageCover')

@endslot

@slot('pageCover')

@endslot

@slot('floatingButton')
<a href="{{route('pilot.create')}}">
    <button type="button" class="btn btn-success btn-floated" data-toggle="tooltip" data-placement="top" title="Add new pilot"><span class="fa fa-plus"></span>
    </button>
</a>
@endslot

@slot('searchBar')

@endslot
@component('components.modal')
@slot('id')
pilot
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
                    <input id="search_pilot" class="form-control" type="text" placeholder="You can search pilots by '#', Name or Username">
                </div>
            </div>
        </div>
        @include('pilot._pilottable')
        <div class="links-table">
            {{$pilots->onEachSide(1)->links()}}
        </div>
    </div>
</div>
@endcomponent
