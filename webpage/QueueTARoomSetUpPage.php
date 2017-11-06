<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

    <script type="text/javascript">
     
      $(document).ready(function(){
        // When this particular form is submitted
        $('#send_tag').submit(function(e){
            // Stop normal refresh of page
            e.preventDefault();
            // Use ajax
            $.ajax({
                // Send via post
                type: 'post',
                // This is your page that will process the update 
                // and return the errors/success messages
                url: "RoomSetupDB.php",
                // This is what compiles the form data
                data: $(this).serialize(),
                // This is what the ajax will do if successfully executed
                success: function(response){
                    // It will write the html from page2.php into an 
                    // element with the id of "errors", in our case
                    // it's a div
                    $('#tag_dropdown').html(response);
                    //var opts = $.parseJSON(response);

                },
                //  If the ajax is a failure, this will pop up in the console.
                error: function(response){
                    console.log(response);
                }
            });
        });
    });
    </script>

</head>
<!-- PHP CODE for randomizing room code. Code will send the value to the database
    , and use the value for display purposes on this page-->
<?php
    include 'password.php'
    $conn = oci_connect( $username,
                         $password,
                         '//dbserver.engr.scu.edu/db11g');
    if ($conn) { print "Connected";}
    else { print "Connection failed <br />"; exit;}

    $letters = array("A","B","C","D","E","F",
                     "G","H","I","J","K","L","M","N",
                     "O","P","Q","R","S","T","U","V",
                     "W","X","Y","Z");

    session_start();

    $rand_keys = array_rand($letters, 4);
    $str = $letters[$rand_keys[0]] . $letters[$rand_keys[1]]
           . $letters[$rand_keys[2]] 
           . $letters[$rand_keys[3]];

    echo $str;
    $_SESSION['room_code'] = $str;

    $sql = "INSERT INTO ROOMS VALUES ('$str', 0)";
    $sql_statement = OCIParse($conn, $sql);
    OCIexecute($sql_statement);
    OCIFreeStatement($sql_statement);
    OCILogoff($conn);
?>



<body>
    <div class="w3-container w3-centered">
    <h2 class="w3-center w3-half">Room </h2> <h2 class="w3-half" id="roomCode"> <?php echo $str; ?></h2>
        <p class="w3-center">This is the code the students will need to enter in order to access the room</p>
        <div class="w3-row" style="margin-left: 27%; margin-right: 15%">
            <div class="w3-row" style="margin-bottom: 30px">
                <label>Create Tags if desired</label>
                <div>
                    <form id = "send_tag" action = "RoomSetupDB.php" method = "post">
                        <input class="w3-input w3-border w3-round w3-half" style="width: 30%" id="Text1" type="text" name = "tag" />
                        <button type = "submit" class="w3-button w3-half w3-medium w3-round" style="width: 30%; margin-left: 20%">Create Tag</button>
                    </form>
                    <div id = "results"> </div>
                </div>
            </div>
            <div class="w3-row">
                <label>
                    Edit Tag List
                </label>
                <br />
                <select id = "tag_dropdown" class="w3-select w3-border w3-half" style="width: 30%">
                    <option>Test</option>
                    <option>Test2</option>

                </select>
                <button class="w3-button w3-half w3-medium w3-round" style="width: 30%; margin-left: 20%">Remove Selected Tag</button>
            </div>

        </div>
        <div class="w3-row w3-center" style="margin-top:150px">
          <button onclick="nextpage()" class="w3-button">Launch Room</button>
        </div>
    </div>
    <script> 
    function nextpage(){
          sessionStorage.roomCode = "<?php echo $str; ?>"; 
          console.log("TA ROOM STUFF" + sessionStorage.roomCode);
          window.location.href = "QueueStudentView.html";
}
</script>
</body>
</html>
