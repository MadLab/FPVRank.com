@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="flex-center position-ref full-height">
                <div class="content">
                    <div class="title m-b-md">
                        FPV Rank
                    </div>

                    <div class="links">
                        <a href="{{route('user.index')}}">Users</a>
                        <a href="{{route('class.index')}}">Classes</a>
                        <a href="{{route('pilot.index')}}">Pilots</a>
                        <a href="{{route('event.index')}}">Events</a>                                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection