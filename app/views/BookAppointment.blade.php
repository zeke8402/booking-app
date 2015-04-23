@extends('layout')
@section('content')
<?php $link = Request::root(); ?>
<div class="row jumbotron text-center">
  <h1>Select a Day</h1>
  <p>You chose <b> {{ $packageName }} </b></p>
  <p id="currentDate">  </p>
</div>

<div class="row text-center">
  <div class="col-md-4"></div>
  <div class="col-md-2">
    <div id="calendar"></div>
  </div>
  <div class="col-md-2">
    <div class="panel panel-primary">
      <div class="panel-heading" id="daySelect">
        Select a Day
      </div>
      <div class="panel-body">
        <p id="dayTimes"></p>
      </div>
    </div>
  </div>
</div>


	<script>
		$(document).ready(function() {

      cDate = moment();
      $('#currentDate').text("Current Date is " + cDate.format("MMMM Do, YYYY") );
			var jdays = <?php echo json_encode($days); ?>;
//My function to intialize the datepicker
$(function() {
	$('#calendar').datepicker({
		inline: true,
		minDate: 0,
		dateFormat: 'yy-mm-dd',
    onSelect: function(d){
      var dateSelected = moment(d);
      document.getElementById('daySelect').innerHTML = dateSelected.format("MMMM Do, YYYY");
      //Here we need to make an AJAX request to get all the available dates
      $.ajax({
        url: "<?php echo URL::to('booking/times'); ?>",
        data: "selectedDay="+d,
        dataType: 'json',
        success: function(response){
          $('#dayTimes').empty();
          $('#dayTimes').append('<h4>Times available</h4>');
          for(var i=0; i < response.length; i++) {
            var link = '{{ $link.'/' }}';
            $('#dayTimes').append('<a href="'+ link + 'booking/details/' + response[i].id +'">' + response[i].bdatetime +'</a><br>');
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

