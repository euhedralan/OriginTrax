<?php
    $servername= "origintrax1.database.windows.net";
    $username="playerone@origintrax1";
    $password="SGRE@123";
    $dbname="origintrax";
    
    try {
        $conn = new PDO("sqlsrv:server = tcp:origintrax1.database.windows.net,1433; Database = origintrax", "playerone", "SGRE@123");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }    
    $id = $_POST['id'];

    $sql = "SELECT * FROM tickets WHERE ticketNumber=". $id;
    $conn->prepare($sql);
    $result = $conn->query($sql);

    $row = $result->fetch(PDO::FETCH_NUM);
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
    
?>

