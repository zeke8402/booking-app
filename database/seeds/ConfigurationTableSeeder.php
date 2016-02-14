<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configuration;

class ConfigurationTableSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();

    Configuration::create([
      'time_interval_id' => '2',
    ]);
  }
}
