@component('layouts.app')

@slot('pageTitle')

@endslot

@slot('pageTitle2')

@endslot

@slot('imageCover')

@endslot

@slot('floatingButton')

@endslot

@slot('pageCover')
<header class="page-cover">
    <div class="text-center">
        <a href="#" class="user-avatar user-avatar-xxl"><img src="{{$pilot->imagePath}}" alt=""></a>
        <h2 class="h2 mt-2 mb-0">
            @foreach ($countries as $key => $country)
            @if($key == $pilot->country)
            <a href="{{route('welcome.searchclasscountry', ['classId' => $firstClassId, 'country' => $key])}}"><span class="label label-default">
                    <span class="flag-icon flag-icon-{{strtolower($key)}}"></span></span> </a>
            @endif
            @endforeach
            {{$pilot->name}} -- {{$pilot->username}}
        </h2>
        <div class="my-1">

        </div>
        <p class="text-muted"> </p>
        <h3> Times competed: {{count($resultsPilot)}} </h3>
    </div>
</header>
<nav class="page-navs">

</nav>
@endslot

@slot('searchBar')
<div class="top-bar-search">
    <div class="input-group input-group-search">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <span class="oi oi-magnifying-glass"></span>
            </span>
        </div>
        <input id="search_public" type="text" class="form-control" aria-label="Search" placeholder="Search pilots by name or username">
    </div>
</div>

@endslot

<div class="section-block">

</div>

<div class="row">
    <div class="col-xl-6">
        <div class="card card-fluid">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <span class="mr-auto">Pilot rankings</span>
                    <div class="card-header-control">

                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="min-width:260px"> Class </th>
                            <th class="text-center"> Position </th>
                            <th class="text-center" style="min-width:142px"> Rating </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $val)
                        <tr>
                            <td class="align-middle text-left">
                                <a href="{{route('welcome.searchclasscountry', ['classId' => $val['classId'], 'country' => 'all'])}}">
                                    {{$val['className']}}
                                </a>
                            </td>
                            <td class="align-middle text-center"> #{{$val['position']}} </td>
                            <td class="align-middle text-center"> {{number_format($val['rating'], 2)}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-fluid">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <span class="mr-auto"> Events attended </span>
                    <div class="card-header-control">

                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="min-width:259px"> Event </th>
                            <th> Position </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resultsPilot as $result)
                        <tr>
                            <td class="align-middle text-truncate">
                                <a href="{{route('welcome.getevent', ['eventId' => $result->eventId])}}">
                                    {{$result->eventName}}
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="{{route('welcome.getevent', ['eventId' => $result->eventId])}}">
                                    #{{$result->position}}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endcomponent
