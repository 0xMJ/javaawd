<?php namespace Listener;
require('PaypalIPN.php');
use PaypalIPN;
$ipn = new PaypalIPN();
// Use the sandbox endpoint during testing.
$ipn->useSandbox();
$verified = $ipn->verifyIPN();
if (!empty($verified)) {
  $str="";
 // $item_name = $_POST['item_name'];
 // $item_number = $_POST['item_number'];
 // $payment_status = $_POST['payment_status'];
 // $payment_amount = $_POST['mc_gross'];
 // $payment_currency = $_POST['mc_currency'];
 // $txn_id = $_POST['txn_id'];
 // $receiver_email = $_POST['receiver_email'];
 // $payer_email = $_POST['payer_email'];
  // IPN message values depend upon the type of notification sent.
  // To loop through the &_POST array and print the NV pairs to the screen:
  foreach($verified as $key => $value) {
     $str.= $key . " = " . $value . ",";
   }
    $myfile = fopen("log.txt", "a+") or die("Unable to open file!");
	$txt =$str."\n";
	fwrite($myfile, $txt);
	fclose($myfile);
}else{
    $myfile = fopen("log.txt", "a+") or die("Unable to open file!");
	$txt ="err\n";
	fwrite($myfile, $txt);
	fclose($myfile);	 
}
// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");
