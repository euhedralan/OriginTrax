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

    $direction = $_POST['direction'];
    $date = $_POST['date'];
    $branch = $_POST['branch'];
    $customer = $_POST['customer'];
    $commodity = $_POST['commodity'];
    $position = $_POST['position'];
    $pounds = $_POST['pounds'];
    
    $sql = "INSERT INTO `tickets` (`direction`, `date`, `branch`, `customer`, `commodity`, `position`, `pounds`) VALUES
                                  ('". $direction. "','". $date. "',". $branch. ",". $customer. ",'". $commodity. "','". $position. "',". $pounds. ")";
    $result = $conn->query($sql);
    
    if($result) {
        $ticketNumber = $conn->lastInsertId();

        //return ticket inserted
        $data = array(
            'ticketnumber' => $ticketNumber,
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