    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    @if(Auth::check())
    @switch(Route::currentRouteName())
    @case('user.index')
    <script src="{{ asset('js/user.js') }}" defer></script>
    @break
    @case('class.index')
    <script src="{{ asset('js/class.js') }}" defer></script>
    @break
    @case('pilot.index')
    <script src="{{ asset('js/pilot.js') }}" defer></script>
    @break
    @case('event.create')
    <script src="{{ asset('js/event_create.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}" defer></script>
    <script src="{{ asset('js/locales/bootstrap-datetimepicker.es.js') }}" defer></script>
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    @break
    @case('event.edit')
    <script src="{{ asset('js/event_create.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}" defer></script>
    <script src="{{ asset('js/locales/bootstrap-datetimepicker.es.js') }}" defer></script>
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    @break
    @case('event.index')
    <script src="{{ asset('js/event.js') }}" defer></script>
    @break
    @default
    
    @endswitch
    @endif