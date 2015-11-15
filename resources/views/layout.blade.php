<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Appointment</title>

  <!-- Linking CSS -->


  <!-- Style -->

  <!-- Latest compiled and minified CSS Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
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
<body>
  <div id="url" style="display: none">{{url('')}}</div>

  @yield('content')


</body>
</html>
