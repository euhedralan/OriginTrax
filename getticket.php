
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
    
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "SELECT * FROM tickets WHERE ticketNumber='". $id. "'";   
    $result = $conn->query($sql);

    $row = $result->fetch(PDO::FETCH_ASSOC);
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


