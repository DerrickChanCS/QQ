<?php
    include 'password.php';
    $conn = oci_connect( $username,
                         $password,
                         '//dbserver.engr.scu.edu/db11g');
    if ($conn) { print "Connected";}
    else { print "Connection failed <br />"; exit;}

    $str = $_POST['RoomCode'];
    echo $str;
    //$str  = $_SESSION['room_code'];
    //echo $str;
    $sql = "INSERT INTO ROOMS VALUES ('$str',0)";
    $sql_statement = OCIParse($conn, $sql);
    OCIexecute($sql_statement);
    OCIFreestatement($sql_statement);
    OCILogoff($conn);
?>
