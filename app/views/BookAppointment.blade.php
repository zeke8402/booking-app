@extends('layout')
@section('content')
<?php $link = Request::root(); ?>
<h3>Select a Day</h3>
<p>You chose <b> {{ $packageName }} </b></p>
<p> Current Date is <?php $cDate = date('m/d/Y'); echo $cDate; ?> </p>

<div class="row">
  <div class="small-8 columns" id="calendar"></div>
  <div class="small-4 columns">
    <p id="daySelect"></p>
    <p id="dayTimes"></p>
  </div>
</div>


	<script>
		$(document).ready(function() {

			var jdays = <?php echo json_encode($days); ?>;
//My function to intialize the datepicker
$(function() {
	$('#calendar').datepicker({
		inline: true,
		minDate: 0,
		dateFormat: 'yy-mm-dd',
    onSelect: function(d){
      document.getElementById('daySelect').innerHTML = d;
      //Here we need to make an AJAX request to get all the available dates
      $.ajax({
        url: "<?php echo URL::to('booking/times'); ?>",
        data: "selectedDay="+d,
        dataType: 'json',
        success: function(response){
          $('#dayTimes').empty();
          $('#dayTimes').append('<h4>Times available</h4>');
          for(var i=0; i < response.length; i++) {
            var link = '/booking-app/';
            $('#dayTimes').append('<a href="'+ link + 'booking/details/' + d + '/' + response[i].id +'">' + response[i].bdate +'</a><br>');
          }
        },
        error: function(){
          console.log("No Success");
        }
      });
        
    },
		beforeShowDay: function(d){
			var sqlDate = d.getFullYear().toString();
			sqlDate = sqlDate + "-" + pad((d.getMonth()+1), 2 );
			sqlDate = sqlDate + "-" + pad(d.getDate(), 2);
			for(i = 0; i < jdays.length; i++){
				if(jdays[i].bdate == sqlDate){
					return[true, 'available'];
				}
			}
			return[false];
		}
	})
});

//My function to pad the numbers for the months and days
function pad(number, length) {
	var str = '' + number;
	while (str.length < length) {
		str = '0' + str;
	}
	return str;
}

});
	</script>
@stop

