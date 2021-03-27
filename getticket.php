
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
    
    $id = $_POST['id'];
    $sql = "SELECT * FROM tickets WHERE ticketNumber=". $id;   
    $conn->prepare($sql);
    $result = $conn->query($sql);

    $row = $result->fetch(PDO::FETCH_NUM);
    $rticket = array(
        $row[0],
        $row[1],
        $row[2],
        $row[3],
        $row[4],
        $row[5],
        $row[6],
        $row[7],
    );

    echo json_encode($rticket);

    
?>


