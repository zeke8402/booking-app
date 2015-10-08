<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Appointment</title>

  <!-- Linking CSS -->
   
    
    <link href="{{ asset('/css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-3.3.4/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/flatly.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/core.css') }}" rel="stylesheet">

   
    <!-- Datepicker css -->
    <link href="{{ asset('/css/calendar.css') }}" rel="stylesheet">
    
    <!-- Modernizr -->
    <script src="{{ asset('/js/vendor/modernizr.js') }}"></script>
    
    <!-- JQuery must be in the header for the calendar to work, I don't know why... -->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    
    <!-- Moment -->
    <script src="{{ asset('/js/moment.js') }}"></script>
 
</head>  
<body>

  @yield('content')


 </body>
</html>
