<?php

class AdminSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    Admin::create(array(
      'username' => 'admin',
      'password' => Hash::make('admin')
    ));
    
  }
}
