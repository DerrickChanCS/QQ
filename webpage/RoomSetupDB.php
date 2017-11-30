<?php
    include 'password.php';
	$conn = oci_connect( $username,
                         $password,
                         '//dbserver.engr.scu.edu/db11g');
    if ($conn) { //print "Connected";
                }

    session_start();
    $room_code = $_SESSION['room_code'];
    // Session to take note of room code. Note this when making
    // and joining rooms.

    $tag = $_POST["tag"];


    $sql = "INSERT INTO tags VALUES ('${room_code}', '${tag}')";
    $sql_statement = OCIParse($conn, $sql);
    OCIexecute($sql_statement);
    OCIFreeStatement($sql_statement);

    $sql2 = "SELECT tagname from TAGS where room = '${room_code}'";
    $sql_statement = OCIParse($conn, $sql2);
    OCIexecute($sql_statement);

    $num_columns = OCINumCols($sql_statement);

    while(OCIFetch($sql_statement)) {
    	for ($i = 1; $i <= $num_columns; $i++){
    		$column_value = OCIResult($sql_statement, $i);
    		//echo json_encode($column_value);
    		echo "<option> $column_value <option>";
    	}

    }

    /*
    echo "<TABLE BORDER= 1 >";
    echo "<TR><TH style='padding: 10px 10px;'>Tags</TH>";
      while (OCIFetch($sql_statement)) {
	  echo "<TR>";
	  for ($i = 1; $i <= $num_columns; $i++) {
	    $column_value = OCIResult($sql_statement, $i);
	    echo "<TD style='padding: 10px 10px;'>$column_value</TD>";
	  }
	  echo "</TR>";
	}
	echo "</TABLE>";
	*/

    OCILogoff($conn);

    ?>
