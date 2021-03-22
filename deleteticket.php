<?php
    $servername= "origintrax1.database.windows.net";
    $username="playerone";
    $password="SGRE@123";
    $dbname="origintrax";

    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_errno){
        die("Connection failed: " . $conn->connect_error);
    } 

    $ticketnumber = mysqli_real_escape_string($conn, $_POST['id']);
    
    $sql = "DELETE FROM `tickets` WHERE `ticketNumber`=". $ticketnumber; 
    
    $result = $conn->query($sql);
    
    if($result) {
                //return ticket inserted
        $data = array(
            'ticketNumber' => $ticketnumber,
        );
        echo json_encode($data);
    } else {
        $data = Error;
        echo $data;
    }
   
    $conn->close(); 
?>