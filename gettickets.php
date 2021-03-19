<?php
    $servername= "localhost";
    $username="bnb";
    $password="";
    $dbname="origins";

    $data = array();

    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_errno){
        die("Connection failed: " . $conn->connect_error);
    }   
    
    $sql = "SELECT * FROM tickets";
    $result = $conn->query($sql);

    while($row = $result->fetch_array(MYSQLI_ASSOC))  {
        $data[] = $row;
    }

    echo json_encode($data);

    $conn->close();
    
?>


