<?php
include 'password.php';
$conn = oci_connect($username,
    $password,
    '//dbserver.engr.scu.edu/db11g');
if ($conn) {}
$roomCode = $_POST['roomCode'];
//echo $roomCode;
$sql = "Select * from Questions where room = :roomCode";
$compiled = oci_parse($conn, $sql);
oci_bind_by_name($compiled, ":roomCode", $roomCode);
oci_execute($compiled);
$num_columns = OCINumCols($compiled);
//echo "<TABLE BORDER=1>";
//echo "<TR><TH>Room Code</th><th>Tag</th><th>Text</th><th>Date</th><th>Username</th></tr>";
$sessionName = "";
$tag = "";
$date = "";
$text = "";
while (OCIFetch($compiled)){
    //    echo "<tr>";
    for ($i = 1; $i <= $num_columns; $i++) {
        $column_value = OCIResult($compiled, $i);
        //      echo "<td>$column_value</td>";
        if ($i == 2){
            $tag = $column_value;
        }
        if ($i == 3){
            $text = $column_value;
        }
        if ($i == 4){
            $date = $column_value;
        }
        if ($i == 5){
            $sessionName = $column_value;
        }

    }

  

echo <<<EOT
        <div id="M$sessionName"class="w3-row" style="margin-left: 15%; margin-top: 30px">
            <div class="w3-panel w3-grey w3-display-container w3-dropdown-click w3-animate-opacity" style="height: 100px; width: 70%">
            <div onclick="expandQuestion('Q$sessionName')" class="w3-display-left w3-dark-grey w3-center" style="width: 50%; height: 100px">
            <p>$sessionName</p>
            </div>
            <div class="w3-display-right w3-grey w3-center" style="width: 50%">
            <p>$tag</p>
            <p>$date</p>
            </div>
            <span onclick="closeQuestion('Q$sessionName'), this.parentElement.style.display = 'none', this.parentElement.parentElement.style.display = 'none'"
            class="w3-button w3-border w3-dark-grey w3-large w3-display-topright" style="height: 51px">&times;</span>
                </div>
                <textarea id="Q$sessionName" class="w3-border w3-hide w3-container w3-animate-opacity" rows="4" readonly="" style="height: 100px; width: 59.5%; margin-bottom: 20px">
        $text
        </textarea>
            </div>

EOT;
    
    //echo "</tr>";
    }
    // echo "</table>";
?>
