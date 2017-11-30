<?php
    //The purpose of this file is to delete a question
    //can be called from TA view or student view
    include 'password.php';
    $conn = oci_connect( $username,
                        $password,
                        '//dbserver.engr.scu.edu/db11g');
    if ($conn) {}
    $roomCode      = $_POST['roomCode'];
    $userName      = $_POST['username'];

    //$sql = "INSERT INTO Questions(question_text) VALUES ('TEST')";
    
   // $sql = "INSERT INTO Questions VALUES ('${roomCode}', NULL, '${question_text}', TO_DATE('${date}', 'YYYY-MM-DD HH:MI:SS'))";
    $sql = "Delete from Questions where username = :username and room = :room";
    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ':room', $roomCode);
    //oci_bind_by_name($compiled, ':tag', 'NULL');
    oci_bind_by_name($compiled, ':username', $userName);
    oci_execute($compiled);
    //$response_array['status'] = oci_error($compiled);
    $response_array['status'] = 'response test';
    
    

    OCILogoff($conn);
    
?>
