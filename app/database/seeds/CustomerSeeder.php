<?php

class CustomerSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    Customer::create(array(
      'first_name' => 'Joe',
      'last_name' => 'Danger',
      'contact_number' => '(666)-666-6666',
      'email' => 'joedanger@fuckyou.com',
      'wants_updates' => FALSE
    ));
    
    Customer::create(array(
      'first_name' => 'Todd',
      'last_name' => 'Megatron',
      'contact_number' => '(555)-555-5555',
      'email' => 'transformers@eye.io',
      'wants_updates' => TRUE
    ));
    
  }
}
