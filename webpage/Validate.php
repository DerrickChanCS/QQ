<?php
    header('Content-Type: application/json');
    //initialize response array
    //Desired outcome: roomExists is true and usernameExists is false
    $response = array("roomExists" => "true", "usernameExists" => "false");

    //Standard database connection info
    include 'password.php';
	$conn = oci_connect($username,
			$password,
			'//dbserver.engr.scu.edu/db11g');
    if ($conn) {}
    $roomCode = $_POST['roomCode'];
    $checkUser = $_POST['username'];

    $sql = "Select * from Rooms where code = :roomCode";
    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ":roomCode", $roomCode);
    oci_execute($compiled);

    //Checks if roomExists
    //roomExists = false means no room
    //roomExists should be true
    $num_rows = oci_fetch_all($compiled,$res);
    if ($num_rows == 0){
        $response["roomExists"] = "false";
    } else {
        $response["roomExists"] = "true";
    }
    
    $sql = "Select * from Users where (room = :roomCode and username = :checkUser)";
    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ":roomCode", $roomCode);
    oci_bind_by_name($compiled, ":checkUser", $checkUser);
    oci_execute($compiled);

    $num_rows = oci_fetch_all($compiled,$res);
    //Checks if username exists
    //usernameExists should be false
    if ($num_rows == 0 && $response["roomExists"] == "true"){
        //Only inserts if username does not exist and room exists
        $response["usernameExists"] = "false";
        $sql = "Insert into Users Values( :roomCode , :checkUser)";
        $compiled = oci_parse($conn, $sql);
        oci_bind_by_name($compiled, ":roomCode" , $roomCode);
        oci_bind_by_name($compiled, ":checkUser" , $checkUser);
        oci_execute($compiled);
    } else {
        $response["usernameExists"] = "true";
    }
    
    echo json_encode($response);
?>
