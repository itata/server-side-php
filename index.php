<?php
  require_once('./stripe-php/init.php');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Content-Type, Accept');
  \Stripe\Stripe::setApiKey('sk_test_xpyL2DCfqCfDc6wmYmFakWLj002zwpgcsB');
  $data = json_decode(file_get_contents("php://input"), true);
  $item = $data['item'];
  $token = $data['token'];
  if($data != null) {
    $charge = \Stripe\Charge::create(['amount' => 50, 'currency' => 'jpy', 'source' => $token['id']]);
    echo $charge['status'];
  }
?>