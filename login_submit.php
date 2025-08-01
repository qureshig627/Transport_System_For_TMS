<?php session_start();
if(isset($_POST) && $_POST){
	require_once("config/config.php");
		
	$username = $_POST['username'];
	$password = $_POST['password'];
	 
	$sql = "SELECT * FROM users WHERE username='".$username."' AND password='".md5($password)."'";
	$result = mysqli_query($conn, $sql);	
	
	
	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		$_SESSION['id'] = $row['id'];
		header("Location: index.php");
	}else{
		$_SESSION["error"] = "Invalid credentials!";
		header("Location: index.php");
	}	
}else{
	header("Location: index.php");
}


?>