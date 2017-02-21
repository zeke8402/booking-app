<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class AdminSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    User::create(array(
      'name' => 'admin',
      'email'    => 'admin@demo.com',
      'password' => Hash::make('admin')
    ));
    
  }
}
