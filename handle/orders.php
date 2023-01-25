<?php

include_once "db.php";

//Get orders from DB
$order_data = $db->query("SELECT * FROM orders");
$order_details_data = $db->query("SELECT * FROM order_details");

if(isset($_GET['account_id'])) {
    
    $order_data = $db->prepare("SELECT * FROM orders WHERE account_id= :account_id");
    $order_data->bindParam(':account_id', $_GET['account_id']);
    $order_data->execute();

} 
if(isset($_GET['order_id'])) {

    $order_data = $db->prepare("SELECT * FROM orders WHERE order_id= :order_id");
    $order_data->bindParam(':order_id', $_GET['order_id']);
    $order_data->execute();
    
}


if($order_data->rowCount()) {
    while($order = $order_data->fetch(PDO::FETCH_OBJ)) {

        $data = array('order_id'=> $order->order_id, 'account_id'=> $order->account_id, 'date'=> $order->date, 'total_price'=> $order->total_price, 'total_quantity'=> $order->total_quantity, 'items'=>  getOrderDetails($order->order_id));

        echo json_encode((object) $data, JSON_PRETTY_PRINT);


    }
} else {
    echo "[]";
}	


function getOrderDetails($order_id) {
    global $db;

    $order_details_data = $db->prepare("SELECT * FROM order_details WHERE order_id=:order_id");
    $order_details_data->bindParam(':order_id', $order_id);
    $order_details_data->execute();

    $details_array = array();

    if($order_details_data->rowCount()) {
        while($order_detail = $order_details_data->fetch(PDO::FETCH_OBJ)) {

            //if($order_detail->book_id )

            $data =  array('book_id' =>$order_detail->book_id, 'price' =>$order_detail->price, 'quantity' => $order_detail->quantity);
    
            array_push($details_array, $data);
            //array_push($details_array, $order_detail->price);
    
        }
    } 
    return $details_array;

}
			
?>