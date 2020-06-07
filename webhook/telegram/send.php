<?php 

$payload = file_get_contents('php://input');

$array=json_decode($payload,1);

$order_id=$array['id'];
$billing=$array['billing'];
$customer_phone=$billing['phone'];
$metadata=$array['meta_data'];
$total=$array['total'];
$order_status=$array['status'];
$customer_name=$billing['first_name'].' '.$billing['last_name'];
$customer_address=$billing['address_1'].', '.$billing['address_2'].', '.$billing['city'].'.-'.$billing['postcode'];
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
$messagec="Dear Customer, your order #$order_id from $store_name ($store_address) with $quan items is placed.\nPlease contact $store_phone for payment and delivery. Thank you!";
$messages="Dear Store, you have an order #$order_id from $customer_name ($customer_address) with $quan items is placed.\nPlease contact $customer_phone for payment and delivery. Thank you!";


    
$servername="localhost";
$u="id10500203_adharsh28600";
$p="root123";
$db="id10500203_notice";

$conn= new mysqli($servername,$u,$p,$db);
if($conn->connect_error){die("connection failed: ". $conn->connect_error);}
    


$conn->query("INSERT INTO test2 VALUES (\N,'$customer_telegram','$messagec')");
$conn->query("INSERT INTO test2 VALUES (\N,'$store_telegram','$messages')");




$conn->close();    

include 'Telegram.php';

$bot_token = '1249887668:AAGQ0SZ0TCMNJkmzN1IpyvguaZTedQF4i50';
$telegram = new Telegram($bot_token);
$content = ['chat_id' => $customer_telegram, 'text' => $messagec];
$telegram->sendMessage($content);

$content = ['chat_id' => $store_telegram, 'text' => $messages];
$telegram->sendMessage($content);
        






?>

