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
<p> We have sent you an email confirmation </p>
  