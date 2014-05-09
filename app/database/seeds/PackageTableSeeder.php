<?php

class PackageTableSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    Package::create(array(
      'package_name' => 'Package 1',
      'package_price' => '135',
      'package_time' => '8',
      'time_metric' => 'hour',
      'package_description' => 'This is the first package and a description of it'
    ));
    
    Package::create(array(
      'package_name' => 'Package 2',
      'package_price' => '175',
      'package_time' => '2',
      'time_metric' => 'day',
      'package_description' => 'This is the second package and a description of it'
  ));
  }
}
