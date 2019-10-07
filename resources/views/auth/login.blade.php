<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- BEGIN PLUGINS STYLES -->
    <!-- plugins styles goes here -->
    <!-- END PLUGINS STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/theme.min.css')}}" data-skin="default">
    <link rel="stylesheet" href="{{asset('assets/stylesheets/theme-dark.min.css')}}" data-skin="dark">

    <link rel="stylesheet" href="{{asset('assets/fontawesome/all.css')}}" data-skin="dark">

    <link rel="stylesheet" href="{{asset('assets/stylesheets/custom.css')}}">
    <!-- Disable unused skin immediately -->
    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var unusedLink = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');

        unusedLink.setAttribute('rel', '');
        unusedLink.setAttribute('disabled', true);
    </script>
    <!-- END THEME STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <!-- styles for specific page goes here -->
    <!-- END PAGE LEVEL STYLES -->

    <title>Hello, world!</title>
</head>

<body>
    <div class="app">
        <main class="auth">
            <header id="auth-header" class="auth-header" style="background-image: url(assets/images/illustration/img-1.png);">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="64" viewBox="0 0 351 100">
                        <defs>
                            <path id="a" d="M156.538 45.644v1.04a6.347 6.347 0 0 1-1.847 3.98L127.708 77.67a6.338 6.338 0 0 1-3.862 1.839h-1.272a6.34 6.34 0 0 1-3.862-1.839L91.728 50.664a6.353 6.353 0 0 1 0-9l9.11-9.117-2.136-2.138a3.171 3.171 0 0 0-4.498 0L80.711 43.913a3.177 3.177 0 0 0-.043 4.453l-.002.003.048.047 24.733 24.754-4.497 4.5a6.339 6.339 0 0 1-3.863 1.84h-1.27a6.337 6.337 0 0 1-3.863-1.84L64.971 50.665a6.353 6.353 0 0 1 0-9l26.983-27.008a6.336 6.336 0 0 1 4.498-1.869c1.626 0 3.252.622 4.498 1.87l26.986 27.006a6.353 6.353 0 0 1 0 9l-9.11 9.117 2.136 2.138a3.171 3.171 0 0 0 4.498 0l13.49-13.504a3.177 3.177 0 0 0 .046-4.453l.002-.002-.047-.048-24.737-24.754 4.498-4.5a6.344 6.344 0 0 1 8.996 0l26.983 27.006a6.347 6.347 0 0 1 1.847 3.98zm-46.707-4.095l-2.362 2.364a3.178 3.178 0 0 0 0 4.501l2.362 2.364 2.361-2.364a3.178 3.178 0 0 0 0-4.501l-2.361-2.364z" />
                        </defs>
                        <h1>Fpvrank</h1>
                    </svg>
                    <span class="sr-only">Sign In</span>
                </h1>
            </header>
            <!-- form -->
            <form class="auth-form" action="{{ route('login') }}" method="POST">
                @csrf
                <!-- .form-group -->
                <div class="form-group">
                    <div class="form-label-group">
                        <input name="email" type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" autofocus value="{{ old('email') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label for="email">E-mail</label>
                    </div>
                </div>
                <!-- /.form-group -->

                <!-- .form-group -->
                <div class="form-group">
                    <div class="form-label-group">
                        <input name="password" type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <!-- /.form-group -->

                <!-- .form-group -->
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
                </div>
                <!-- /.form-group -->

                <!-- .form-group -->
                <div class="form-group text-center">
                    <div class="custom-control custom-control-inline custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Keep me sign in</label>
                    </div>
                </div>
                <!-- /.form-group -->

                <!-- recovery links
                <div class="text-center pt-3">
                    <a href="auth-recovery-username.html" class="link">Forgot Username?</a>
                    <span class="mx-2">&middot;</span>
                    <a href="auth-recovery-password.html" class="link">Forgot Password?</a>
                </div>
                 /recovery links -->
            </form>
            <!-- /.auth-form -->

            <!-- copyright -->
            <footer class="auth-footer">&copy; 2018 All Rights Reserved. <a href="#">Privacy</a> and <a href="#">Terms</a></footer>
        </main>
        <!-- /.auth -->
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- BEGIN BASE JS -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- END BASE JS -->

    <!-- BEGIN PLUGINS JS -->
    <script src="assets/vendor/particles.js/particles.min.js"></script>
    <script>
        /**
         * Keep in mind that your scripts may not always be executed after the theme is completely ready,
         * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
         */
        $(document).on('theme:init', () => {
            /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
            particlesJS.load('auth-header', 'assets/javascript/pages/particles.json');
        })
    </script>
    <!-- END PLUGINS JS -->

    <!-- BEGIN THEME JS -->
    <script src="{{asset('assets/javascript/theme.min.js')}}"></script>
    <!-- END THEME JS -->

    <!-- BEGIN PAGE LEVEL JS -->
    <!-- your js for specific page goes here -->
    <!-- END PAGE LEVEL JS -->
</body>

</html>
