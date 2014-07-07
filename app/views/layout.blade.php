<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Appointment</title>

  <!-- Linking CSS -->
    {{ HTML::style('assets/css/lugo.datepicker.css') }}
    {{ HTML::style('assets/css/scheduler.css') }}
    {{ HTML::style('assets/css/normalize.css') }}
    {{ HTML::style('assets/css/foundation.css') }}
    {{ HTML::style('assets/js/jquery-ui.custom/jquery-ui.min.css') }}
    
    <!-- Modernizr -->
    {{ HTML::script('js/vendor/modernizr.js') }}
    
    <!-- JQuery must be in the header for the calendar to work, I don't know why... -->
    {{ HTML::script('http://code.jquery.com/jquery-1.9.1.js') }}
    {{ HTML::script('http://code.jquery.com/ui/1.11.0/jquery-ui.js') }}


  {{ HTML::script('assets/js/foundation.min.js') }}
  {{ HTML::script('assets/js/core.js') }}
 
</head>  
<body>
  <div class="large-12 columns text-center">
  @yield('content')
  </div>

 </body>
</html>
