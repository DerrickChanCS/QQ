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
    $question_text = $_POST['questionText'];
    $userName      = $_POST['userName'];
    $date          = date('Y-m-d H:i:s',time());

    //$sql = "INSERT INTO Questions(question_text) VALUES ('TEST')";
    
   // $sql = "INSERT INTO Questions VALUES ('${roomCode}', NULL, '${question_text}', TO_DATE('${date}', 'YYYY-MM-DD HH:MI:SS'))";
    $sql = "INSERT INTO Questions(room,question_text, username) ".
    'Values(:room, :questionText, :username)';
    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ':room', $roomCode);
    //oci_bind_by_name($compiled, ':tag', 'NULL');
    oci_bind_by_name($compiled, ':questionText', $question_text);
    oci_bind_by_name($compiled, ':username', $userName);
    //oci_bind_by_name($compiled, ':timestamp', NULL);
    oci_execute($compiled);
    //$response_array['status'] = oci_error($compiled);
    $response_array['status'] = 'response test';
    
    

    OCILogoff($conn);
    
?>
