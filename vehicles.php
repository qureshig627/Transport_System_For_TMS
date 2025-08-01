<?php session_start(); require_once("config/config.php");?>
<!DOCTYPE html>
<html>

<head>
	<title>Customers</title>
	<meta name="description" content="Mahatma Gandhi International School is a successful and award winning Public Private Partnership between educationalists Dr. Pascal Chazot">
	<meta name="keywords" content="education, learning, students, computer coding, information technology">

	<?php include_once ("config/assets.php"); ?>
</head>

<body>
	<!-- Navbar (sit on top) -->
	<?php include_once ("modules/header.php"); ?>

	<div class="w3-container" style="padding:128px 16px;">
		<div class="container">
		
		<?php 	
		if(isset($_SESSION["success"]) && $_SESSION["success"]){
					echo '<p><label class="text-sucess">'.$_SESSION["success"].'</label></p>';
					unset($_SESSION["success"]);
				}else if(isset($_SESSION["error"]) && $_SESSION["error"]){
					echo '<p><label class="text-danger">'.$_SESSION["error"].'</label></p>';
						unset($_SESSION["error"]);
				} 
		?>
			<h1>Vehicles</h1>
			<p class="w3-right-align"><a class="button w3-green" href="vehicle.php">New</a></p>
			<div class="table-responsive">
				<table class="table table-striped w3-table w3-bordered w3-striped" width="100%" cellpadding="5" cellspacing="5" border="1">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Plate number</th>
						<th>Length</th>
						<th>Height</th>
                        <th>Width</th>
						<th>Capacity</th>
                        <th>Action</th>
					</tr>
					<?php
					// Object Oriented style
					$sql = "SELECT * FROM vehicles"; // PULL ALL ACTIVE PRODUCTS FROM DATABASE
					$result = $conn->query( $sql ); // mysqli_query performs a query against a database.
					if ( $result->num_rows > 0 ) {
						// output data of each row
						while ( $row = $result->fetch_assoc() ) { // LOOP THROUGHT EACH DATABASE ROW
							?>
							<tr>
								<td>
									<?php echo $row["id"];?>
								</td>
								<td> <?php echo $row["name"];?> </td>
								<td>
									<?php echo $row["plate_number"];?>
								</td>
								<td>
									<?php echo $row["length"];?>
								</td>
                                <td>
									<?php echo $row["height"];?>
								</td>
								<td> <?php echo $row["width"];?> </td>
								<td>
									<?php echo $row["capacity"];?>
								</td>
								
								<td>
									<a class="button" href="vehicle.php?id=<?php echo $row["id"];?>">Edit</a>
								</td>
							</tr>
							<?php
						}
					}
					$result->free_result();
					?>
				</table>
			</div>
		</div>
	</div>
	<?php 	include_once ("modules/footer.php");
			include_once ("config/scripts.php");
	?>

</body>
</html>