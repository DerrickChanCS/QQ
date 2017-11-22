<?php
    header('Content-Type: application/json');
    //initialize response array
    //Desired outcome: roomExists is true and usernameExists is false
    $response = array("questionExists" => "false");

    //Standard database connection info
    include 'password.php';
	$conn = oci_connect($username,
			$password,
			'//dbserver.engr.scu.edu/db11g');
    if ($conn) {}
    $roomCode = $_POST['roomCode'];
    $checkUser = $_POST['username'];

    $sql = "Select * from Questions where room = :roomCode and username = :username";
    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ":roomCode", $roomCode);
    oci_bind_by_name($compiled, ":username", $checkUser);
    oci_execute($compiled);

    $num_rows = oci_fetch_all($compiled,$res);
    if ($num_rows == 0){
        $response["questionExists"] = "false";
    } else {
        $response["questionExists"] = "true";
    }
    
    echo json_encode($response);
?>
