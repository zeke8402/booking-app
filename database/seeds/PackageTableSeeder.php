<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;

class PackageTableSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    Package::create(array(
      'package_name' => 'Package 1',
      'package_time' => '15',
      'package_description' => 'This package is suitable for single patient'
    ));
    
    Package::create(array(
      'package_name' => 'Package 2',
      'package_time' => '30',
      'package_description' => 'This package is suitable for 2 patients'
    ));

    Package::create(array(
      'package_name' => 'Package 2',
      'package_time' => '45',
      'package_description' => 'This package is suitable for 3 patients'
    ));
  }
}
