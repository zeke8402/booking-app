<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Calendar</title>
    
    <script type="text/javascript">
      var link = "{{ URL::to('/') }}";
    </script>
    
    {{ HTML::style('assets/js/fullcalendar-2.0.3/fullcalendar.css') }}
    {{ HTML::style('assets/js/fullcalendar-2.0.3/fullcalendar.print.css') }}
    {{ HTML::style('assets/css/foundation.css') }}
    
    
    {{ HTML::script('http://code.jquery.com/jquery-1.9.1.js') }}
    {{ HTML::script('http://code.jquery.com/ui/1.11.0/jquery-ui.js') }}
    {{ HTML::script('assets/js/fullcalendar-2.0.3/moment.min.js') }}
    {{ HTML::script('assets/js/fullcalendar-2.0.3/fullcalendar.min.js') }}
    {{ HTML::script('assets/js/admin/main.js') }}
    
   
</head>  
<body>
  <br><br>
  
  <div id="test" class="row"></div>
  <div id="calendar" class="row"></div>
 </body>
</html>