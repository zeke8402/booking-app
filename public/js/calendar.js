var url = document.getElementById("url").textContent;
var jdays = [];
cDate = moment();
$('#currentDate').text("Current Date is " + cDate.format("MMMM Do, YYYY") );

$(document).ready(function($){
	createCalendar();
});

/**
 * Instantiates the calendar AFTER ajax call
 */
function createCalendar() 
{
	$.get(url+"/api/get-available-days", function(data) {
		$.each(data, function(index, value) {
			jdays.push(value.booking_datetime);
		});

		//My function to intialize the datepicker
		$('#calendar').datepicker({
			inline: true,
			minDate: 0,
			dateFormat: 'yy-mm-dd',
			beforeShowDay: highlightDays,
			onSelect: getTimes,
		});
	});
}

/**
 * Highlights the days available for booking
 * @param  {datepicker date} date
 * @return {boolean, css}  
 */
function highlightDays(date)
{
	date = moment(date).format('YYYY-MM-DD');
	for(var i = 0; i < jdays.length; i++) {
		jDate = moment(jdays[i]).format('YYYY-MM-DD');
		if(jDate == date) {
			return[true, 'available'];
		}
	}
	return false;
}

/**
 * Gets times available for the day selected
 * Populates the daytimes id with dates available
 */
function getTimes(d)
{
	var dateSelected = moment(d);
	document.getElementById('daySelect').innerHTML = dateSelected.format("MMMM Do, YYYY");
	$.get(url+"/booking/times?selectedDay="+d, function(data) {
		$('#dayTimes').empty();
		$('#dayTimes').append('<h6>Times Available</h6>');
		for(var i in data) {
			var rdate = data[i].booking_datetime;
			rdate = rdate.split(" ");
			$("#dayTimes").append('<a href="'+url+'/booking/details/'+data[i].id+'">' + rdate[1] + '</a><br>');
		}
	});
}