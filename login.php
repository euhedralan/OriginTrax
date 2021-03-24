<?php
    session_start();
    $_SESSION['authenticated'] = false;

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
    $conn = mysqli_init();
    
    mysqli_ssl_set($conn,NULL,NULL, "/var/www/html/DigiCertGlobalRootG2.crt.pem", NULL, NULL);
    
    // Establish the connection
    mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, NULL, MYSQLI_CLIENT_SSL);
    
    //If connection failed, show the error
    if (mysqli_connect_errno($conn))
    {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
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