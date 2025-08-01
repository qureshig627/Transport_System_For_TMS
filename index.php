<?php session_start();
require_once("config/config.php");

	$total_driver = 0;
    // Object Oriented style
    $sql = "SELECT COUNT(id) AS total_driver FROM drivers";
    $stmt = $conn->prepare($sql);
  	$stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc(); // fetch the data   
    if($row['total_driver']){
		$total_driver = $row['total_driver'];
	}
    $result->free_result();

	$total_customer = 0;
    // Object Oriented style
    $sql = "SELECT COUNT(id) AS total_customer FROM customer";
    $stmt = $conn->prepare($sql);
  	$stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc(); // fetch the data   
    if($row['total_customer']){
		$total_customer = $row['total_customer'];
	}
    $result->free_result();

	$total_vehicles = 0;
    // Object Oriented style
    $sql = "SELECT COUNT(id) AS total_vehicles FROM vehicles";
    $stmt = $conn->prepare($sql);
  	$stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc(); // fetch the data   
    if($row['total_vehicles']){
		$total_vehicles = $row['total_vehicles'];
	}
    $result->free_result();


	$total_shipment = 0;
    // Object Oriented style
    $sql = "SELECT COUNT(id) AS total_shipment FROM shipment WHERE status = 1";
    $stmt = $conn->prepare($sql);
  	$stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc(); // fetch the data   
    if($row['total_shipment']){
		$total_shipment = $row['total_shipment'];
	}
    $result->free_result();



?>
<!DOCTYPE html>
<html>

<head>
	<title>Programming | Mahatma Gandhi International School</title>
	<meta name="description" content="Mahatma Gandhi International School is a successful and award winning Public Private Partnership between educationalists Dr. Pascal Chazot">
	<meta name="keywords" content="education, learning, students, computer coding, information technology">

        <script type="text/javascript">
            /**
             * Configuration Variables - CHANGE THESE!
             */
            const MIXPANEL_PROJECT_TOKEN = "c2748f58c25c7a69cb73d4bff0f331205"; 
            const MIXPANEL_PROXY_DOMAIN = "http://localhost:8888/transport/index.php"; 
            
            /**
             * Set the MIXPANEL_CUSTOM_LIB_URL - No need to change this
             */
            const MIXPANEL_CUSTOM_LIB_URL = MIXPANEL_PROXY_DOMAIN + "/lib.min.js";
            
            /**
             * Load the Mixpanel JS library asyncronously via the js snippet
             */
            (function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);
            
            /**
             * Initialize a Mixpanel instance using your project token and proxy domain
             */
            mixpanel.init(MIXPANEL_PROJECT_TOKEN, {debug: true, api_host: MIXPANEL_PROXY_DOMAIN});
            
            /**
             * Track an event when the page is loaded
             */
            mixpanel.track("[Proxy Demo] Page loaded");
        </script>
    
       
  
	<?php include_once ("config/assets.php"); ?>



</head>

<body>

	<!-- Navbar (sit on top) -->
	<?php include_once ("modules/header.php"); ?>

	<div class="w3-container" style="padding:128px 16px; text-align: center;">
		<?php 	if(isset($_SESSION["success"]) && $_SESSION["success"]){
					echo '<p><label class="text-sucess">'.$_SESSION["success"].'</label></p>';
					unset($_SESSION["success"]);
				}else if(isset($_SESSION["error"]) && $_SESSION["error"]){
					echo '<p><label class="text-danger">'.$_SESSION["error"].'</label></p>';
					unset($_SESSION["error"]);
				} 
		?>
		<?php if(isset($_SESSION['id']) && $_SESSION['id']){ ?>
		<h1>Hello <?php echo $_SESSION['username'];?>!</h1>
		<p><a href="logout.php" onclick="return confirm('Are you sure?')">Logout</a>
		</p>

		<div class="stat-group">
    <div class="stats">
      <div class="stats-item">
        <p class="label">Drivers</p>
        <div class="stat"><?php echo $total_driver;?></div>
      </div>
      <div class="stats-item">
        <p class="label">customers</p>
        <div class="stat"><?php echo $total_customer;?></div>
      </div>
      <div class="stats-item">
        <p class="label">Vehicles</p>
        <div class="stat"><?php echo $total_vehicles;?></div>
      </div>
      <div class="stats-item">
        <p class="label">Delivered shipments</p>
        <div class="stat"><?php echo $total_shipment;?></div>
      </div>
    </div>
  </div>

		<?php }else{ ?>
		<h1>Login</h1>
		<form method="POST" action="login_submit.php">
			<label>Username:</label>
			<input type="text" name="username">
			<br>
			<label>Password:</label>
			<input type="password" name="password">
			<br>
			<input type="submit" name="login_submit" value="Login">
		</form>
		<?php } ?>
	</div>
	<?php 	include_once ("modules/footer.php");
			include_once ("config/scripts.php");
	?>

<button onclick="mixpanel.track('[Proxy Demo] Button clicked')">Track event</button>

</body>

</html>