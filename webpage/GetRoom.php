
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<?php
//This script echoes out the HTML of the questions retrieved from the database
include 'password.php';
$conn = oci_connect($username,
    $password,
    '//dbserver.engr.scu.edu/db11g');
if ($conn) {}
//Get the values from JS
$roomCode = $_POST['roomCode'];
$textOpenClose = $_POST['textOpenClose'];
//Passed in the format of username,[true|false]?username,[true|false]
//received as URI

$sql = "Select * from Questions where room = :roomCode ORDER BY time_stamp";
$compiled = oci_parse($conn, $sql);
oci_bind_by_name($compiled, ":roomCode", $roomCode);
oci_execute($compiled);
$num_columns = OCINumCols($compiled);


$userNames     = array();
$tagArray      = array();
$textArray     = array();
$dateArray     = array();
$resolvedArray = array();

$currentDivNum = $_POST['currentDivNum'];

//Get all of values from the database and populate into php arrays
//loop through returned results
while (OCIFetch($compiled)){
    for ($i = 1; $i <= $num_columns; $i++) {
        $column_value = OCIResult($compiled, $i);
        if ($i == 2){
            array_push($tagArray, $column_value);
        }
        if ($i == 3){
            array_push($textArray, $column_value);
        }
        if ($i == 4){
            array_push($dateArray, $column_value);
        }
        if ($i == 5){
            array_push($userNames, $column_value);
        }
        if ($i == 6){
            array_push($resolvedArray, $column_value);
        }

    }
}

$json_usernames = json_encode($userNames);
$json_text      = json_encode($textArray);
$json_date      = json_encode($dateArray);
$json_tags      = json_encode($tagArray);
$json_resolved  = json_encode($resolvedArray);

?>

<div id = "container">

</div>

<script>
var userNames     = <?php echo $json_usernames; ?>;
var questionText  = <?php echo $json_text; ?>;
var dates         = <?php echo $json_date; ?>;
var tags          = <?php echo $json_tags; ?>;
var currentDivNum = <?php echo $currentDivNum; ?>;
var resolved      = <?php echo $json_resolved; ?>;
var divCount = currentDivNum;


var divMap = "<?php echo $textOpenClose; ?>";
var divVal = divMap.split("?");
var temp ="";
var divDict = {};

//Builds JS map of show/hide values
for(var j = 0; j < divVal.length; j++){
    temp = divVal[j].split(",");
    divDict[temp[0]] = temp[1];
}


//i represents the index of each unique individual user
for(var i = 0; i< userNames.length; i++){
    currentDivNum++;
    
    //console.log("Current div num from getRoom.php: " + currentDivNum);
    var container = document.getElementById("container");

    var newDiv = document.createElement('div'); //id sessionName
    newDiv.setAttribute('id', "M" + userNames[i]);
    newDiv.setAttribute('class', 'w3-row');
    newDiv.setAttribute('style',"margin-left: 15%; margin-top: 30px");

    //Child 1
    newDivChild1 = document.createElement("div");
    newDivChild1.setAttribute('class', "w3-panel w3-grey w3-display-container w3-dropdown-click");
    newDivChild1.setAttribute('style', 'height: 100px; width: 70%');


    //Child 2 onclick expand
    //Adds div that expands textarea onclick
    var newDivChild2 = document.createElement("div");
    newDivChild2.setAttribute('onclick', 'expandQuestion(' + '\"' +  userNames[i]+ '\"' + ')');
    //If the TA answered the question
    if(resolved[i] == 'n'){
      newDivChild2.setAttribute('class', 'w3-display-left w3-dark-grey w3-center');
    } else{
      newDivChild2.setAttribute('class', 'w3-display-left w3-red w3-center');
    }
    newDivChild2.setAttribute('style', 'width: 50%; height: 100px;');
    //newDivChild

    //par for username
    var userNamePar = document.createElement("p");
    var parNode = document.createTextNode(userNames[i]);
    userNamePar.appendChild(parNode);

    //add username text to child 2 which is the onclick expand one, use Michael's code for reference
    newDivChild2.appendChild(userNamePar);

    //create child 3 which is also under child 1
    var newDivChild3 = document.createElement('div');
    newDivChild3.setAttribute("class", "w3-display-right w3-grey w3-center");
    newDivChild3.setAttribute("style", "width: 50%");

    //create p for date
    var datePar = document.createElement("p");
    var dateNode = document.createTextNode(dates[i]);
    datePar.setAttribute("id", "date_"+userNames[i]);
    datePar.appendChild(dateNode);

    //Append date to child 3
    newDivChild3.appendChild(datePar);

    //onclick close question
    var closeSpan = document.createElement('span');
    closeSpan.setAttribute("onclick",'closeQuestion(' + '\"' +  userNames[i]+ '\"' + '), ' +  
                           'this.parentElement.style.display = ' + '\"' + 'none' + '\"' + 
                           ", this.parentElement.parentElement.style.display = " + '\"' + 'none' + '\"' );
    closeSpan.setAttribute("class", "w3-button w3-border w3-dark-grey w3-large w3-display-topright");
    closeSpan.setAttribute("style", "height: 51px");
    
    closeSpan.innerHTML = "&times;";


    //Append all to child 1
    newDivChild1.appendChild(newDivChild2);
    newDivChild1.appendChild(newDivChild3);
    newDivChild1.appendChild(closeSpan);

    //Text area
    var insertText = document.createElement('textarea');
    insertText.setAttribute("id", userNames[i]);
    insertText.setAttribute("maxlength", "3999");
    insertText.setAttribute("placeholder", "Character limit of 3999 characters"); 
    insertText.setAttribute("onclick", 'populateText(' + '\"'  + userNames[i] + '\"' + ')');
    //Determines if the textarea should be drawn shown or hidden
    if (divDict[userNames[i]] == "true"){
        insertText.setAttribute("class", "w3-border w3-show w3-hide w3-container");
    }
    else{
        insertText.setAttribute("class", "w3-border w3-hide w3-container");
    }
    insertText.setAttribute("rows", "4");
    insertText.setAttribute("readonly", "");
    insertText.setAttribute("style","height: 100px; width: 59.5%; margin-bottom: 20px");

    var boxText = document.createTextNode(questionText[i]);
    insertText.appendChild(boxText);

    //Append Child 1 to newDiv
    newDiv.appendChild(newDivChild1);
    newDiv.appendChild(insertText);

    //Append newDiv to container
    container.appendChild(newDiv);

}
</script>
