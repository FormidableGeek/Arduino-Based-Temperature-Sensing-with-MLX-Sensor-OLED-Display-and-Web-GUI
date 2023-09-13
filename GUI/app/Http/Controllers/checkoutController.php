<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checkoutController extends Controller
{
    public function __construct(){
        
$test_key="sk_test_a6fc0d0061bb373be5dca371c13b9d4b5617fe56";
$live_key="sk_live_3eeede33228e0dc56dec87049aaa9f6792b596c1";
    }

  //check and verify account numbers

    public function check_account_number(Request $request){
 $curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=2270532876&bank_code=057",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "GET",
 CURLOPT_HTTPHEADER => array(
 "Authorization: Bearer sk_live_3eeede33228e0dc56dec87049aaa9f6792b596c1",
 "Cache-Control: no-cache",
 ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
dd( $err);
//return back()->with(["error_check_account"=>"cURL Error : ". $err]);

} else {

 //echo $response;
return redirect()->action([checkoutController::class,'receipt']);
}

  //end of echeck_account_number function 
 }


public function pay(){
//empty for now
}



public function receipt (Request $request){
    $url = "https://api.paystack.co/transferrecipient";
    $fields = [
    'type' => "nuban",
    'name' => "Zenith bank",
    'account_number' =>2270532876,
    'bank_code' => "057",
    'currency' => "NGN"
    ];
    $fields_string = http_build_query($fields);
    //open connection
    $ch = curl_init(); 
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer sk_live_3eeede33228e0dc56dec87049aaa9f6792b596c1",
    "Cache-Control: no-cache",
    ));
    //So that curl_exec returns the contents of the cURL; rather than echoing it
   
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);    
     //execute post
   
    $result = curl_exec($ch);
    echo $result;
  $response=json_decode($result);
  echo $response->status;
  echo $response->data->recipient_code;
    if($response->status=="true"){
    //  return redirect()->action([checkoutController::class,'send'])->with("receipient",$response->data->recipient_code);
      
    }
   
}




public function send(){
    $url = "https://api.paystack.co/transfer";
    $fields = [
    'source'=>"balance",
    'amount'=>"1000",
   //"recipient" =>session("receipient"), 
    'reason' => "928783"
   ];
    $fields_string = http_build_query($fields);
    //open connection
    $ch = curl_init();
   
     //set the url, number of POST vars, POST data
   curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
   curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization:Bearer sk_live_3eeede33228e0dc56dec87049aaa9f6792b596c1",
    "Cache-Control: no-cache",
   
    ));
   
     //So that curl_exec returns the contents of the cURL; rather than echoing it
   
   curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    
    //execute post
    $result = curl_exec($ch);
    echo $result;
   
}


//end of class
}
