<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'SmartSchoolBus') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

     <link rel="stylesheet" href="/css/sweetalert.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="/js/sweetalert.min.js"></script>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body id="home-page">
      <a href="#" class="scrollToTop"><img src="http://go-solar.co/assets/images/backtotop.png" style="width: 100px; height: auto;"></a>
        <div id="app">
            @include('layouts.navbar')
            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="/js/app.js"></script>
        @yield('script')
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function (e){
                        $('#showphoto').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#inputphoto").change(function (){
                readURL(this);
            });
        </script>

        <!-- Google map api -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkJk2MwG9wk3a0Ys09K3IzoIUpPsrBbS4&libraries=places" async defer></script>

    </body>
    @include('layouts.footer')
    </html>
