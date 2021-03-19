<?php
    session_start();
    $_SESSION['authenticated'] = false;

    $servername= "origintrax1.database.windows.net";
    $username="player1 ";
    $password="SGRE@123";
    $dbname="origintrax";

    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_errno){
        die("Connection failed: " . $conn->connect_error);
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