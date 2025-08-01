<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="index.php" class="w3-bar-item w3-button w3-wide"><img src="assets/images/logo-bg.png" height="35px" width="75px" ></a>
	<?php if(isset($_SESSION['id']) && $_SESSION['id']){ ?> 
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="index.php" class="w3-bar-item w3-button"> Home</a>
		<a href="drivers.php" class="w3-bar-item w3-button"> Drivers</a>
    <a href="customers.php" class="w3-bar-item w3-button"> customers</a>
    <a href="vehicles.php" class="w3-bar-item w3-button"> Vehicles</a>
    <a href="shipments.php" class="w3-bar-item w3-button"> Shipments</a>
    </div>
	
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a><?php } ?>
  </div>
</div>

<?php if(isset($_SESSION['id']) && $_SESSION['id']){ ?> 
<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button">Home</a>
	<a href="drivers.php" onclick="w3_close()" class="w3-bar-item w3-button">Drivers</a>
  <a href="customers.php" onclick="w3_close()" class="w3-bar-item w3-button">Customers</a>
  <a href="vehicles.php" onclick="w3_close()" class="w3-bar-item w3-button">Vehicles</a>
	<a href="shipments.php" onclick="w3_close()" class="w3-bar-item w3-button">Shipments</a>
</nav>
<?php } ?>