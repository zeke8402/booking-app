<?php
  $data = array();
/*
Mail::send('test', $data, function($message)
{
    $message->to($email, 'Tim Washington')->subject('Full Attention to Detail - Appointment Confirmation');
});
*/
?>

<p> Thank you </p>
<p> {{ Session::get('fname') }} </p>
<p> Start Time is <?php echo $starttime->format('Y-m-d H:i:s'); ?></p>
<p> End Time is <?php echo $endtime->format('Y-m-d H:i:s'); ?></p>
<p><b>{{ Session::get('aptTime') }} </b></p>
<p> We have sent you an email confirmation </p>
  