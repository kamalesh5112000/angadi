<?php 
    
    $servername="localhost";
    $u="id10500203_adharsh28600";
    $p="root123";
    $db="id10500203_notice";

    $conn= new mysqli($servername,$u,$p,$db);
    if($conn->connect_error){die("connection failed: ". $conn->connect_error);}
    
    $payload = file_get_contents('php://input');
    
    $array=json_decode($payload,1);
    
    
    $conn->query("INSERT INTO test VALUES (\N,'payloadstr','$payload')");

    $billing=$array['billing'];
    $phone=$billing['phone'];
    $metadata=$array['meta_data'];
    $store=$metadata[0];
    $final=$store['value'];
  $status=$array['status'];
  $id=$array['id'];
  $fname=$billing['first_name'];
  $lastname=$billing['last_name'];
  $items=$array['line_items'];
    $total=$array['total'];
  $itemstr="\n";
  $costarr=array();
  $i=0;
//  foreach($items as $key => $value){

  foreach($items as $value){
      $cost=$value['total'];
      $itemstr.=$value['name']." (₹$cost) \n";
      $i+=1;
  }
  //$itemname=$no['name'];
 // $sline=$array['shipping_lines'];
  //$lineno=$sline[0];
  $itemcost=$array['total'];
  $message="Hey $fname $lastname, your order  $id,$itemstr with a total cost of ₹$total has been received and is $status. Thank you!";
    $conn->query("INSERT INTO test2 VALUES (\N,'buyer','$final')");
      $conn->close();    

// header("Location: https://api.telegram.org/bot1249887668:AAGQ0SZ0TCMNJkmzN1IpyvguaZTedQF4i50/sendMessage?chat_id=744292123&text=Hi"); 
include 'Telegram.php';

$bot_token = '1249887668:AAGQ0SZ0TCMNJkmzN1IpyvguaZTedQF4i50';
$telegram = new Telegram($bot_token);
$content = ['chat_id' => $final, 'text' => $message];
        $telegram->sendMessage($content);
?>

<!--<meta http-equiv = "refresh" content = "2; url = https://web-team2.000webhostapp.com/pos.php" />-->

<!--<form action="https://api.telegram.org/bot1249887668:AAGQ0SZ0TCMNJkmzN1IpyvguaZTedQF4i50/sendMessage" method="POST" >-->
<!--<input name="chat_id" value="744292123"/>-->
<!--<input name="text" value="Adharsh"/>-->
<!--    <button id="summa" type="submit">SUBMIT</button>-->
    
<!--</form>-->
<!--<script>-->
<!--    document.querySelector('#summa').click();-->
<!--</script>-->
