<?php

class Customer extends Eloquent{
  	protected $table = 'customers';
    protected $fillable = array('first_name', 'last_name', 'contact_number', 'email', 'wants_updates');
    protected $guarded = array('id', 'created_at', 'updated_at');
}