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
    $ticketnumber = mysqli_real_escape_string($conn, $_POST['ticketnumber']);
    $direction = mysqli_real_escape_string($conn, $_POST['direction']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $commodity = mysqli_real_escape_string($conn, $_POST['commodity']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $pounds = mysqli_real_escape_string($conn, $_POST['pounds']);
    
    $sql = "UPDATE `tickets` SET `direction`='". $direction. "', `date`='". $date. "', `branch`=". $branch. ", `customer`=". $customer. ", `commodity`='". $commodity. "', `position`='". $position. "', `pounds`=". $pounds. " WHERE `ticketNumber`=". $ticketnumber; 
    
    $result = $conn->query($sql);
    
    if($result) {
                //return ticket inserted
        $data = array(
            'ticketNumber' => $ticketnumber,
            'direction' => $direction,
            'date' => $date,
            'branch' => $branch,
            'customer' => $customer,
            'commodity' => $commodity,
            'position' => $position,
            'pounds' => $pounds,
        );
        echo json_encode($data);
    } else {
        $data = Error;
        echo $data;
    }
   
    $conn->close(); 
?>