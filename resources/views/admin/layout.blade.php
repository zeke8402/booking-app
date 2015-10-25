<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link href="{{ asset('/css/bootstrap-3.3.4/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('/js/fullcalendar-2.3.1/fullcalendar.css') }}" rel="stylesheet">
</head>  
<body>
  <div id="url" style="display: none">{{url('')}}</div>
  @yield('content')
  <script src="{{ asset('/js/fullcalendar-2.3.1/lib/moment.min.js') }}"></script>
  <script src="{{ asset('/js/fullcalendar-2.3.1/lib/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/fullcalendar-2.3.1/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('/js/admin/main.js') }}"></script>
</body>
</html>