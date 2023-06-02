<?php

require_once "pdo.php";

session_start();


if (isset($_SESSION['user'])){
	$sql = "SELECT * FROM users WHERE user_id = :user";
	//just for demonstration - delete
    echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
	$stmt->execute(['user' => $_SESSION['user']]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	//$user = $stmt->fetchColumn();
	//just for demonstration - delete
	print_r($user);
	$username = $user["name"];
}
else{
	header('Location: login.php ');

}
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Members Area</title>
    
</head>
<body>
	<h1>Welcome <?= $username?></h1>
	<a href="logout.php"><button type = "button">Log Out</button></a?
	
</body>
</html>

