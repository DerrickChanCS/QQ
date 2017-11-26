<?php
    //fclose(STDIN);
    //fclose(STDOUT);
    //fclose(STDERR);
    //$STDIN  = fopen('log.txt', 'w+');
    $STDOUT = fopen('log.txt', 'w');
    //$STDERR = fopen('log.txt', 'w+');
    print "test";
    echo "echo test from echo";


    fwrite($STDOUT, "echo test");
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
