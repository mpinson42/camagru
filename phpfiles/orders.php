<?php
function	create_orders($orders, $client_id, $items)
{
	$order["client_id"]=$client_id;
	$order["items"]=$items;
	$orders[]=$order;
	echo "Order created\n";
	return $orders;
}

function	delete_orders($orders, $order_id)
{
	foreach($orders as $key=>$order)
	{
		if ($key === $order_id)
		{
			$orders[$key]="";
			echo "Order deleted\n";
			return $orders;
		}
	}
	echo "Order not found\n";
	return $orders;
}
?>
