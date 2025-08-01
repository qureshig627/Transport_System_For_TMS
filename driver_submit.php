<?php session_start();
if(isset($_SESSION["id"]) && $_SESSION["id"]){
	if(isset($_POST) && $_POST){
		
		if(isset($_POST["name"]) && $_POST["name"]){
		
			require_once("config/config.php");			// required config.php to Use Database Variable/Instance

			$name = $_POST["name"];
			$mobile = $_POST["mobile"];

		
			// CHECK FOR ID EXIST. IF EXIST UPDATE ELSE INSERT
			if(isset($_POST['id']) && $_POST['id']){
				// UPDATE
				$sqlstatement = $conn->prepare("UPDATE drivers SET `name` = ?, `mobile` = ? WHERE `id`= ?");
				$sqlstatement->bind_param("ssi",$name, $mobile, $_POST['id']);
			}else{
				// INSERT

				// prepare and bind
				$sqlstatement = $conn->prepare("INSERT INTO drivers (`name`, `mobile`) VALUES (?, ?)");
				$sqlstatement->bind_param("ss",$name, $mobile);

			}
			$sqlstatement->execute();
			$sqlstatement->close();
			$conn->close();
			$_SESSION["success"] = "Driver added successfully";
			header("Location:drivers.php");
		}else{
			$_SESSION["error"] = "Please enter name add/update driver";
			header("Location:driver.php");
		}
	}
}else{
	//header("Location:login.php?error=Please Login to Add Product");
	$_SESSION["error"] = "Please Login to Add driver";
	header("Location:login.php");
}

?>