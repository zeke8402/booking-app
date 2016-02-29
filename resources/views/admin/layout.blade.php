<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.min.css" rel="stylesheet">
  <link href="{{ asset('/css/paper.css') }}" rel="stylesheet">

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

  <script src="{{ asset('/js/moment.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
  <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
</head>  
<body>
  <div id="url" style="display: none">{{url('')}}</div>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Booking</a>
      </div>

      <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 1px;">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('admin/appointments') }}">Appointments<span class="sr-only">(current)</span></a></li>
          <li><a href="{{ url('admin/availability') }}">Availability</a></li>
          <li><a href="{{ url('admin/packages') }}">Packages</a></li>
          <li><a href="{{ url('admin/configuration') }}">Configuration</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Log Out</a></li>
        </ul>
      </div>
    </div>
  </nav>
  @yield('content')
</body>
</html>