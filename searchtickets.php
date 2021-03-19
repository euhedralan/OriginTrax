<?php
    $servername= "origintrax1.database.windows.net";
    $username="player1 ";
    $password="SGRE@123";
    $dbname="origintrax";

    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_errno){
        die("Connection failed: " . $conn->connect_error);
    }   
    
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "SELECT * FROM tickets WHERE ticketNumber='". $id. "'";

    $result = $conn->query($sql);

    $row = $result->fetch_row();
    $rticket = array(
        'ticketNumber' => $row[0],
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

