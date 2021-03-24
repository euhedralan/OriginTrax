<?php
    session_start();
    $_SESSION['authenticated'] = false;

    $servername= "origintrax1.database.windows.net";
    $username="playerone@origintrax1";
    $password="SGRE@123";
    $dbname="origintrax";

    // PHP Data Objects(PDO) Sample Code:
    try {
        $conn = new PDO("sqlsrv:server = tcp:origintrax1.database.windows.net,1433; Database = origintrax", "playerone", "SGRE@123");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username='". $user. "'";
    $result = $conn->query($sql);
    
    if($result) {
        $row = $result->fetch_row();
        
        if($user && $pass && $row[1] == $user && $row[2] == $pass) {
            $_SESSION['authenticated'] = true;
            echo json_encode($user);
        }
    }
    
    $conn->close();
?>