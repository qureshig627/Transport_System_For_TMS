<?php

require_once("config/config.php");

$sql = "SELECT * FROM drivers";
$result = $conn->query($sql);
$driver = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $obj = new stdClass();
	  $obj->id = $row["id"];	  
	  $obj->name = $row["name"];
	  $obj->mobile= $row["mobile"];
    $driver[] = $obj;
  }
} else {
  echo "0 results";
}
$conn->close();

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title> Transport </title>
	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		
		td,
		th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
		
		tr:nth-child(even) {
			background-color: #dddddd;
		}
		
		.center {
			border: 5px solid;
			display: flex;
			justify-content: center;
		}
	</style>
</head>

<body>
	<div class="container">
		<h2>driver</h2>
		<div class="center">
			<table>
				<!-- THIS IS FOR TABLE HEAD -->
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Mobile number</th>
				</tr>
				<?php 
				foreach($driver as $bookIndex => $book){
				?>
				<tr>
					<?php 					
						foreach($book as $value){
							echo '<td>' . $value. '</td>';
						}				
					?>
				</tr>
				<?php 
					}
				?>

			</table>
			<div>
        <button> <a href="edit.php">Edit</a>  </button>

			</div>
		</div>
	</div> 
</body>

</html>