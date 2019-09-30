<?php
  require_once('./stripe-php/init.php');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Content-Type, Accept');
  \Stripe\Stripe::setApiKey('sk_test_xpyL2DCfqCfDc6wmYmFakWLj002zwpgcsB');
  $data = json_decode(file_get_contents("php://input"), true);
  $item = $data['item'];
  $token = $data['token'];
  $email = $data['email'];
  if($data != null) :
    // Create a Customer:
    $checkUser = \Stripe\Customer::all(['email' => $email]);
    if(count($checkUser['data']) > 0) {
      $customerID = $checkUser['data'][0]['id'];
    } else {
      $customer = \Stripe\Customer::create([
        'source' => $token['id'],
        'email' => $email,
      ]);
      $customerID = $customer->id;
    }
    $charge = \Stripe\Charge::create(['amount' => $item['price'], 'currency' => 'jpy', 'customer' => $customerID]);
    echo $charge['status'];
  endif;
?>