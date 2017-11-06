<?php
    header('Content-Type: application/json');
    $response = array("isExists" => "true");
    include 'password.php';
	$conn = oci_connect($username,
			$password,
			'//dbserver.engr.scu.edu/db11g');
    if ($conn) {}
    $roomCode = $_POST['roomCode'];
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
        $response["isExists"] = "false";
    } else {
        $response["isExists"] = "true";
    }
    
    echo json_encode($response);
?>
