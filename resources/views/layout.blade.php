<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Mediviron') }}</title>

  <!-- Linking CSS -->


  <!-- Style -->

  <!-- Latest compiled and minified CSS Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <link href="{{ asset('/css/paper.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/core.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/normalize.css') }}" rel="stylesheet">
  
  <!-- Datepicker css -->
  <link href="{{ asset('/css/calendar.css') }}" rel="stylesheet">

  <!-- Modernizr -->
  <script src="{{ asset('/js/vendor/modernizr.js') }}"></script>

  <!-- JQuery must be in the header for the calendar to work, I don't know why... -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

  <!-- Latest compiled and minified JavaScript Bootstrap -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

  <!-- Moment -->
  <script src="{{ asset('/js/moment.js') }}"></script>

</head>  

<div id="url" style="display: none">{{url('')}}</div>
  <div id="app">

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    
                <a class="navbar-left" href="{{ URL::to('/') }}">
                    <img src="{{ URL::to('/') }}/img/mediviron-puchongavenue-logo.png" height="64px" alt="">
                </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                          <a href="/">Home</a>
                        </li>

                      <li class="{{ Request::is('appointment') ? 'active' : '' }}">
                          <a href="/appointment">Appointment</a>
                        </li>
                    </ul>


                </div>
            </div>
        </nav>
        </div>
        </div>

  @yield('content')

  <!--Footer-->
    <footer class="page-footer  text-center primary-color-dark">

        
          <div class="footer-copyright">
              <div class="container-fluid">
                  <b>Klinik Mediviron Puchong Avenue</b> | Developed By<a href="https://sopnopriyo.com"> Sopnopriyo International </a>

              </div>
          </div>
        
    </footer>
</html>
