<?php
session_start();
$row = array();
if ( isset( $_GET[ "id" ] ) ) {
	require_once( "config/config.php" );
	// Object Oriented style
	$sql = "SELECT * FROM vehicles WHERE id = ?";
	$stmt = $conn->prepare( $sql );
	$stmt->bind_param( "i", $_GET[ "id" ] );
	$stmt->execute();
	$result = $stmt->get_result(); // get the mysqli result
	$row = $result->fetch_assoc(); // fetch the data   
	//echo "<pre>"; print_r($row); echo "</pre>";
	$result->free_result();
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Vehicle</title>
	<meta name="description" content="Mahatma Gandhi International School is a successful and award winning Public Private Partnership between educationalists Dr. Pascal Chazot">
	<meta name="keywords" content="education, learning, students, computer coding, information technology">

	<?php include_once ("config/assets.php"); ?>


</head>

<body>
	<!-- Navbar (sit on top) -->
	<?php include_once ("modules/header.php"); ?>

	<div class="w3-container" style="padding:128px 16px;">
		

		<div class="container">
			<?php 	if(isset($_SESSION["success"]) && $_SESSION["success"]){
					echo '<p><label class="text-sucess">'.$_SESSION["success"].'</label></p>';
					unset($_SESSION["success"]);
				}else if(isset($_SESSION["error"]) && $_SESSION["error"]){
					echo '<p><label class="text-danger">'.$_SESSION["error"].'</label></p>';
						unset($_SESSION["error"]);
				} 
		?>

		<h1>Vehicle</h1>
			<form class="form-horizontal" name="vehicleform" action="vehicle_submit.php" method="post" >
				<div class="row">
					<div class="col-25">
						<label> Name *</label>
					</div>
					<div class="col-75">
						<input type="text" name="name" maxlength="100" required value="<?php if(isset($row['name']) && $row['name']){ echo $row['name'];}?>"/>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label> Plate number </label>
					</div>
					<div class="col-75">
						<input type="text" name="plate_number" maxlength="15" required value="<?php if(isset($row['plate_number']) && $row['plate_number']){ echo $row['plate_number'];}?>"/>
					</div>
				</div>
                <div class="row">
					<div class="col-25">
						<label> Length </label>
					</div>
					<div class="col-75">
						<input type="text" name="length" maxlength="100" required value="<?php if(isset($row['length']) && $row['length']){ echo $row['length'];}?>"/>
					</div>
				</div>	
                <div class="row">	
                      <div class="col-25">
						<label> Height </label>
					</div>
					<div class="col-75">
						<input type="text" name="height" maxlength="100" required value="<?php if(isset($row['height']) && $row['height']){ echo $row['height'];}?>"/>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label> Width </label>
					</div>
					<div class="col-75">
						<input type="text" name="width" maxlength="15" required value="<?php if(isset($row['width']) && $row['width']){ echo $row['width'];}?>"/>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label> Capacity </label>
					</div>
					<div class="col-75">
						<input type="text" name="capacity" maxlength="15" required value="<?php if(isset($row['capacity']) && $row['capacity']){ echo $row['capacity'];}?>"/>
					</div>
				</div>
                <div class="row">
					<div class="col-25">
						<label> Description </label>
					</div>
					<div class="col-75">
						<textarea name="description" rows="3" maxlength="100" required> <?php if(isset($row['description']) && $row['description']){ echo $row['description'];}?> </textarea>
					</div>
				</div>
				<div class="row w3-center">
					<a href="vehicles.php" class="button">Cancel</a>
					<input class="button" type="submit" value="Submit">
				</div>
				<input type="hidden" name="id" value="<?php if(isset($row['id']) && $row['id']){ echo $row['id'];}?>"/>
			</form>
		</div>




	</div>
	<?php 	include_once ("modules/footer.php");
			include_once ("config/scripts.php");
	?>

</body>

</html>