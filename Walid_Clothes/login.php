<?php
require_once "pdo.php";
session_start();
if ( isset($_POST['email']) 
     && isset($_POST['password'])) {
	
	//this way is vulnerable
	
	
	//get the typed email and password
	
        /*
	$typed_email = $_POST['email'];
	$typed_password = $_POST['password']; 	
	
	
    
	$sql = "SELECT * FROM users WHERE email = '$typed_email' AND password= '$typed_password'";
	
	//just for demonstration - delete
	echo("<pre>\n".$sql."\n</pre>\n");
	$stmt = $pdo->query($sql);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	print_r($user);
	
	*/
	
	
	// this uses prepared statements so is not vulnerable to injection
	$statement = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($statement);
	$stmt->execute(['email' => $_POST['email']]);
	$out = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        $isFine = false;
        
	if($out){
            $isFine = password_verify($_POST['password'], $out['password']);
        }
        if($isFine) {
            $_SESSION["user"] = $out["user_id"];
            header('Location: member.php');
	}
	else{
            echo "You must enter a correct email and password";
	}
}
?>


<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Login to the Members Area</title>
    
</head>
<body>
	<!- Should use proper semantic HTML -->
	<p>Login</p>
	<form method="post">
	<p>Email:
	<input type="text" name="email"></p>
	<p>Password:
	<input type="password" name="password"></p>
	<p><input type="submit" value="Login"/></p>

</body>
</html>