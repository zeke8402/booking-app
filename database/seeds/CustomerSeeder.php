<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class CustomerSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    Customer::create(array(
      'first_name' => 'Joe',
      'last_name' => 'Danger',
      'contact_number' => '6666666666',
      'email' => 'joedanger@fuckyou.com',
      'wants_updates' => FALSE
    ));
    
    Customer::create(array(
      'first_name' => 'Todd',
      'last_name' => 'Megatron',
      'contact_number' => '5555555555',
      'email' => 'transformers@eye.io',
      'wants_updates' => TRUE
    ));
    
  }
}
