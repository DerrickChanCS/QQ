<?php
    //The purpose of this php is to submit question
    include 'password.php';
    $conn = oci_connect( $username,
                        $password,
                        '//dbserver.engr.scu.edu/db11g');
    if ($conn) {}
    $roomCode      = $_POST['roomCode'];
    $question_text = $_POST['questionText'];
    echo $_POST['questionText'];
    $userName      = $_POST['userName'];
    $date          = date('Y-m-d H:i:s',time());

    $sql = "INSERT INTO Questions(room,question_text, time_stamp, username) ".
    'Values(:room, :questionText, :time_stamp, :username)';
    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ':room', $roomCode);
    oci_bind_by_name($compiled, ':questionText', $question_text);
    oci_bind_by_name($compiled, ':username', $userName);
    oci_bind_by_name($compiled, ':time_stamp', $date);
    oci_execute($compiled);
    $response_array['status'] = 'response test';

    OCILogoff($conn);
    
?>
