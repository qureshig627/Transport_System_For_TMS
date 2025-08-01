<?php
session_start();
require_once("config/config.php");

// POPULATE DATA FROM DRIVERS
$list_drivers = array();
// Object Oriented style
$sql = "SELECT * FROM drivers"; // PULL ALL ACTIVE PRODUCTS FROM DATABASE
$driver_result = $conn->query($sql); // mysqli_query performs a query against a database.
if ($driver_result->num_rows > 0) {
    // output data of each row
    while ($driver_row = $driver_result->fetch_assoc()) { // LOOP THROUGHT EACH DATABASE ROW
        $obj = new stdClass();
        $obj->id = $driver_row['id'];
        $obj->name = $driver_row['name'];
        $list_drivers[] = $obj;
    }
}
//echo "<pre>"; print_r($list_drivers); echo "</pre>";

// POPULATE DATA FROM CUSTOMER
$list_customer = array();
// Object Oriented style
$sql = "SELECT * FROM customer"; // PULL ALL ACTIVE PRODUCTS FROM DATABASE
$list_result = $conn->query($sql); // mysqli_query performs a query against a database.
if ($list_result->num_rows > 0) {
    // output data of each row
    while ($customer_row = $list_result->fetch_assoc()) { // LOOP THROUGHT EACH DATABASE ROW
        $obj = new stdClass();
        $obj->id = $customer_row['id'];
        $obj->name = $customer_row['name'];
        $list_customer[] = $obj;
    }
}
//echo "<pre>"; print_r($list_customer); echo "</pre>";


// POPULATE DATA FROM CUSTOMER
$list_vehicles = array();
// Object Oriented style
$sql = "SELECT * FROM vehicles"; // PULL ALL ACTIVE PRODUCTS FROM DATABASE
$vehicles_result = $conn->query($sql); // mysqli_query performs a query against a database.
if ($vehicles_result->num_rows > 0) {
    // output data of each row
    while ($vehicles_row = $vehicles_result->fetch_assoc()) { // LOOP THROUGHT EACH DATABASE ROW
        $obj = new stdClass();
        $obj->id = $vehicles_row['id'];
        $obj->name = $vehicles_row['name'];
        $list_vehicles[] = $obj;
    }
}
//echo "<pre>"; print_r($list_vehicles); echo "</pre>";

$row = array();
if (isset($_GET["id"])) {

    // Object Oriented style
    $sql = "SELECT * FROM shipment WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET["id"]);
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
    <title>shipment </title>
    <meta name="description"
        content="Mahatma Gandhi International School is a successful and award winning Public Private Partnership between educationalists Dr. Pascal Chazot">
    <meta name="keywords" content="education, learning, students, computer coding, information technology">

    <?php include_once("config/assets.php"); ?>


</head>

<body>
    <!-- Navbar (sit on top) -->
    <?php include_once("modules/header.php"); ?>

    <div class="w3-container" style="padding:128px 16px;">


        <div class="container">
            <?php if (isset($_SESSION["success"]) && $_SESSION["success"]) {
                echo '<p><label class="text-sucess">' . $_SESSION["success"] . '</label></p>';
                unset($_SESSION["success"]);
            } else if (isset($_SESSION["error"]) && $_SESSION["error"]) {
                echo '<p><label class="text-danger">' . $_SESSION["error"] . '</label></p>';
                unset($_SESSION["error"]);
            }
            ?>

            <h1>Shipment</h1>
            <form class="form-horizontal" name="shipmentform" action="shipment_submit.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label> Reference No. </label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="reference_no" maxlength="100" required
                            value="<?php if (isset($row['reference_no']) && $row['reference_no']) {
                                echo $row['reference_no'];
                            } ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label> Driver </label>
                    </div>
                    <div class="col-75">
                        <select name="driver_id">
                            <option value="0">Select Driver</option>
                            <?php if ($list_drivers) {
                                foreach ($list_drivers as $list_driver) {
                                    ?>
                                    <option <?php if(isset($row['driver_id']) && $list_driver->id == $row['driver_id']){ echo ' selected="selected"';}?> value="<?php echo $list_driver->id; ?>"><?php echo $list_driver->name; ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-25">
                        <label> Customer </label>
                    </div>
                    <div class="col-75">
                        <select name="customer_id">
                            <option value="0">Select Customer</option>
                            <?php if ($list_customer) {
                                foreach ($list_customer as $list_customer) {
                                    ?>
                                    <option <?php if(isset($row['customer_id']) && $list_customer->id == $row['customer_id']){ echo ' selected="selected"';}?>  value="<?php echo $list_customer->id; ?>"><?php echo $list_customer->name; ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label> Vehicle </label>
                    </div>
                    <div class="col-75">
                        <select name="vehicle_id">
                            <option value="0">Select Vehicle</option>
                            <?php if ($list_vehicles) {
                                foreach ($list_vehicles as $list_vehicles) {
                                    ?>
                                    <option <?php if(isset($row['vehicle_id']) && $list_vehicles->id == $row['vehicle_id']){ echo ' selected="selected"';}?> value="<?php echo $list_vehicles->id; ?>"><?php echo $list_vehicles->name; ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
                    </div>


                </div>


        

        <div class="row">
            <div class="col-25">
                <label> price </label>
            </div>
            <div class="col-75">
                <input type="number" name="price" maxlength="100" required
                    value="<?php if (isset($row['price']) && $row['price']) {
                        echo $row['price'];
                    } ?>" />
            </div>

        </div>

        <div class="row">
            <div class="col-25">
                <label> collection address </label>
            </div>
            <div class="col-75">
                <textarea name="collection_address" maxlength="150"><?php if (isset($row['collection_address']) && $row['collection_address']) {
                        echo $row['collection_address'];
                    } ?></textarea>
            </div>
        </div>

        <div class="row">

            <div class="col-25">
                <label> delivery address </label>
            </div>
            <div class="col-75">
            <textarea name="delivery_address" maxlength="150"><?php if (isset($row['delivery_address']) && $row['delivery_address']) {
                        echo $row['delivery_address'];
                    } ?></textarea>
            </div>
        </div>

        <div class="row">

            <div class="col-25">
                <label> status </label>
            </div>
            <div class="col-75">
          
                <select name="status">
                    <option  <?php 
                    if (isset($row['status']) && $row['status']==0) {
                        echo ' selected="selected"';
                    } ?>  value="0">Pending</option>
                    <option   <?php 
                    if (isset($row['status']) && $row['status']==1) {
                        echo ' selected="selected"';
                    } ?> value="1">Delivered</option>
                </select>
            </div>
        </div>
        
        <div class="row">

            <div class="col-25">
                <label> Date </label>
            </div>
            <div class="col-75">
                <input type="date" name="date" value="<?php if (isset($row['date']) && $row['date']) {
                        echo $row['date'];
                    }else{ echo date("Y-m-d");} ?>" />
          
            </div>
        </div>

        <div class="row w3-center">
            <a href="shipments.php" class="button">Cancel</a>
            <input class="button" type="submit" value="Submit">
        </div>

        <input type="hidden" name="id" value="<?php if (isset($row['id']) && $row['id']) {
            echo $row['id'];
        } ?>" />
        </form>
    </div>

    </div>
    <?php include_once("modules/footer.php");
    include_once("config/scripts.php");
    ?>

</body>

</html>