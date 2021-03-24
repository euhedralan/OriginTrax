<?php
    $servername= "origintrax1.database.windows.net";
    $username="playerone@origintrax1";
    $password="SGRE@123";
    $dbname="origintrax";

    $data = array();

    $conn = new mysqli($servername, $username, $password, $dbname, 1433);    
    if ($conn->connect_errno){
       echo '<h3> Connect failed! </h3>'
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


