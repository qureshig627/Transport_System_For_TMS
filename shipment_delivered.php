<?php session_start();
	if(isset($_GET["id"]) && $_GET["id"]) {
		require_once("config/config.php");
		
		$sql = "UPDATE shipment SET `status` = 1, `delivered_date` = '".date("Y-m-d")."' WHERE id = ?";
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("i", $_GET["id"]);
		$stmt->execute();
		
		
		$_SESSION["success"] = "Shipment delievered successfully";		
	}
	
	header("Location:shipments.php");
?>