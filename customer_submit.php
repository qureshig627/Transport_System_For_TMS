<?php session_start();
if(isset($_SESSION["id"]) && $_SESSION["id"]){
	if(isset($_POST) && $_POST){
		
		if(isset($_POST["name"]) && $_POST["name"]){
		
			require_once("config/config.php");			// required config.php to Use Database Variable/Instance

			$name = $_POST["name"];
			$mobile = $_POST["mobile"];
            $address = $_POST["address"];

		
			// CHECK FOR ID EXIST. IF EXIST UPDATE ELSE INSERT
			if(isset($_POST['id']) && $_POST['id']){
				// UPDATE
				$sqlstatement = $conn->prepare("UPDATE customer SET `name` = ?, `mobile_no` = ?,`address` = ? WHERE `id`= ?");
				$sqlstatement->bind_param("sssi",$name, $mobile,$address, $_POST['id']);
			}else{
				// INSERT

				// prepare and bind
				$sqlstatement = $conn->prepare("INSERT INTO customer (`name`, `mobile_no`, `address`) VALUES (?, ?,?)");
				$sqlstatement->bind_param("sss",$name, $mobile, $address);

			}
			$sqlstatement->execute();
			$sqlstatement->close();
			$conn->close();
			$_SESSION["success"] = "Customer added successfully";
			header("Location:customers.php");
		}else{
			$_SESSION["error"] = "Please enter name add/update customer";
			header("Location:customer.php");
		}
	}
}else{
	//header("Location:login.php?error=Please Login to Add Product");
	$_SESSION["error"] = "Please Login to Add customer";
	header("Location:login.php");
}

?>x