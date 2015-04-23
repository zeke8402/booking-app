<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Calendar</title>
    
    <script type="text/javascript">
      var link = "{{ URL::to('/') }}";
    </script>
    
    {{ HTML::style('assets/js/fullcalendar-2.3.1/fullcalendar.css') }}
    {{ HTML::style('assets/css/foundation.css') }}
    
    {{ HTML::script('assets/js/fullcalendar-2.3.1/lib/moment.min.js') }}
    {{ HTML::script('assets/js/fullcalendar-2.3.1/lib/jquery.min.js') }}
  
    {{ HTML::script('assets/js/fullcalendar-2.3.1/fullcalendar.min.js') }}
    {{ HTML::script('assets/js/admin/main.js') }}
    
   
</head>  
<body>
  <br><br>
  
  <div id="test" class="row"></div>
  <div id="calendar" class="row"></div>
 </body>
</html>