<?php
    $servername= "origintrax1.database.windows.net";
    $username="playerone@origintrax1";
    $password="SGRE@123";
    $dbname="origintrax";

    $conn = new mysqli($servername, $username, $password, $dbname, 1433); 
    if ($conn->connect_errno){
        echo '<h3> Connect failed! </h3>'
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