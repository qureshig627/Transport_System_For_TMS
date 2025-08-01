<?php session_start();
if(isset($_SESSION["id"]) && $_SESSION["id"]){
	if(isset($_POST) && $_POST){
		
	

		if(isset($_POST["reference_no"]) && $_POST["reference_no"] && isset($_POST["customer_id"]) && $_POST["customer_id"] && isset($_POST["driver_id"]) && $_POST["driver_id"] && isset($_POST["vehicle_id"]) && $_POST["vehicle_id"] && isset($_POST["price"]) && $_POST["price"] && isset($_POST["collection_address"]) && $_POST["collection_address"] && isset($_POST["delivery_address"]) && $_POST["delivery_address"] && isset($_POST["status"]) && isset($_POST["date"]) && $_POST["date"]){
		
			require_once("config/config.php");			// required config.php to Use Database Variable/Instance

			$refrence_no = $_POST["reference_no"];
			$customer_id = $_POST["customer_id"];
            $driver_id = $_POST["driver_id"];
			$vehicle_id = $_POST["vehicle_id"];
            $price = $_POST["price"];
			$collection = $_POST["collection_address"];
            $delivery = $_POST["delivery_address"];
			$status = $_POST["status"];
			$date = $_POST["date"];


		
			// CHECK FOR ID EXIST. IF EXIST UPDATE ELSE INSERT
			if(isset($_POST['id']) && $_POST['id']){
				// UPDATE
				$sqlstatement = $conn->prepare("UPDATE shipment SET `reference_no` = ?, `customer_id` = ?, `driver_id` = ?,
                `vehicle_id` = ?, `price` = ?,`collection_address` = ?, `delivery_address` = ?, `status` = ?, `date` = ? WHERE `id`= ?");
				$sqlstatement->bind_param("siiiissisi",$refrence_no, $customer_id,$driver_id, $vehicle_id,$price, $collection,$delivery, $status,$date, $_POST['id']);
			}else{
				// INSERT

				// prepare and bind
				$sqlstatement = $conn->prepare("INSERT INTO shipment (`reference_no`, `customer_id`, `driver_id`, `vehicle_id`,
                `price`, `collection_address`, `delivery_address`, `status`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$sqlstatement->bind_param("siiiissis",$refrence_no, $customer_id,$driver_id, $vehicle_id, $price, $collection, $delivery, $status, $date);

			}
			$sqlstatement->execute();
			$sqlstatement->close();
			$conn->close();
			$_SESSION["success"] = "Shipment added successfully";
			header("Location:shipments.php");
		}else{
			$_SESSION["error"] = "Please fill all details to add/update shipment";
			header("Location:shipment.php");
		}
	}
}else{
	//header("Location:login.php?error=Please Login to Add Product");
	$_SESSION["error"] = "Please Login to Add shipment";
	header("Location:login.php");
}
?>