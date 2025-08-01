<?php session_start();
if(isset($_SESSION["id"]) && $_SESSION["id"]){
	if(isset($_POST) && $_POST){
		
		if(isset($_POST["name"]) && $_POST["name"]){
		
			require_once("config/config.php");			// required config.php to Use Database Variable/Instance

			$name = $_POST["name"];
			$plate_number = $_POST["plate_number"];
            $length = $_POST["length"];
            $height = $_POST["height"];
			$width = $_POST["width"];
            $capacity = $_POST["capacity"];
            $description = $_POST["description"];
		
			// CHECK FOR ID EXIST. IF EXIST UPDATE ELSE INSERT
			if(isset($_POST['id']) && $_POST['id']){
				// UPDATE
				$sqlstatement = $conn->prepare("UPDATE vehicles SET `name` = ?, `plate_number` = ?,`length` = ?,`height` = ?,`width` = ?,`capacity`= ?,`description` = ? WHERE `id`= ?");
				$sqlstatement->bind_param("sssssssi",$name, $plate_number, $length, $height, $width, $capacity, $description, $_POST['id']);
			}else{
				// INSERT

				// prepare and bind
				$sqlstatement = $conn->prepare("INSERT INTO vehicles (`name`, `plate_number`, `length`,`height`, `width`,`capacity`, `description`) VALUES (?, ?, ?, ?, ?, ?, ?)");
				$sqlstatement->bind_param("sssssss",$name, $plate_number, $length, $height, $width, $capacity, $description);

			}
			$sqlstatement->execute();
			$sqlstatement->close();
			$conn->close();
			$_SESSION["success"] = "Vehicle added successfully";
			header("Location:vehicles.php");
		}else{
			$_SESSION["error"] = "Please enter name add/update vehicle";
			header("Location:vehicle.php");
		}
	}
}else{
	//header("Location:login.php?error=Please Login to Add Product");
	$_SESSION["error"] = "Please Login to Add vehicle";
	header("Location:login.php");
}

?>x