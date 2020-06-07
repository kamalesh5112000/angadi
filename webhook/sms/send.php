<?php

include("smsalert/classes/smsalert.php");


$apikey='5eb919d6b76df';     // write your apikey in between ''
$senderid='ANGADI';	// write your senderid in between ''
$route='transactional';      // write your route in between ''
$username='angadi2020'; // write your username in between ''
$pass='Angadi#sms#2020';	// write your pass in between ''
$smsalert = (new Smsalert()) 		
	   ->authWithUserIdPwd($username,$pass)
	   ->setRoute($route)
	   ->setSender($senderid);

$payload = file_get_contents('php://input');

$array=json_decode($payload,1);

$order_id=$array['id'];
$billing=$array['billing'];
$customer_phone=$billing['phone'];
$metadata=$array['meta_data'];
$total=$array['total'];
$order_status=$array['status'];
$customer_name=$billing['first_name'];
 $customer_address=$billing['address_1'].', '.$billing['address_2'].', '.$billing['city'].'. '.$billing['postcode'];
$zip=$billing['postcode'];
//$customer_address=$billing['address_1'];
foreach($metadata as $md){
    if($md['key']=='store_phone'){
        $store_phone=$md['value'];
    }elseif($md['key']=='store_name'){
        $store_name=$md['value'];
    }elseif($md['key']=='store_telegram'){
        $store_telegram=$md['value'];
    }elseif($md['key']=='store_address'){
        $store_address=$md['value'];
    }elseif($md['key']=='store_email'){
        $store_email=$md['value'];
    }elseif($md['key']=='_billing_telegram'){
        $customer_telegram=$md['value'];
    }
}

$items=$array['line_items'];


$quan=0;
foreach($items as $value){
  $quan+=$value['quantity'];
  
}


   
//======== for store sms ================
$numbers='91'.$store_phone;
$messages="Dear Store, you have an order #$order_id from $customer_name ($customer_address) with $quan items is placed.\nPlease contact $customer_phone for payment and delivery. Thank you!";
//$result = $smsalert->send($numbers,$messages);


//======== for customer sms ================
$numberc='91'.$customer_phone;
$messagec="Dear Customer, your order #$order_id from $store_name ($store_address) with $quan items is placed.\nPlease contact $store_phone for payment and delivery. Thank you!";
 $result = $smsalert->send($numberc,$messagec);



$text="Hey $name, your order #$order_id from $store_name($store_address) with items,$item_list with a total cost of ₹$total has been received and is $order_status. Thank you!";

    $servername="localhost";
    $u="id10500203_adharsh28600";
    $p="root123";
    $db="id10500203_notice";

    $conn= new mysqli($servername,$u,$p,$db);
    if($conn->connect_error){die("connection failed: ". $conn->connect_error);}
    $conn->query("INSERT INTO test2 VALUES (\N,'$numbers','$message')");
    $conn->query("INSERT INTO test2 VALUES (\N,'$numbers','$text')");