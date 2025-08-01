<?php
session_start();
require_once("config/config.php");

$row = array();
if (isset($_GET["id"])) {

    // Object Oriented style
    $sql = "SELECT s.*, d.name AS driver_name, v.name AS vehicle_name, c.name AS customer_name, c.mobile_no AS customer_mobile, c.address AS customer_address";
    $sql .= " FROM shipment AS s";
    $sql .= " INNER JOIN drivers AS d ON s.`driver_id` = d.id";
    $sql .= " INNER JOIN vehicles AS v ON s.`vehicle_id` = v.id";
    $sql .= " INNER JOIN customer AS c ON s.`customer_id` = c.id";
    $sql .= " WHERE s.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc(); // fetch the data   
    $result->free_result();
}
?>
<html>
<head>
	<title>Advanced Invoice</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/invoice.css">
</head>
<body>
	<div class="invoice-container">
		<div class="invoice-header">
			<h1>Invoice</h1>
			<p class="invoice-number">Invoice #<?php echo $row["reference_no"];?></p>
			<p class="invoice-date">Date: <?php echo date("d F Y", strtotime($row["date"]));?></p>
		</div>
		<div class="invoice-customer">
			<h2>Customer Details</h2>
			<p class="customer-name"><b><?php echo $row["customer_name"];?></b></p>
			<p class="customer-email"><?php echo $row["customer_mobile"];?></p>
			<p class="customer-address"><?php echo $row["customer_address"];?></p>
		</div>
		<table class="invoice-items" width="100%" cellpadding="5" cellspacing="5">
			<thead>
				<tr>
					<th colspan="2">Description</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><b>Collection Address: </b><br /><?php echo $row["collection_address"];?></td>
					<td><b>Delivery Address: </b><br /><?php echo $row["delivery_address"];?></td>
					<td class="w3-center">₹. <?php echo $row["price"];?></td>
				</tr>
				<tr> <td colspan="3"></td></tr>
				<tr>
					<td class="w3-right-align"><b>Vehicle: </b></td>
					<td><?php echo $row["vehicle_name"];?></td>
					<td></td>
				</tr>
				<tr>
				<td class="w3-right-align"><b>Driver: </b></td>
					<td><?php echo $row["driver_name"];?></td>
					<td></td>
				</tr>
				<tr>
				<td class="w3-right-align"><b>Delivered Date: </b></td>
					<td><?php echo date("d F Y", strtotime($row["delivered_date"]));?></td>
					<td></td>
				</tr>
				<tr> <td colspan="3"></td></tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2" class="w3-right-align">Total:</td>
					<td class="w3-center">₹. <?php echo $row["price"];?></td>
				</tr>
			</tfoot>
		</table>
		<p class="print w3-center w3-padding-small w3-margin"><a class="button w3-green" href="Javascript:void(0);" onclick="window.print();">Print</a></p>
	</div>
</body>
</html>
