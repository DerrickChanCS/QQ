<?php
    include 'password.php';
    $conn = oci_connect( $username,
                        $password,
                        '//dbserver.engr.scu.edu/db11g');
    if ($conn) {}
    $roomCode      = $_POST['roomCode'];
    $question_text = $_POST['questionText'];
    $userName      = $_POST['userName'];
    $date          = date('Y-m-d H:i:s',time());

    $sql = "UPDATE Questions set question_text = :questionText , isresolved = 'y' , time_stamp = :ts WHERE username = :username AND room = :room";
    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':room', $roomCode);
    oci_bind_by_name($compiled, ':questionText', $question_text);
    oci_bind_by_name($compiled, ':username', $userName);
    oci_bind_by_name($compiled, ':ts', $date);

    oci_execute($compiled);
    $response_array['status'] = 'response test';
    echo "done";
    
    

    OCILogoff($conn);
    
?>
