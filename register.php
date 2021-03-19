<?php
    $servername= "localhost";
    $username="bnb";
    $password="";
    $dbname="origins";

    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_errno){
        die("Connection failed: " . $conn->connect_error);
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