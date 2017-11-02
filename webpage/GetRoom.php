<?php
	$conn = oci_connect('UserName',
			'Password',
			'//dbserver.engr.scu.edu/db11g');
    if ($conn) {}
    $roomCode = $_POST['roomCode'];
    echo $roomCode;
    $sql = "Select * from Questions where room='${roomCode}'";
    $compiled = oci_parse($conn, $sql);
    //oci_bind_by_name($compiled, ':roomCode', $roomCode);
    oci_execute($compiled);
    $num_columns = OCINumCols($compiled);
    echo "<TABLE BORDER=1>";
    echo "<TR><TH>Room Code</th><th>Tag</th><th>Text</th><th>Date</th><th>Username</th></tr>";
    while (OCIFetch($compiled)){
        echo "<tr>";
        for ($i = 1; $i <= $num_columns; $i++) {
            $column_value = OCIResult($compiled, $i);
            echo "<td>$column_value</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
?>
