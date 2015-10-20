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
                            var rdate = response[i].booking_datetime;
                            rdate = rdate.split(/[ ]+/);
                            $('#dayTimes').append('<a href="'+ link + 'booking/details/' + response[i].id +'">' + rdate[1] +'</a><br>');
                        }
                    },
                    error: function(){
                        console.log("No Success");
                    }
                });

            },
            beforeShowDay: function(d) {
                dDate = moment(d);
                for(i = 0; i < jdays.length; i++) {
                    jDate = moment(jdays[i].booking_datetime);
                    if(dDate.format('YYYY-MM-DD') == jDate.format('YYYY-MM-DD')) {
                        return[true, 'available'];
                    }
                }
                return [false];
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

function sqlToJsDate(sqlDate){
    //sqlDate in SQL DATETIME format ("yyyy-mm-dd hh:mm:ss.ms")
    var sqlDateArr1 = sqlDate.split("-");
    //format of sqlDateArr1[] = ['yyyy','mm','dd hh:mm:ms']
    var sYear = sqlDateArr1[0];
    var sMonth = (Number(sqlDateArr1[1]) ).toString();
    var sqlDateArr2 = sqlDateArr1[2].split(" ");
    //format of sqlDateArr2[] = ['dd', 'hh:mm:ss.ms']
    var sDay = sqlDateArr2[0];
    var sqlDateArr3 = sqlDateArr2[1].split(":");
    //format of sqlDateArr3[] = ['hh','mm','ss.ms']
    var sHour = sqlDateArr3[0];
    var sMinute = sqlDateArr3[1];
    var sqlDateArr4 = sqlDateArr3[2].split(".");
    //format of sqlDateArr4[] = ['ss','ms']
    var sSecond = sqlDateArr4[0];
    var sMillisecond = sqlDateArr4[1];
                                                          
    return new Date(sYear, sMonth, sDay);

}

});
	</script>
@stop

