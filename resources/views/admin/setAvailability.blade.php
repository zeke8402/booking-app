<h3 class="NoPick" id="clickedDay">Click on a Day to set availability</h3>
{!! Form::open(['url' => 'admin/add/availability', 'id' => 'submitAvailability', 'class' => 'form-horizontal']) !!}
{!! Form::hidden('dateSelected', 'wut') !!}
<div class="row">
	<div class="col-xs-4 pull-left">
		<input type="button" value="Add" id="addAvailabilityBtn" class="btn btn-default"/>
		<input type="button" value="Remove" id="removeAvailabilityBtn" class="btn btn-default"/>
	</div>
</div>
<br><br>
<div class="row">
	<ul id="availabilityList" style="list-style-type : none">
		<li id="availability1">
			<div class="form-group">
				{!! Form::label('time', 'Time: ', ['class' => 'col-xs-2 control-label']) !!}
				<div class="col-xs-2" id="timeDiv">
					{!! Form::text('time[]', null, ['class' => 'form-control']) !!}
				</div>
				<div class="col-xs-2" id="timeOfDayDiv">
					{!! Form::select('timeOfDay[]', ['am' => 'AM', 'pm' => 'PM'], null, ['id' => 'timeOfDay', 'class' => 'form-control']) !!}
				</div>
			</div>
		</li>
	</ul>
</div>

<div class="col-xs-2 form-group">
	{!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
</div>
{!! Form::close() !!}
