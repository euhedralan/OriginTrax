<?php
    session_start();
    $_SESSION['authenticated'] = false;

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

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='". $user. "'";
    $conn->prepare($sql);
    $result = $conn->query($sql);
    
    if($result) {
        $row = $result->fetch(PDO::FETCH_NUM);
        $string = implode(',', $row);
        error_log($string);
        if($user && $pass && $row[1] == $user && $row[2] == $pass) {
            $_SESSION['authenticated'] = true;
            echo json_encode($user);
        }
    }

?>