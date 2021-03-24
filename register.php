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
    $user = $_POST['rusername'];
    $pass = $_POST['rpassword'];
    $sql = "INSERT INTO users ('username', 'password') VALUES ('". $user. "','". $pass. "')";
    $conn->prepare($sql);
    $result = $conn->query($sql);
    
    if($result) {
        $userid = $conn->lastInsertId();
        echo json_encode($userid);
    } else {
        echo json_encode($conn -> error);
    }

?>