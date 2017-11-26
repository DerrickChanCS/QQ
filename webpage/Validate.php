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
    //echo $roomCode;

    //$sql = "Select * from Rooms";
    $sql = "Select * from Rooms where code = :roomCode";
    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ":roomCode", $roomCode);
    oci_execute($compiled);

    $num_rows = oci_fetch_all($compiled,$res);
    //echo $num_rows;
    //var_dump($res);
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
    //echo $num_rows;
    //var_dump($res);
    if ($num_rows == 0 && $response["roomExists"] == "true"){
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
