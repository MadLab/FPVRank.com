@component('components.modal')
@slot('id')
{{$idmodal}}
@endslot
@slot('title')
<div id="modaltitle"></div>
@endslot
@slot('button')
<div id="modalbutton">
    {{$modalButton}}
</div>
@endslot
<div id="modalcontent">

</div>
@endcomponent

<div class="container">
    <div class="row">
        {{$rankingnav}}
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h1 class="text-center justify-content-center">{{$bigtitle}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            {{$rankingbar}}
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9">
            {{$searchBar}}
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3">
            {{$addButtonName}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            {{$slot}}
        </div>
    </div>
</div>
</div>
</div>