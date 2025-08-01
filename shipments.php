<?php session_start(); require_once("config/config.php");

$status = isset($_GET["status"]) ? $_GET["status"] : 0;
?>
<!DOCTYPE html>
<html>

<head>
	<title>shipments</title>
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
			<h1>Shipments</h1>
			<form class="form-horizontal" action="" name="shipments-form">
				<p class="w3-center">
				<select name="status" onchange="this.form.submit();" style="width:auto;">
						<option <?php if($status == 0){ echo ' selected';}?> value="0">Pending</option>
						<option <?php if($status == 1){ echo ' selected';}?> value="1">Delivered</option>
					</select>
				</p>
				</form>
			<p class="w3-right-align"><a class="button w3-green" href="shipment.php">New</a></p>
			<div class="table-responsive">
				<table class="table table-striped w3-table w3-bordered w3-striped" width="100%" cellpadding="5" cellspacing="5" border="1">
					<tr>
						<th style="min-width:125px;">Date</th>
						<th>Reference No</th>
						<th>Customer</th>
                        <th>Driver</th>
						<th>vehicle</th>
						<th>price</th>
                        <th>collection address</th>
						<th>delivery address</th>
						<th>status</th>
						<th style="min-width:150px;">Action</th>
					</tr>
					<?php
					// Object Oriented style
					// PULL ALL SHIPMENTS
					$sql = "SELECT s.*, d.name AS driver_name, v.name AS vehicle_name, c.name AS customer_name";
					$sql .= " FROM shipment AS s";
					$sql .= " INNER JOIN drivers AS d ON s.`driver_id` = d.id";
					$sql .= " INNER JOIN vehicles AS v ON s.`vehicle_id` = v.id";
					$sql .= " INNER JOIN customer AS c ON s.`customer_id` = c.id";
					$sql .= " WHERE s.status = ".$status;
					$sql .= " ORDER BY s.`date` ASC";

					$result = $conn->query( $sql ); // mysqli_query performs a query against a database.
					if ( $result->num_rows > 0 ) {
						// output data of each row
						while ( $row = $result->fetch_assoc() ) { // LOOP THROUGHT EACH DATABASE ROW
							?>
							<tr>
								<td>
									<?php echo $row["date"];?>
								</td>
								<td> <?php echo $row["reference_no"];?> </td>
								<td>
									<?php echo $row["customer_name"];?>
								</td>
                                <td>
									<?php echo $row["driver_name"];?>
								</td>
								<td> <?php echo $row["vehicle_name"];?> </td>
								<td>
									<?php echo $row["price"];?>
								</td>
                                <td>
									<?php echo $row["collection_address"];?>
								</td>
								<td> <?php echo $row["delivery_address"];?> </td>
								<td>
									<?php if ($row["status"]==1) {echo "Delivered"; }else{echo "Pending";}?>
								</td>
								<td>
									<?php if ($row["status"]==0) {
										?>
										<a class="button w3-green" href="shipment_delivered.php?id=<?php echo $row["id"];?>"><span>&#10003;</span></a>
										<a class="button" href="shipment.php?id=<?php echo $row["id"];?>">Edit</a>
										<?php
									}else{?>
										<a class="button w3-green" href="Javascript:void(0)" onclick='window.open("invoice.php?id=<?php echo $row["id"];?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=700,height=500");'>Print Invoice</a>
									<?php } ?>
									
				
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