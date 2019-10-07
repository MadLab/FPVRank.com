@component('layouts.app')

@slot('pageTitle')
Classes
@endslot

@slot('pageTitle2')

@endslot

@slot('imageCover')

@endslot

@slot('pageCover')

@endslot

@slot('floatingButton')
<a href="{{route('class.create')}}">
    <button type="button" class="btn btn-success btn-floated" data-toggle="tooltip" data-placement="top" title="Add new class"><span class="fa fa-plus"></span>
    </button>
</a>
@endslot

@slot('searchBar')
<input id="search_class" class="form-control" type="text" placeholder="You can search classes by '#' or Name">
@endslot
@component('components.modal')
@slot('id')
classes
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
        @include('class._classtable')
        <div class="links-table">
            {{$classes->onEachSide(1)->links()}}
        </div>
    </div>
</div>
@endcomponent
