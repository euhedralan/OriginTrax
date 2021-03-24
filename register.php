<?php
    $servername= "origintrax1.database.windows.net";
    $username="playerone@origintrax1";
    $password="SGRE@123";
    $dbname="origintrax";

    // $conn = new mysqli($servername, $username, $password, $dbname, 1433); 
    // if ($conn->connect_errno){
    //     echo '<h3> Connect failed! </h3>'
    //     die("Connection failed: " . $conn->connect_error);
    // } 
    //Initializes MySQLi
    // $conn = mysqli_init();
    
    // mysqli_ssl_set($conn,NULL,NULL, "DigiCertGlobalRootG2.crt.pem", NULL, NULL);    
    // // Establish the connection
    // mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, NULL, MYSQLI_CLIENT_SSL);
    
    // //If connection failed, show the error
    // if (mysqli_connect_errno($conn))
    // {
    //     die('Failed to connect to MySQL: '.mysqli_connect_error());
    // }

    // PHP Data Objects(PDO) Sample Code:
    try {
        $conn = new PDO("sqlsrv:server = tcp:origintrax1.database.windows.net,1433; Database = origintrax", "playerone", "SGRE@123");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }    
    $user = mysqli_real_escape_string($conn, $_POST['rusername']);
    $pass = mysqli_real_escape_string($conn, $_POST['rpassword']);
    $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('". $user. "','". $pass. "')";
    $result = $conn->query($sql);
    
    if($result) {
        $userid = $conn->insert_id;
        echo json_encode($userid);
    } else {
        echo json_encode($conn -> error);
    }
    
    
    $conn->close();
?>