<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

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
