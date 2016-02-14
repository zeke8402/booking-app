<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\TimeInterval;

class TimeIntervalTableSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();

    TimeInterval::create([
      'interval' => '15',
      'metric' => 'minutes'
    ]);

    TimeInterval::create([
      'interval' => '30',
      'metric' => 'minutes'
    ]);
  }
}
