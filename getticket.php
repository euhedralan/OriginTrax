
/* 
API to retrieve all tickets
RETURNS:
    ticketnumber
    direction
    date
    branch
    customer
    commodity
    position
    pounds
*/
<?php
    $servername= "origintrax1.database.windows.net";
    $username="playerone";
    $password="SGRE@123";
    $dbname="origintrax";
    
    

    $conn = new mysqli($servername, $username, $password, $dbname, 1433); 
    if ($conn->connect_errno){
        echo '<h3> Connect failed! </h3>'
        die("Connection failed: " . $conn->connect_error);
    }   
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "SELECT * FROM tickets WHERE ticketNumber='". $id. "'";
    $result = $conn->query($sql);

    $row = $result->fetch_row();
    $rticket = array(
        'ticketnumber' => $row[0],
        'direction' => $row[1],
        'date' => $row[2],
        'branch' => $row[3],
        'customer' => $row[4],
        'commodity' => $row[5],
        'position' => $row[6],
        'pounds' =>$row[7],
    );

    echo json_encode($rticket);

    $conn->close();
    
?>


