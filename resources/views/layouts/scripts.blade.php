    <!-- Scripts -->

    @if(Auth::check())
    @switch(Route::currentRouteName())
    @case('user.index')
    <script src="{{ asset('js/user.js') }}" defer></script>
    @break
    @case('class.create')
    <script src="{{ asset('js/class_create.js') }}" defer></script>
    @break
    @case('class.index')
    <script src="{{ asset('js/class.js') }}" defer></script>
    @break
    @case('pilot.create')
    <script src="{{ asset('js/pilot_create.js') }}" defer></script>
    @break
    @case('pilot.edit')
    <script src="{{ asset('js/pilot_create.js') }}" defer></script>
    @break
    @case('pilot.index')
    <script src="{{ asset('js/pilot.js') }}" defer></script>
    @break
    @case('event.create')
    <script src="{{ asset('js/event_create.js') }}" defer></script>
    @break
    @case('event.edit')
    <script src="{{ asset('js/event_create.js') }}" defer></script>
    @break
    @case('event.index')
    <script src="{{ asset('js/event.js') }}" defer></script>
    @break

    @default

    @break

    @endswitch
    @endif
