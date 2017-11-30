<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Queue</title>
    <link rel="icon"
          type="image/png"
          href="favicon-96x96.png">
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
    include 'password.php';
    $conn = oci_connect( $username,
                         $password,
                         '//dbserver.engr.scu.edu/db11g');
    if ($conn) {}
    else { print "Connection failed <br />"; exit;}

    $letters = array("A","B","C","D","E","F",
                     "G","H","I","J","K","L","M","N",
                     "O","P","Q","R","S","T","U","V",
                     "W","X","Y","Z");
    //blacklist for certain words
    $badwords = array("FUCK","FUKC","CUNT",
                      "DICK","SHIT","DAMN","CRAP","KRAP","BDSM","KUNT");
    //session_start();

    do {
    $rand_keys = array_rand($letters, 4);
    $str = $letters[$rand_keys[0]] . $letters[$rand_keys[1]]
           . $letters[$rand_keys[2]] 
           . $letters[$rand_keys[3]];
    }while(in_array($str,$badwords));

    //$_SESSION['room_code'] = $str;

    //$sql = "INSERT INTO ROOMS VALUES ('$str', 0)";
    //$sql_statement = OCIParse($conn, $sql);
    //OCIexecute($sql_statement);
    //OCIFreeStatement($sql_statement);
    //OCILogoff($conn);
?>



<body>
    <div class="w3-row w3-container w3-centered">
    <h2 class=" w3-center w3-row" id="roomCode">Room: <?php echo $str; ?></h2>
        <p class="w3-center w3-row ">This is the code the students will need to enter in order to access the room</p>
                <div class="w3-row w3-center" style="margin-top:150px">
          <button onclick="nextpage()" class="w3-button w3-border">Launch Room</button>
        </div>
    </div>
    <script> 
        //When this function is called, posts data to database
        function nextpage(){
            $RoomCode = "<?php echo $str; ?>";
            //window.alert($RoomCode);
            $.ajax({
                url:     'ConfirmRoom.php',
                data:    { RoomCode : $RoomCode},
                type:    "POST",
                success: function(a){
                            //alert('Hello from PHP: ' + a);
                            sessionStorage.roomCode = "<?php echo $str; ?>"; 
                            console.log("TA ROOM STUFF" + sessionStorage.roomCode);
                            window.location.href = "QueueTAView.html";
                         },
                error:   function(data){
                            console.log(data);
                         }
            });
        }
    </script>
</body>
</html>
