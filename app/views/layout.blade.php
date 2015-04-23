<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Appointment</title>

  <!-- Linking CSS -->
   
    
    {{ HTML::style('assets/css/normalize.css') }}
    {{ HTML::style('assets/css/bootstrap-3.3.4/css/bootstrap.css') }}
    {{ HTML::style('assets/css/flatly.css') }}
   
    <!-- Datepicker css -->
    {{ HTML::style('assets/css/calendar.css') }}
    
    <!-- Modernizr -->
    {{ HTML::script('assets/js/vendor/modernizr.js') }}
    
    <!-- JQuery must be in the header for the calendar to work, I don't know why... -->
    {{ HTML::script('http://code.jquery.com/jquery-1.9.1.js') }}
    {{ HTML::script('http://code.jquery.com/ui/1.11.0/jquery-ui.js') }}

    {{ HTML::script('assets/js/bootstrap.js') }}
    
    <!-- Moment -->
    {{ HTML::script('assets/js/moment.js') }}
 
</head>  
<body>

  @yield('content')


 </body>
</html>
