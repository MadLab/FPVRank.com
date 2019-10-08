       <!doctype html>
       <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

       <head>
           <!-- Required meta tags -->
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
           <meta name="csrf-token" content="{{ csrf_token() }}">

           <!-- BEGIN PLUGINS STYLES -->
           <!-- plugins styles goes here -->
           <link rel="stylesheet" href="{{asset('assets/fontawesome/all.css')}}">
           <link rel="stylesheet" href="{{asset('assets/openiconic/css/open-iconic-bootstrap.min.css')}}">
           <link rel="stylesheet" href="{{asset('assets/vendor/select2/css/select2.min.css')}}">
           <link rel="stylesheet" href="{{asset('assets/vendor/flatpickr/flatpickr.min.css')}}">

           <!-- END PLUGINS STYLES -->

           <!-- BEGIN THEME STYLES -->
           <link rel="stylesheet" href="{{asset('assets/stylesheets/theme.min.css')}}" data-skin="default">
           <link rel="stylesheet" href="{{asset('assets/stylesheets/theme-dark.min.css')}}" data-skin="dark">

           <link rel="stylesheet" href="{{asset('assets/stylesheets/custom.min.css')}}">
           <script>
               var skin = localStorage.getItem('skin') || 'default';
               var unusedLink = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
               unusedLink.setAttribute('rel', '');
               unusedLink.setAttribute('disabled', true);
           </script>
           <!-- END THEME STYLES -->

           <!-- BEGIN PAGE LEVEL STYLES -->
           <!-- styles for specific page goes here -->

           <link href="{{ asset('css/flag-icon.css') }}" rel="stylesheet">

           <!-- END PAGE LEVEL STYLES -->

           <title>Fpvrank.com</title>
       </head>

       <body>
           <div class="app">
               <header class="app-header app-header-dark">
                   @include('layouts._header', ['searchBar' => $searchBar])
               </header>
               <aside class="app-aside app-aside-light app-aside-expand-md">
                   @include('layouts._aside')
               </aside>
               <main class="app-main">
                   <div class="wrapper">
                       <div class="page">
                           {{$imageCover}}
                           <div class="page-inner pt2">
                               {{$floatingButton}}
                               <header class="page-title-bar">
                                   <!-- page title stuff goes here -->
                                   <h1 class="page-title">{{$pageTitle}}</h1>
                                   <h3 class="page-title">{{$pageTitle2}}</h3>
                                   @if(Route::currentRouteName() == 'home')
                                   <div class="d-flex flex-column flex-md-row">
                                       <p class="lead">
                                           <span class="font-weight-bold">Hi, {{Auth::user()->name}}.</span>
                                       </p>
                                   </div>
                                   @endif
                               </header>
                               {{$pageCover}}
                               <!-- /.page-title-bar -->

                               <!-- .page-section -->
                               <div class="page-section">
                                   @if (session('status'))
                                   <div class="alert alert-{{session('type')}}" role="alert">
                                       {{ session('status') }}
                                   </div>
                                   @endif
                                   <!-- page content goes here -->
                                   {{$slot}}

                               </div>
                           </div>
                       </div>
                   </div>
               </main>
           </div>
           <!-- jQuery first, then Popper.js, then Bootstrap JS -->
           <!-- BEGIN BASE JS -->
           <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
           <script src="{{asset('assets/vendor/bootstrap/js/popper.min.js')}}"></script>
           <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
           <!-- END BASE JS -->

           <!-- BEGIN PLUGINS JS -->
           <script src="{{asset('assets/vendor/pace/pace.min.js')}}"></script>
           <script src="{{asset('assets/vendor/stacked-menu/stacked-menu.min.js')}}"></script>
           <script src="{{asset('assets/vendor/select2/js/select2.full.min.js')}}"></script>
           <script src="{{asset('assets/vendor/flatpickr/flatpickr.min.js')}}"></script>
           <script src="{{asset('assets/vendor/typeahead.js/typeahead.bundle.min.js')}}"></script>
           <!-- END PLUGINS JS -->

           <!-- BEGIN THEME JS -->
           <script src="{{asset('assets/javascript/theme.min.js')}}"></script>
           <!-- END THEME JS -->

           <!-- BEGIN PAGE LEVEL JS -->
           <!-- your js for specific page goes here -->
           @include('layouts.scripts')
           @if(Route::currentRouteName() == 'welcome.index' || Route::currentRouteName() == 'welcome.searchclasscountry' || Route::currentRouteName() == 'welcome.event' || Route::currentRouteName() == 'welcome.getevent' || Route::currentRouteName() == 'welcome.pilot')
           <script src="{{ asset('js/welcome.js') }}" defer></script>
           @endif
           <!-- END PAGE LEVEL JS -->
       </body>

       </html>
