<?php
    $servername= "localhost";
    $username="bnb";
    $password="";
    $dbname="origins";

    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_errno){
        die("Connection failed: " . $conn->connect_error);
    } 

    $direction = mysqli_real_escape_string($conn, $_POST['direction']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $commodity = mysqli_real_escape_string($conn, $_POST['commodity']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $pounds = mysqli_real_escape_string($conn, $_POST['pounds']);
    
    $sql = "INSERT INTO `tickets` (`direction`, `date`, `branch`, `customer`, `commodity`, `position`, `pounds`) VALUES
                                  ('". $direction. "','". $date. "',". $branch. ",". $customer. ",'". $commodity. "','". $position. "',". $pounds. ")";
    $result = $conn->query($sql);
    
    if($result) {
        $ticketNumber = $conn->insert_id;

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