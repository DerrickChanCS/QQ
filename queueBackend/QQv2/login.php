<?php
    $conn = oci_connect( 'gyabutiv',
    	                 '(insert pw here)',
    	                 '//dbserver.engr.scu.edu/db11g');
    if ($conn) { print "Connected";}
    else { print "Connection failed <br />"; exit;}

    $letters = array("A","B","C","D","E","F",
					 "G","H","I","J","K","L","M","N",
					 "O","P","Q","R","S","T","U","V",
					 "W","X","Y","Z");

    $rand_keys = array_rand($letters, 4);
    $str = $letters[$rand_keys[0]] . $letters[$rand_keys[1]]
		   . $letters[$rand_keys[2]] 
		   . $letters[$rand_keys[3]];

    echo $str;

    $sql = "INSERT INTO ROOMS VALUES ('$str')";
    $sql_statement = OCIParse($conn, $sql);
    OCIexecute($sql_statement);
    OCIFreeStatement($sql_statement);
    OCILogoff($conn);
?>